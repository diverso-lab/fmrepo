<?php

namespace App\Http\Controllers;

use App\Http\Services\DatasetService;
use App\Http\Services\DepositionService;
use App\Models\Deposition;
use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZanySoft\Zip\Zip;
use ZipArchive;

class DatasetController extends Controller
{
    private $dataset_service;
    private $deposition_service;

    public function __construct()
    {
        $this->dataset_service = new DatasetService();
        $this->deposition_service = new DepositionService();
    }

    public function list()
    {
        $datasets = $this->dataset_service->all();
        return view('dataset.list', ['datasets' => $datasets]);
    }

    public function view($id)
    {
        $dataset = $this->dataset_service->find_or_fail($id);
        return view('dataset.view',['dataset' => $dataset]);
    }

    public function upload()
    {
        return view('dataset.upload');
    }

    public function upload_computer(Request $request)
    {

        $this->deposition_service->validate();

        return "stop";

        // basic deposition data
        $deposition_data = $this->deposition_service->create_deposition_data($request);

        // upload deposition to Zenodo through REST API
        $zenodo_deposition = $this->deposition_service->post_deposition_to_zenodo($deposition_data);

        // upload deposition to REPO
        $repo_deposition = $this->deposition_service->post_deposition_to_repo($zenodo_deposition);

        // upload files to Zenodo
        $this->deposition_service->upload_files_to_zenodo_and_repo($zenodo_deposition,$repo_deposition,$request);

        // publish deposition in Zenodo
        $this->deposition_service->publish($repo_deposition);

        // TODO: Send new upload to email

        // request for review
        $dataset = $repo_deposition->dataset;
        $data = ['email' => $request->input('email'), 'doi_url' => $request->input('doi_url')];
        $this->dataset_service->create_request_for_review($dataset,$data);

        return redirect()->route('dataset.list')->with('success','Dataset uploaded successfully');

    }

    public function upload_github(Request $request){

        $request->validate([
            'title' => '',
            'description' => '',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $zenodo = new \Zenodo();
        $github_repo = $request->input('github');

        shell_exec(('cd ./storage/app/ & git clone '.$github_repo));

    }

    /**
     * @throws \Exception
     */
    public function upload_zip(Request $request)
    {
        $this->deposition_service->validate();

        // basic deposition data
        $deposition_data = $this->deposition_service->create_deposition_data($request);

        // upload deposition to Zenodo through REST API
        $zenodo_deposition = $this->deposition_service->post_deposition_to_zenodo($deposition_data);

        // upload deposition to REPO
        $repo_deposition = $this->deposition_service->post_deposition_to_repo($zenodo_deposition);

        // upload files to Zenodo
        $this->deposition_service->unzip($request);


        $this->deposition_service->upload_files_to_zenodo_and_repo($zenodo_deposition,$repo_deposition,$request);

        // publish deposition in Zenodo
        $this->deposition_service->publish($repo_deposition);

        // TODO: Send new upload to email

        // request for review
        $dataset = $repo_deposition->dataset;
        $data = ['email' => $request->input('email'), 'doi_url' => $request->input('doi_url')];
        $this->dataset_service->create_request_for_review($dataset,$data);

        return redirect()->route('dataset.list')->with('success','Dataset uploaded successfully');

    }
}
