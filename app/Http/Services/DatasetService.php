<?php


namespace App\Http\Services;


use App\Models\Dataset;
use App\Models\RequestReview;

class DatasetService extends Service
{

    private $deposition_service;

    public function __construct()
    {
        parent::__construct(Dataset::class);
        $this->deposition_service = new DepositionService();
    }

    public function create_request_for_review($dataset,$data)
    {
        $request_review = RequestReview::create([
            'dataset_id' => $dataset->id,
            'email' => $data['email'] ?? '',
            'type_journal' => $data['type_journal'] === 'true' ?? '',
            'type_conference' => $data['type_conference'] === 'true' ?? '',
            'type_workshop' => $data['type_workshop'] === 'true' ?? '',
            'type_tool' => $data['type_tool'] === 'true' ?? '',
            'doi_journal' => $data['doi_journal'] ?? '',
            'doi_conference' => $data['doi_conference'] ?? '',
            'doi_workshop' => $data['doi_workshop'] ?? '',
            'doi_tool' => $data['doi_tool'] ?? ''
        ]);
        return $request_review;
    }

    public function all_published_dataset()
    {
        $datasets = $this->all();

        $filtered = $datasets->reject(function ($dataset, $key) {
            return $dataset->deposition->state == "unsubmitted";
        });

        return $filtered->all();

    }

}