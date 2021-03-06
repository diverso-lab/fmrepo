<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;

    protected $table = "datasets";

    protected $fillable = [
        'user_id'
    ];

    public function deposition()
    {
        return $this->hasOne('App\Models\Deposition')->orderByDesc('modified');
    }

    public function request_review()
    {
        return $this->hasOne('App\Models\RequestReview');
    }

    public function dataset_community()
    {
        return $this->hasOne('App\Models\DataSetCommunity');
    }
}
