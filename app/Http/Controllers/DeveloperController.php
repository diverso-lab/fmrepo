<?php

namespace App\Http\Controllers;

use App\Http\Services\APIService;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{

    private $api_service;

    public function __construct()
    {
        $this->api_service = new APIService();
    }

    public function get_token()
    {
        return view('developer.token_get');
    }

    public function get_token_p(Request $request)
    {
        $new_token = $this->api_service->register_token($request->input());
        return redirect()->route('developer.token.list')->with('success', 'The API token has been created successfully')->with('new_token',$new_token);
    }

    public function list(){

        $tokens = $this->api_service->get_developer_tokens();

        return view('developer.token_list',['tokens' => $tokens]);
    }
}
