<?php

namespace App\Http\Controllers;

use App\Models\Deposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositionController extends Controller
{
    /*public function token()
    {
        $token = "zd3JCJs58v8zJeHX4kl8ypNvqHMT1MdrgT6de3e6jDL79GIHGhIf3tXrlggo";
    }*/

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        $depositions = Auth::user()->depositions;
        return view('researcher.deposition_list', ['depositions' => $depositions]);
    }

}
