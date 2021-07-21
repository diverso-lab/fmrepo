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
            'type_journal' => $data['type_journal'],
            'type_conference' => $data['type_conference'],
            'type_workshop' => $data['type_workshop'],
            'type_tool' => $data['type_tool'],
            'doi_journal' => $data['doi_journal'],
            'doi_conference' => $data['doi_conference'],
            'doi_workshop' => $data['doi_workshop'],
            'doi_tool' => $data['doi_tool']
        ]);
        return $request_review;
    }

}