<?php

namespace App\Http\Controllers;

use App\Http\Services\DepositionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FeatureModelController extends Controller
{
    public function upload()
    {
        return view('researcher.upload_model');
    }

    public function upload_p(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $zenodo = new \Zenodo();

        $deposition_data = [
            'metadata' => [
                'upload_type' => 'software',
                'publication_date' => '2021-04-28',
                'title' => $request->input('title'),
                'creators' => [
                    ['name' => Auth::user()->name.' '.Auth::user()->surname]
                ],
                'description' => $request->input('description'),
                'access_right' => 'open',
                'prereserve_doi' => true
            ]

        ];

        // publish deposition
        $response = $zenodo->post_deposition($deposition_data);

        // upload files to Zenodo
        $deposition_id = $response['id'];
        $user = Auth::user();
        $token = $request->session()->token();
        $tmp = '/tmp/'.$user->username.'/'.$token.'/';

        foreach (Storage::files($tmp) as $filename) {

            $name = pathinfo($filename, PATHINFO_FILENAME);
            $type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $size = Storage::size($filename);
            $old_directory = $filename;
            $new_directory = '/models/'.$user->username.'/deposition_'.$deposition_id.'/'.$name.'.'.$type;

            $file = Storage::get($filename);
            $file_data = ['name' => $name];

            try{
                // move
                Storage::move($old_directory, $new_directory);

                $response = $zenodo->post_file_in_deposition($deposition_id,$file_data,$file);

                // TODO: Saving deposition file
            } catch (\Exception $e) {

            }

        }

        $service = new DepositionService();
        $service->load();

        return redirect()->route('researcher.deposition.list')->with('success','Deposition created successfully');

    }
}
