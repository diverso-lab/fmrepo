<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperToken extends Model
{
    use HasFactory;

    protected $table = 'developertokens';

    protected $fillable = [
        'token'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopes()
    {
        return $this->hasMany('App\Models\DeveloperTokenScope');
    }
}
