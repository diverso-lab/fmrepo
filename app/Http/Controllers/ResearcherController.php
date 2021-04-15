<?php

namespace App\Http\Controllers;

use App\Models\ZenodoToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResearcherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function zenodo_token()
    {
        return view('researcher.zenodo_token');
    }

    public function zenodo_token_p(Request $request)
    {

        $request->validate([
            'token' => 'required|max:255',
        ]);

        $user = Auth::user();

        $user->zenodo_token()->create([
            'token' => $request->input('token')
        ]);


        return redirect()->route('researcher.zenodo.token')->with('success','Zenodo token saved successfully');

    }
}
