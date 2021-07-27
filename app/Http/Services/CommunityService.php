<?php


namespace App\Http\Services;


use App\Models\AdminCommunity;
use App\Models\Community;
use App\Models\CommunityAdmin;
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

    public function my_communities()
    {
        $me = Auth::user();
        $community_admin = $me->community_admin();
        return $community_admin->first()->communities()->get();
    }

}