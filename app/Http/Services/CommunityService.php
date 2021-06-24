<?php


namespace App\Http\Services;


use App\Models\Community;

class CommunityService extends Service
{

    public function __construct()
    {
        parent::__construct(Community::class);
    }

}