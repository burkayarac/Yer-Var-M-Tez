<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyLoginController extends Controller
{
    public function Login() {
        return view('company/login');
    }
}
