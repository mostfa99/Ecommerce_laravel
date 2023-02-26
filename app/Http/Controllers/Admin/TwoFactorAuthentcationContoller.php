<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthentcationContoller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.two-factor-auth', compact('user'));
    }
}
