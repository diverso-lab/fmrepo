<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCommunity extends Model
{
    use HasFactory;

    protected $table = "admincommunities";

    public function community()
    {
        return $this->belongsTo('App\Models\Community');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


}
