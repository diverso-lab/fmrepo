<?php

namespace App\Http\Controllers;

use Filepond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    private $filepond;

    public function __construct(Filepond $filepond)
    {
        $this->filepond = $filepond;
    }

    public function process(Request $request)
    {

        $token = $request->session()->token();

        $files = $request->file('files');

        $file = $files[0];
        $path = Storage::putFileAs('/tmp/'.$token.'/', $file, $file->getClientOriginalName());

        return Response::make($this->filepond->getServerIdFromPath($path), 200, [
            'Content-Type' => 'text/plain',
        ]);

    }

    public function delete(Request $request)
    {

        $path = $this->filepond->getPathFromServerId($request->getContent());
        Storage::delete($path);

        return Response::make('', 200, [
            'Content-Type' => 'text/plain',
        ]);

    }
}
