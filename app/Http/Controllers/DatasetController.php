<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $zenodo = new \Zenodo();

        $deposition_data = [
            'metadata' => [
                'upload_type' => 'software',
                'publication_date' => '2021-04-28',
                'title' => $request->input('title'),
                'description' => $request->input('description'),
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

        // create Dataset into FMPREPO
        $new_dataset = Dataset::create();

        $new_deposition = Deposition::create([
            'conceptrecid' => $uploaded_deposition['conceptrecid'],
            'created' => $uploaded_deposition['created'],
            'modified' => $uploaded_deposition['modified'],
            'doi' => $uploaded_deposition['doi'],
            'doi_url' => $uploaded_deposition['doi_url'],
            'prereserve_doi' => $uploaded_deposition['metadata']['prereserve_doi']['doi'],
            'owner' => $uploaded_deposition['owner'],
            'record_id' => $uploaded_deposition['record_id'],
            'state' => $uploaded_deposition['state'],
            'submitted' => $uploaded_deposition['submitted'],
            'access_right' => $uploaded_deposition['metadata']['access_right'],
            'title' => $uploaded_deposition['metadata']['title'],
            'description' => $uploaded_deposition['metadata']['description'],
            'license' => $uploaded_deposition['metadata']['license'] ?? '',
            'upload_type' => $uploaded_deposition['metadata']['upload_type'],
            'dataset_id' => $new_dataset->id
        ]);

        // upload files to Zenodo
        $deposition_id = $uploaded_deposition['id'];
        $token = $request->session()->token();
        $tmp = '/tmp/'.$token.'/';

        foreach (Storage::files($tmp) as $filename) {

            $name = pathinfo($filename, PATHINFO_FILENAME);
            $type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $old_directory = $filename;
            $new_directory = '/dataset/deposition_'.$deposition_id.'/'.$name.'.'.$type;

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
