<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Minimal admin dashboard — extend as needed
        return view('admin.dashboard');
    }
}
