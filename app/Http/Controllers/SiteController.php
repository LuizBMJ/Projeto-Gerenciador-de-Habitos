<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    public function index() {
        
        $name = 'Jorge';
        $habits = ['Ler', 'Correr', 'Estudar'];
        
        //return view('home', [
        //    'name' => $name,
        //    'habits' => $habits
        //]);

        return view('home', compact('name', 'habits'));
    }

    public function dashboard() {
        return view('dashboard');
    }
}