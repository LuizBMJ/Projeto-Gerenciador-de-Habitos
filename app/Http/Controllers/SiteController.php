<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class SiteController extends Controller
{
    public function index(): View {
        
        return view('home');
    }

    public function dashboard(): View {

        $habits = auth('web')->user()->habits;
        return view('dashboard', compact('habits'));
    }
}