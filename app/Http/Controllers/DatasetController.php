<?php

namespace App\Http\Controllers;

use App\Http\Services\DatasetService;
use App\Http\Services\DepositionService;
use App\Models\Deposition;
use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DatasetController extends Controller
{
    public function list()
    {
        $datasets = Dataset::all();
        return view('dataset.list', ['datasets' => $datasets]);
    }

    public function upload()
    {
        return view('dataset.upload');
    }

    public function upload_computer(Request $request)
    {

        $service = new DepositionService();

        $service->validate();

        // basic deposition data
        $deposition_data = $service->create_deposition_data($request);

        // upload deposition to Zenodo through REST API
        $zenodo_deposition = $service->post_deposition_to_zenodo($deposition_data);

        // upload deposition to REPO
        $repo_deposition = $service->post_deposition_to_repo($zenodo_deposition);

        // upload files to Zenodo
        $token = $request->session()->token();
        $service->upload_files_to_zenodo_and_repo($zenodo_deposition,$repo_deposition,$token);

        // publish deposition in Zenodo
        $service->publish($repo_deposition);

        // request for review
        $dataset = $repo_deposition->dataset;
        $data = ['email' => $request->input('email')];
        $dataset_service = new DatasetService();
        $dataset_service->create_request_for_review($dataset,$data);

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
}
