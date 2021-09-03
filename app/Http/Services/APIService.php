<?php


namespace App\Http\Services;


use App\Models\DeveloperToken;
use App\Models\DeveloperTokenScope;

class APIService
{

    public function __construct()
    {

    }

    public function register_token($data)
    {
        $name = $data["name"];
        $token = \Random::getRandomString(60);
        $me = Auth()->user();

        $developer_token = DeveloperToken::create([
            'name' => $name,
            'token' => $token,
            'user_id' => $me->id
        ]);

        if($data["scope_get"] == "on"){
            DeveloperTokenScope::create([
               'scope' => 'GET',
               'developer_token_id' => $developer_token->id
            ]);
        }

        if($data["scope_post"] == "on"){
            DeveloperTokenScope::create([
                'scope' => 'POST',
                'developer_token_id' => $developer_token->id
            ]);
        }

        if($data["scope_put"] == "on"){
            DeveloperTokenScope::create([
                'scope' => 'PUT',
                'developer_token_id' => $developer_token->id
            ]);
        }

        if($data["scope_delete"] == "on"){
            DeveloperTokenScope::create([
                'scope' => 'DELETE',
                'developer_token_id' => $developer_token->id
            ]);
        }

        return $token;
    }

    public function get_developer_tokens()
    {
        $me = Auth()->user();
        return $me->developer_tokens;
    }



}