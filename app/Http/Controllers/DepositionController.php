<?php

namespace App\Http\Controllers;

use App\Models\Deposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositionController extends Controller
{

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
