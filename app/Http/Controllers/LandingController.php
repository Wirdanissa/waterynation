<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function admin(){
        return view('pages.admin.dashboard.index');
    }

    public function index()
    {
        return view('pages.guest.home.index');
    }
}
