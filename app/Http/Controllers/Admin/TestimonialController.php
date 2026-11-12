<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('display_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_title' => 'required|string|max:255',
            'content' => 'required|string',
            'client_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $testimonial = new Testimonial();
        $testimonial->client_name = $validated['client_name'];
        $testimonial->client_title = $validated['client_title'];
        $testimonial->content = $validated['content'];
        $testimonial->is_active = $request->has('is_active');
        $testimonial->display_order = Testimonial::max('display_order') + 1;

        if ($request->hasFile('client_image')) {
            $path = $request->file('client_image')->store('testimonials', 'public');
            $testimonial->client_image = $path;
        }

        $testimonial->save();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_title' => 'required|string|max:255',
            'content' => 'required|string',
            'client_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean'
        ]);

        $testimonial->client_name = $validated['client_name'];
        $testimonial->client_title = $validated['client_title'];
        $testimonial->content = $validated['content'];
        $testimonial->is_active = $request->boolean('is_active');

        if ($request->hasFile('client_image')) {
            // Delete old image if exists
            if ($testimonial->client_image) {
                Storage::disk('public')->delete($testimonial->client_image);
            }
            
            $path = $request->file('client_image')->store('testimonials', 'public');
            $testimonial->client_image = $path;
        }

        $testimonial->save();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->client_image) {
            Storage::disk('public')->delete($testimonial->client_image);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*' => 'integer'
        ]);

        foreach ($request->items as $index => $id) {
            Testimonial::where('id', $id)->update(['display_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
