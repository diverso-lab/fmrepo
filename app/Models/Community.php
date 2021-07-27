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
        return $this->hasMany('App\Models\AdminCommunity');
    }

    public function datasets_community()
    {
        return $this->hasMany('App\Models\DataSetCommunity');
    }
}
