<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return  $this->hasMany('App\Models\CommunityMember');
    }

    public function datasets()
    {
        return $this->hasMany('App\Models\CommunityDataset');
    }
}
