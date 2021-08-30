<?php

namespace App\Http\Controllers;

use App\Http\Services\CommunityService;
use App\Http\Services\DepositionService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{

    private $community_service;
    private $user_service;
    private $deposition_service;

    public function __construct()
    {
        $this->community_service = new CommunityService();
        $this->user_service = new UserService();
        $this->deposition_service = new DepositionService();
    }

    public function list()
    {
        $communities = $this->community_service->all_sorted_by_desc('created_at');
        return view('community.list', ['communities' => $communities]);
    }

    public function mine()
    {
        $communities = $this->community_service->my_communities();
        return view('community.mine', ['communities' => $communities]);
    }

    public function view($id)
    {
        $community = $this->community_service->find_or_fail($id);
        $community_datasets = $community->datasets;
        return view('community.view', [
            'community' => $community,
            'community_datasets' => $community_datasets
            ]);
    }

    public function create()
    {
        $users = $this->user_service->all_except_logged();
        return view('community.create', ['users' => $users]);
    }

    public function create_p(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'organisation' => $request->input('organisation'),
            'info' => $request->input('info')
        ];

        // add admin
        $community = $this->community_service->create($data);
        $this->community_service->add_me_as_admin($community);
        $this->community_service->increase_number_of_members($community);

        // add members
        foreach ($request->input('users') as $user_id) {
            $community_member = $this->community_service->create_community_member_by_user_id($user_id);
            $this->community_service->add_community_member($community, $community_member->id);
            $this->community_service->increase_number_of_members($community);
        }

        return redirect()->route('community.mine')->with('success','Community created successfully');
    }

    public function dataset_add($id)
    {
        $community = $this->community_service->find_or_fail($id);
        $depositions = $this->deposition_service->my_depositions();
        return view('community.dataset_add',['community' => $community, 'depositions' => $depositions]);
    }

    public function dataset_add_p(Request $request)
    {
        $community_id = $request->input('community_id');
        $community = $this->community_service->find($community_id);
        $datasets = $request->input('datasets');

        foreach($datasets as $dataset_id) {
            $community_dataset = $this->community_service->add_dataset($community,$dataset_id);
            $this->community_service->add_dataset_owner($community_dataset);
            $this->community_service->increase_number_of_datasets($community);
        }

        return redirect()->route('community.view',$community_id)->with('success','Datasets added successfully');

    }
}
