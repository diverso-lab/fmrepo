<?php

namespace App\Http\Services;

use App\Models\Deposition;
use Illuminate\Support\Facades\Auth;

class DepositionService extends Service
{

    public function __construct()
    {
        parent::__construct(Deposition::class);

        parent::set_validation_rules([
            'title' => 'required',
            'description' => 'required'
        ]);
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
}