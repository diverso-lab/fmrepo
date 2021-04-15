<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZenodoToken extends Model
{
    use HasFactory;

    protected $table = "zenodo_tokens";

    protected $fillable = [
        'token',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }
}
