<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function settings()
    {
        $admin = Auth::guard('admin')->user();
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.settings', compact('admin', 'settings'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($validated);

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully.');
    }

    public function updateBranding(Request $request)
    {
        // Allow partial updates and SVG logos
        $request->validate([
            'site_name' => 'sometimes|nullable|string|max:255',
            'site_logo' => 'sometimes|nullable|file|mimes:jpeg,png,jpg,gif,svg,svg+xml|mimetypes:image/jpeg,image/png,image/gif,image/svg+xml|max:4096',
            'favicon' => 'sometimes|nullable|file|mimes:ico,png|max:1024',
            'primary_color' => 'sometimes|nullable|string|max:7',
            'secondary_color' => 'sometimes|nullable|string|max:7',
            'footer_text' => 'sometimes|nullable|string',
            'contact_email' => 'sometimes|nullable|email',
            'contact_phone' => 'sometimes|nullable|string|max:20',
            'address' => 'sometimes|nullable|string',
            'currency_code' => 'sometimes|nullable|string|max:10',
            'currency_symbol' => 'sometimes|nullable|string|max:10'
        ]);

        $settings = SiteSetting::first() ?? new SiteSetting();
        $isNew = !$settings->exists;

        // Handle file uploads (store logos directly under public/site to avoid symlink issues)
        if ($request->hasFile('site_logo')) {
            // Remove previous logo regardless of storage location
            if ($settings->site_logo) {
                $old = ltrim($settings->site_logo, '/');
                $oldPublic = public_path($old);
                if (file_exists($oldPublic)) {
                    @unlink($oldPublic);
                } else {
                    Storage::disk('public')->delete($old);
                }
            }

            $file = $request->file('site_logo');
            $ext = $file->getClientOriginalExtension();
            $name = 'logo_' . date('Ymd_His') . '_' . substr(md5(uniqid('', true)), 0, 8) . '.' . $ext;
            $dest = public_path('site');
            if (!is_dir($dest)) {
                @mkdir($dest, 0755, true);
            }
            $file->move($dest, $name);
            $settings->site_logo = 'site/' . $name;
        }

        if ($request->hasFile('favicon')) {
            if ($settings->favicon) {
                $oldFav = ltrim($settings->favicon, '/');
                $oldFavPublic = public_path($oldFav);
                if (file_exists($oldFavPublic)) {
                    @unlink($oldFavPublic);
                } else {
                    Storage::disk('public')->delete($oldFav);
                }
            }
            $file = $request->file('favicon');
            $ext = $file->getClientOriginalExtension();
            $name = 'favicon_' . date('Ymd_His') . '_' . substr(md5(uniqid('', true)), 0, 8) . '.' . $ext;
            $dest = public_path('site');
            if (!is_dir($dest)) {
                @mkdir($dest, 0755, true);
            }
            $file->move($dest, $name);
            $settings->favicon = 'site/' . $name;
        }

        // Update other fields only if they were provided to avoid overwriting with null
        if ($request->has('site_name')) {
            $settings->site_name = $request->site_name;
        }
        if ($request->has('primary_color')) {
            $settings->primary_color = $request->primary_color;
        }
        if ($request->has('secondary_color')) {
            $settings->secondary_color = $request->secondary_color;
        }
        if ($request->has('footer_text')) {
            $settings->footer_text = $request->footer_text;
        }
        if ($request->has('contact_email')) {
            $settings->contact_email = $request->contact_email;
        }
        if ($request->has('contact_phone')) {
            $settings->contact_phone = $request->contact_phone;
        }
        if ($request->has('address')) {
            $settings->address = $request->address;
        }
        if ($request->has('currency_code')) {
            $settings->currency_code = $request->currency_code;
        }
        if ($request->has('currency_symbol')) {
            $settings->currency_symbol = $request->currency_symbol;
        }

        // If this is the first-time create, ensure required defaults to satisfy DB constraints
        if ($isNew) {
            if (empty($settings->site_name)) {
                $settings->site_name = config('app.name', 'Avenro Logistics');
            }
            if (empty($settings->primary_color)) {
                // Default to brand navy
                $settings->primary_color = '#0B1F3D';
            }
            if (empty($settings->secondary_color)) {
                // Default to brand gold
                $settings->secondary_color = '#C6A15B';
            }
        }
        $settings->save();

        return redirect()->back()->with('success', 'Branding settings updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'email_notifications' => 'boolean',
            'shipment_updates' => 'boolean',
            'new_orders' => 'boolean',
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->update([
            'email_notifications' => $request->has('email_notifications'),
            'shipment_updates' => $request->has('shipment_updates'),
            'new_orders' => $request->has('new_orders'),
        ]);

        return redirect()->back()->with('success', 'Notification preferences updated successfully.');
    }
} 