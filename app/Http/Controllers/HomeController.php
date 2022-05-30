<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $user = Auth::user();
        return view('components.index', compact('user'));
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

}

