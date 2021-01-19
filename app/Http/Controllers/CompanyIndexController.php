<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyIndexController extends Controller
{
    public function Index() {
        return view('company/index');
    }
}
