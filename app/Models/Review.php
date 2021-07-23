<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = "reviews";

    protected $fillable = [
        'request_review_id',
        'verificate',
        'comments'
    ];

    public function request_review()
    {
        return $this->belongsTo('App\Models\RequestReview');
    }
}
