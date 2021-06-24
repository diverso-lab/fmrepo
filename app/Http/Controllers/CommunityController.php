<?php

namespace App\Http\Controllers;

use App\Http\Services\CommunityService;
use App\Http\Services\DepositionService;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function list()
    {

        $service = new CommunityService();
        $communities = $service->all();
        return view('researcher.community.list');
    }
}
