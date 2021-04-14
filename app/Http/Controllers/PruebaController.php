<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PruebaController extends Controller
{
    public function prueba()
    {

        $zenodo = new \Zenodo();

        $depositions = $zenodo->get_depositions();

        var_dump($depositions);

        echo "Depositions";
        echo "<br>";
        foreach($depositions as $deposition)
        {
            echo $deposition['metadata']['title'];
        }

        $files = $zenodo->get_files_by_deposition($depositions[0]['id']);

        var_dump($files);

    }
}
