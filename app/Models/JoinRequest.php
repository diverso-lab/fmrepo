<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    use HasFactory;

    protected $table = 'joinrequests';

    protected $fillable = [
        'user_id',
        'community_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function community()
    {
        return $this->belongsTo('App\Models\Community');
    }
}
