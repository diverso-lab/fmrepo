<?php


namespace App\Http\Services;

use App\Models\Community;
use App\Models\CommunityAdmin;
use App\Models\CommunityDataset;
use App\Models\CommunityDatasetOwner;
use App\Models\CommunityMember;
use Illuminate\Support\Facades\Auth;

class CommunityService extends Service
{

    public function __construct()
    {
        parent::__construct(Community::class);
        parent::set_validation_rules([
            'name' => 'required',
            'organisation' => 'required',
            'info' => 'required'
        ]);
    }

    public function add_me_as_admin($community)
    {
        $me = Auth::user();
        $admin = CommunityAdmin::where('user_id',$me->id)->first();

        if($admin == null) {
            $admin = CommunityAdmin::create([
                'user_id' => $me->id
            ]);
            $admin->save();
        }

        $admin->communities()->attach($community);
    }

    public function increase_number_of_members($community)
    {
        $community->number_of_members = $community->number_of_members + 1;
        $community->save();
    }

    public function decrease_number_of_members($community)
    {
        $community->number_of_members = $community->number_of_members - 1;
        $community->save();
    }

    public function increase_number_of_datasets($community)
    {
        $community->number_of_datasets = $community->number_of_datasets + 1;
        $community->save();
    }

    public function decrease_number_of_datasets($community)
    {
        $community->number_of_datasets = $community->number_of_datasets - 1;
        $community->save();
    }

    public function my_communities()
    {
        $res = collect();
        $me = Auth::user();
        $community_admin = $me->community_admin();
        if($community_admin->first() != null){
            $res = $community_admin->first()->communities()->get();
        }
        return $res;
    }

    public function create_community_member_by_user_id($user_id)
    {
        $community_member = CommunityMember::where('user_id',$user_id)->first();
        if($community_member != null){
            return $community_member;
        }else{
            return CommunityMember::create(['user_id' => $user_id]);
        }

    }

    public function add_community_member($community, $community_member_id)
    {
        $community->members()->attach($community_member_id);
    }

    public function add_dataset($community, $dataset_id)
    {
        return CommunityDataset::create([
            'dataset_id' => $dataset_id,
            'community_id' => $community->id
        ]);
    }

    public function add_dataset_owner($community_dataset)
    {
        $me = Auth::user();
        return CommunityDatasetOwner::create([
           'user_id' => $me->id,
            'community_dataset_id' =>  $community_dataset->id
        ]);
    }

}