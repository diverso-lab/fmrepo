<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperTokenScope extends Model
{
    protected $table = 'developertokenscopes';

    use HasFactory;

    public function token()
    {
        return $this->belongsTo('App\Models\DeveloperToken');
    }
}
