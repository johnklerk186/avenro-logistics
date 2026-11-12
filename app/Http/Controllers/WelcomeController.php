<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        try {
            $testimonials = Testimonial::where('is_active', true)
                ->orderBy('display_order')
                ->get();
        } catch (\Throwable $e) {
            $testimonials = collect();
        }

        return view('welcome', compact('testimonials'));
    }
} 