<?php

namespace App\Http\Controllers;

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

       /* $deposition_data = [
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
        $response = $zenodo->post_deposition($deposition_data);


        $deposition_id = $response['id'];

       */

        // TODO: Una vez que tenemos el deposito subido, iteramos
        // sobre cada archivo y vamos haciendo post

        $file_data = ['name' => 'nombre de prueba de archivo'];
        $file = Storage::get('public/harrypotter.jpg');

        //$file = fopen("/Users/davidromeroorganvidez/Desktop/fmrepo/storage/app/public/harrypotter.jpg", "a");

        $response = $zenodo->post_file_in_deposition('4724865',$file_data,$file);

        return $response;
    }
}
