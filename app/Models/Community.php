<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'organisation',
        'info',
        'number_of_members',
        'number_of_datasets'
    ];

    public function admins()
    {
        return $this->belongsToMany('App\Models\CommunityAdmin','communityadmin_community');
    }

    public function members()
    {
        return  $this->belongsToMany('App\Models\CommunityMember', 'community_communitymember');
    }

    public function datasets()
    {
        return $this->hasMany('App\Models\CommunityDataset');
    }

    public function I_belong_to_this_community()
    {
        return $this->I_am_member() || $this->I_am_admin();
    }

    public function I_am_admin()
    {
        $me = Auth::user();
        $res = false;
        foreach($this->admins()->get() as $admin){
            if($admin->user_id == $me->id){
                $res = true;
                break;
            }
        }
        return $res;
    }

    public function I_am_member()
    {
        $me = Auth::user();
        $res = false;
        foreach($this->members()->get() as $member){
            if($member->user_id == $me->id){
                $res = true;
                break;
            }
        }
        return $res;
    }
}
