<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterDeveloperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register()
    {

        return view('register.developer');

    }

    public function register_p(Request $request)
    {

        $role = Role::where('rol','DEVELOPER')->first();
        $user = Auth::user();

        $user->roles()->attach($role->id);

        return redirect()->route('home');

    }
}
