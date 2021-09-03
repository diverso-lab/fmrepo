<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperTokenScope extends Model
{
    protected $table = 'developertokenscopes';

    protected $fillable = [
        'scope',
        'developer_token_id'
    ];

    use HasFactory;

    public function developer_token()
    {
        return $this->belongsTo('App\Models\DeveloperToken');
    }
}
