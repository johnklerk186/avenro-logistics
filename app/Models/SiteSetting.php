<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_logo',
        'favicon',
        'primary_color',
        'secondary_color',
        'footer_text',
        'contact_email',
        'contact_phone',
        'address',
        'currency_code',
        'currency_symbol'
    ];

    public static function getSetting($key)
    {
        try {
            if (!Schema::hasTable('site_settings')) {
                return null;
            }
        } catch (\Throwable $e) {
            return null;
        }
        $setting = self::first();
        return $setting ? $setting->$key : null;
    }

    public static function getCurrency(): array
    {
        try {
            $hasTable = Schema::hasTable('site_settings');
        } catch (\Throwable $e) {
            $hasTable = false;
        }
        if (!$hasTable) {
            return [
                'code' => 'USD',
                'symbol' => '$',
                'label' => 'USD',
            ];
        }
        $setting = self::first();

        $code = $setting?->currency_code;
        $symbol = $setting?->currency_symbol;

        if (!$code && !$symbol) {
            return [
                'code' => 'USD',
                'symbol' => '$',
                'label' => 'USD',
            ];
        }

        return [
            'code' => $code,
            'symbol' => $symbol ?: ($code ?? ''),
            'label' => $code ?: ($symbol ?? ''),
        ];
    }

    /**
     * Resolve a full URL for the site logo regardless of storage location.
     * Supports absolute URLs, files saved under public/, and files on the public disk (/storage).
     */
    public static function getLogoUrl(): ?string
    {
        $path = self::getSetting('site_logo');
        if (!$path) {
            return null;
        }
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }
        // If file exists directly under public path, serve via asset($path)
        $publicPath = public_path($path);
        if (file_exists($publicPath)) {
            return asset($path);
        }
        // Attempt to migrate from storage/app/public to public/site to avoid symlink issues
        $storagePath = storage_path('app/public/' . ltrim($path, '/'));
        if (file_exists($storagePath)) {
            $targetDir = public_path('site');
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $fileName = basename($path);
            $targetPath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
            // Copy if not already there
            if (!file_exists($targetPath)) {
                @copy($storagePath, $targetPath);
            }
            if (file_exists($targetPath)) {
                return asset('site/' . $fileName);
            }
        }
        // Fallback to storage URL if copy did not succeed
        return asset('storage/' . ltrim($path, '/'));
    }
} 