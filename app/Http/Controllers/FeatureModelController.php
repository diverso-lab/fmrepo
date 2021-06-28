<?php

namespace App\Http\Controllers;

use App\Http\Services\DepositionService;
use App\Models\Deposition;
use App\Models\FeatureModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FeatureModelController extends Controller
{
    public function list()
    {
        $feature_models = Auth::user()->feature_models();
        return view('researcher.model.list', ['feature_models' => $feature_models]);
    }

    public function upload()
    {
        return view('researcher.upload_model');
    }

    public function upload_computer(Request $request)
    {

        $request->validate([
            'title' => '',
            'description' => '',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $zenodo = new \Zenodo();

        $deposition_data = [
            'metadata' => [
                'upload_type' => 'software',
                'publication_date' => '2021-04-28',
                //'title' => $request->input('title'),
                'title' => 'new title',
                //'description' => $request->input('description'),
                'description' => 'new description',
                'creators' => [
                    ['name' => 'anonymous']
                ],
                'access_right' => 'open',
                'license' => 'cc-zero',
                'prereserve_doi' => true
            ]

        ];

        // upload deposition to Zenodo through API REST
        $uploaded_deposition = $zenodo->post_deposition($deposition_data);

        // create Feature Model into FMPREPO
        //FeatureModel::create();
        //$feature_model = Auth::user()->feature_models()->create([]);

        $new_feature_model = FeatureModel::create();
        $new_feature_model->save();

        $new_deposition = Deposition::create([
            'conceptrecid' => $uploaded_deposition['conceptrecid'],
            'created' => $uploaded_deposition['created'],
            'modified' => $uploaded_deposition['modified'],
            'doi' => $uploaded_deposition['doi'],
            'doi_url' => $uploaded_deposition['doi_url'],
            'owner' => $uploaded_deposition['owner'],
            'record_id' => $uploaded_deposition['record_id'],
            'state' => $uploaded_deposition['state'],
            'submitted' => $uploaded_deposition['submitted'],
            'access_right' => $uploaded_deposition['metadata']['access_right'],
            'title' => $uploaded_deposition['metadata']['title'],
            'description' => $uploaded_deposition['metadata']['description'],
            'license' => $uploaded_deposition['metadata']['license'] ?? '',
            'upload_type' => $uploaded_deposition['metadata']['upload_type'],
            'feature_model_id' => $new_feature_model->id
        ]);
        $new_deposition->save();

        // upload files to Zenodo
        $deposition_id = $uploaded_deposition['id'];
        $token = $request->session()->token();
        $tmp = '/tmp/'.$token.'/';

        foreach (Storage::files($tmp) as $filename) {

            $name = pathinfo($filename, PATHINFO_FILENAME);
            $type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $old_directory = $filename;
            $new_directory = '/featuremodels/deposition_'.$deposition_id.'/'.$name.'.'.$type;

            $file = Storage::get($filename);
            $file_data = ['name' => $name];

            try{

                $new_file = $zenodo->post_file_in_deposition($deposition_id,$file_data,$file);

                $new_deposition->files()->create([
                    'checksum' => $new_file['checksum'],
                    'filename' => $new_file['filename'],
                    'filesize' => $new_file['filesize'],
                    'file_id' => $new_file['id'],
                    'download_link' => $new_file['links']['download'],
                    'self_link' => $new_file['links']['self']
                ]);

                // move into local storage
                Storage::move($old_directory, $new_directory);

            } catch (\Exception $e) {

            }

        }

        //$service = new DepositionService();
        //$service->load();

        //return redirect()->route('researcher.deposition.list')->with('success','Deposition created successfully');

    }
}
