<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function showHome(): View
    {
        return view('home', ['page_title' => 'Home']);
    }
}
