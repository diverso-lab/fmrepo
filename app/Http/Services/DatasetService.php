<?php


namespace App\Http\Services;


use App\Models\Dataset;
use App\Models\RequestReview;

class DatasetService extends Service
{

    public function __construct()
    {
        parent::__construct(Dataset::class);
    }

    public function create_request_for_review($dataset,$data)
    {
        $request_review = RequestReview::create([
            'dataset_id' => $dataset->id,
            'email' => $data['email'],
            'doi_url' => $data['doi_url']
        ]);
        return $request_review;
    }

}