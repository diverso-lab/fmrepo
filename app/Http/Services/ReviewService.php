<?php

namespace App\Http\Services;

use App\Models\Dataset;
use App\Models\Deposition;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewService extends Service
{

    public function __construct()
    {
        parent::__construct(Review::class);

        parent::set_validation_rules([
        ]);

    }

}