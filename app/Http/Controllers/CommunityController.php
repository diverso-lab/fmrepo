<?php

namespace App\Http\Controllers;

use App\Http\Services\CommunityService;
use App\Http\Services\DepositionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{

    private $community_service;

    public function __construct()
    {
        $this->community_service = new CommunityService();
    }

    public function list()
    {
        $communities = $this->community_service->all();
        return view('community.list', ['communities' => $communities]);
    }

    public function mine()
    {
        $communities = $this->community_service->my_communities();
        return view('community.mine', ['communities' => $communities]);
    }

    public function create()
    {
        return view('community.create');
    }

    public function create_p(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'organisation' => $request->input('organisation'),
            'info' => $request->input('info')
        ];

        $community = $this->community_service->create($data);
        $this->community_service->add_me_as_admin($community);

        return redirect()->route('community.mine')->with('success','Community created successfully');
    }
}
