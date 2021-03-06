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
        'type_journal',
        'type_conference',
        'type_workshop',
        'type_tool',
        'doi_journal',
        'doi_conference',
        'doi_workshop',
        'doi_tool',
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

    public function review()
    {
        return $this->hasOne('App\Models\Review');
    }
}
