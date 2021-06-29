<?php

namespace App\Http\Services;

use App\Models\Dataset;
use App\Models\Deposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DepositionService extends Service
{

    private $zenodo;

    public function __construct()
    {
        parent::__construct(Deposition::class);

        parent::set_validation_rules([
            'title' => 'required',
            'description' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $this->zenodo = new \Zenodo();
    }

    public function load()
    {

        $user = Auth::user();

        $zenodo = new \Zenodo();
        $depositions = $zenodo->get_depositions();

        foreach($depositions as $deposition)
        {

            // does this deposition exist?
            $dep = Deposition::where(['conceptrecid' => $deposition['conceptrecid']])->first();

            if($dep == null) // it doesn't exist
            {
                $new_deposition = $user->depositions()->create([

                    'conceptrecid' => $deposition['conceptrecid'],
                    'created' => $deposition['created'],
                    'modified' => $deposition['modified'],
                    'doi' => $deposition['doi'],
                    'doi_url' => $deposition['doi_url'],
                    'owner' => $deposition['owner'],
                    'record_id' => $deposition['record_id'],
                    'state' => $deposition['state'],
                    'submitted' => $deposition['submitted'],
                    'access_right' => $deposition['metadata']['access_right'],
                    'title' => $deposition['metadata']['title'],
                    'description' => $deposition['metadata']['description'],
                    'license' => $deposition['metadata']['license'] ?? '',
                    'upload_type' => $deposition['metadata']['upload_type']
                ]);

                $files = $zenodo->get_files_by_deposition($new_deposition->record_id);
                foreach($files as $file)
                {
                    $new_deposition->files()->create([
                        'checksum' => $file['checksum'],
                        'filename' => $file['filename'],
                        'filesize' => $file['filesize'],
                        'file_id' => $file['id'],
                        'download_link' => $file['links']['download'],
                        'self_link' => $file['links']['self']
                    ]);
                }

            }else{

                // has this deposit been modified?
                if($dep->modified != $deposition['modified'])
                {
                    $dep->modified = $deposition['modified'];
                    $dep->state = $deposition['state'];
                    $dep->submitted = $deposition['submitted'];

                    // update metadata
                    $dep->doi = $deposition['doi'];
                    $dep->doi_url = $deposition['doi_url'];
                    $dep->access_right = $deposition['metadata']['access_right'];
                    $dep->title = $deposition['metadata']['title'];
                    $dep->description = $deposition['metadata']['description'];
                    $dep->license = $deposition['metadata']['license'] ?? '';
                    $dep->upload_type =  $deposition['metadata']['upload_type'];

                    $dep->save();
                }

            }


        }

    }

    public function create_deposition_data($request)
    {
        return [
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
    }

    public function post_deposition_to_zenodo($deposition_data)
    {
        return $this->zenodo->post_deposition($deposition_data);
    }

    public function post_deposition_to_repo($zenodo_deposition)
    {
        // create Dataset into FMPREPO
        $new_dataset = Dataset::create();

        $repo_deposition = Deposition::create([
            'conceptrecid' => $zenodo_deposition['conceptrecid'],
            'created' => $zenodo_deposition['created'],
            'modified' => $zenodo_deposition['modified'],
            'doi' => $zenodo_deposition['doi'],
            'doi_url' => $zenodo_deposition['doi_url'],
            'prereserve_doi' => $zenodo_deposition['metadata']['prereserve_doi']['doi'],
            'owner' => $zenodo_deposition['owner'],
            'record_id' => $zenodo_deposition['record_id'],
            'state' => $zenodo_deposition['state'],
            'submitted' => $zenodo_deposition['submitted'],
            'access_right' => $zenodo_deposition['metadata']['access_right'],
            'title' => $zenodo_deposition['metadata']['title'],
            'description' => $zenodo_deposition['metadata']['description'],
            'license' => $zenodo_deposition['metadata']['license'] ?? '',
            'upload_type' => $zenodo_deposition['metadata']['upload_type'],
            'dataset_id' => $new_dataset->id
        ]);

        return $repo_deposition;
    }

    public function upload_files_to_zenodo_and_repo($zenodo_deposition,$repo_deposition,$token)
    {
        $deposition_id = $zenodo_deposition['id'];
        $tmp = '/tmp/'.$token.'/';

        foreach (Storage::files($tmp) as $filename) {

            $name = pathinfo($filename, PATHINFO_FILENAME);
            $type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $old_directory = $filename;
            $new_directory = '/dataset/deposition_'.$deposition_id.'/'.$name.'.'.$type;

            $file = Storage::get($filename);
            $file_data = ['name' => $name];

            try{

                $new_file = $this->zenodo->post_file_in_deposition($deposition_id,$file_data,$file);

                $repo_deposition->files()->create([
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
    }

    public function publish($deposition)
    {
        $new_deposition_published = $this->zenodo->publish_deposition($deposition->record_id);
        $deposition->doi = $new_deposition_published['doi'];
        $deposition->doi_url = $new_deposition_published['doi_url'];
        $deposition->state = $new_deposition_published['state'];
        $deposition->save();
        return $deposition;
    }

}