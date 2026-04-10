<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        User::all();
        return view('auth.register');
    }

    public function store()
    {
        User::all();
    }

}
