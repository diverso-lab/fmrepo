<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterResearcherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register()
    {

        return view('register.researcher');

    }

    public function register_p(Request $request)
    {

        $role = Role::where('rol','RESEARCHER')->first();
        $user = Auth::user();

        $user->roles()->attach($role->id);

        return redirect()->route('home');

    }
}