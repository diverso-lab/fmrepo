<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityMember extends Model
{
    use HasFactory;

    protected $table = "communitymembers";

    protected $fillable = [
        'user_id'
    ];

    public function communities()
    {
        return $this->belongsToMany('App\Models\Community', 'community_communitymember');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
