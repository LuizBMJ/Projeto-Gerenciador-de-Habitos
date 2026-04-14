<?php

namespace App\Http\Controllers;

// This controller handles the public/home page

use Illuminate\Contracts\View\View;

class SiteController extends Controller
{
    // Show the home page
    public function index(): View
    {
        return view('home');
    }
}
