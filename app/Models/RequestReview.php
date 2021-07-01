<?php

namespace App\Models;

use App\Http\Services\ReviewService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestReview extends Model
{
    use HasFactory;

    protected $table = "reviewrequests";

    protected $fillable = [
        'email',
        'dataset_id'
    ];

    public function dataset()
    {
        return $this->belongsTo('App\Models\Dataset');
    }

    public function status()
    {
        $review_service = new ReviewService();
    }
}
