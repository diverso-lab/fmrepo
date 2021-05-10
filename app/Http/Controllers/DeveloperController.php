<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function get_token()
    {
        return view('developer.get_token');
    }
}
