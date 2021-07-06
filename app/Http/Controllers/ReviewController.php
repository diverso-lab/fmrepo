<?php

namespace App\Http\Controllers;

use App\Http\Services\RequestReviewService;
use App\Http\Services\ReviewService;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private $request_service;
    private $review_service;

    public function __construct()
    {
        $this->middleware('auth');
        $this->request_service = new RequestReviewService();
        $this->review_service = new ReviewService();
    }

    public function list()
    {
        $requests = $this->request_service->all();
        return view('reviewer.review.request', ['requests' => $requests]);
    }

    public function verificate($id)
    {
        $request_review = $this->request_service->find_or_fail($id);
        return view('reviewer.review.verificate',['request_review' => $request_review]);
    }

    public function verificate_p(Request $request)
    {
        $review = Review::create([
            'request_review_id' => $request->input('request_review_id'),
            'verificate' => true
        ]);

        return $review;
    }
}
