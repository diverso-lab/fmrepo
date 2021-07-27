<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityAdmin extends Model
{
    use HasFactory;

    protected $table = "communityadmins";

    protected $fillable = [
        'user_id'
    ];

    public function communities()
    {
        return $this->belongsToMany('App\Models\Community','communityadmin_community');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
