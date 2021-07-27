<?php

namespace App\Http\Services;

use App\Models\Dataset;
use App\Models\Deposition;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

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
        $depositions = $this->zenodo->get_depositions();

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

                $files = $this->zenodo->get_files_by_deposition($new_deposition->record_id);
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

    private function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }

    public function create_deposition_data($request)
    {
        // TODO: Hay que iterar sobre los autores con un splitter (;)

        $authors = $request->input('authors');
        $authors_array = explode(";", $authors);
        $authors_associative_array = array();

        foreach ($authors_array as $value){
            //$array = array("name" => $value);
            //array_push($authors_associative_array, $array);
            $this->array_push_assoc($authors_associative_array,"name",$value);
        }

        return [
            'metadata' => [
                'upload_type' => 'software',
                'publication_date' => Carbon::now()->format('Y-m-d'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'creators' => [
                    ["name" => "Doe, John"]
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

    public function upload_files_to_zenodo_and_repo($zenodo_deposition,$repo_deposition,$request)
    {
        $token = $request->session()->token();
        $deposition_id = $zenodo_deposition['id'];
        $tmp = '/tmp/'.$token.'/';

        foreach (Storage::allFiles($tmp) as $filename) {

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

    public function get_branch_name_from_github_repository($request)
    {
        $github_repo = $request->input('github');
        $github_repo = parse_url($github_repo)["path"];
        $branch_name = "";

        $headers = [
            'Content-Type' => 'application/json',
            'accept' => 'application/vnd.github.v3+json'
        ];

        $client = new Client([
            'headers' => $headers,
            'base_uri' => 'https://api.github.com/'
        ]);

        try {
            $response = $client->request('GET', 'repos'.$github_repo.'/branches');
            $branch_name = json_decode($response->getBody(), true)[0]["name"];
        }catch (Exception $e)
        {
            return 401;
        }

        return $branch_name;
    }

    public function download_and_save_github_repository($request)
    {
        // info about repo
        $github_repo = $request->input('github');
        $github_repo = str_replace(".git", "", $github_repo);
        $token = $request->session()->token();
        $branch_name = $this->get_branch_name_from_github_repository($request);

        // create temporary folder to download GitHub repository
        Storage::makeDirectory("tmp/".$token);
        $destination_zip = "/".storage_path('app/tmp/'.$token)."/".$branch_name.".zip";

        // download GitHub repository in temporary folder zip
        file_put_contents($destination_zip,
            file_get_contents($github_repo."/archive/refs/heads/".$branch_name.".zip")
        );

        return $destination_zip;
    }

    public function save_zip($request)
    {
        $token = $request->session()->token();
        $zip_file = $request->file('zip');
        return Storage::putFileAs('/tmp/'.$token.'/', $zip_file, $zip_file->getClientOriginalName());
    }

    public function unzip($zenodo_deposition, $request)
    {
        $zip_file = $request->file('zip');
        $deposition_id = $zenodo_deposition['id'];

        try {
            $zip = new ZipArchive;
            if ($zip->open($zip_file) === TRUE) {
                $zip->extractTo(storage_path('app/dataset').'/deposition_'.$deposition_id);
                $zip->close();
                echo "<br>extraccion correcta";
            } else {
                echo "Error during the unzip";
            }
        }catch(\Exception $e){
            echo $e;
        }
    }

    public function unzip_from_github_zip($zenodo_deposition, $zip_path, $request)
    {
        // get ZIP information
        $token = $request->session()->token();
        $deposition_id = $zenodo_deposition['id'];
        $name = pathinfo($zip_path, PATHINFO_FILENAME);
        $extension = pathinfo($zip_path, PATHINFO_EXTENSION);
        $zip_file = Storage::get("tmp/".$token."/".$name.".".$extension);

        try {
            $zip = new ZipArchive;
            if ($zip->open($zip_path) === TRUE) {
                $zip->extractTo(storage_path('app/dataset').'/deposition_'.$deposition_id);
                $zip->close();
                echo "<br>extraccion correcta";
            } else {
                echo "Error during the unzip";
            }
        }catch(\Exception $e){
            echo $e;
        }
    }

    public function upload_zip_to_zenodo($zenodo_deposition, $zip_path, $request)
    {
        // get ZIP information
        $token = $request->session()->token();
        $deposition_id = $zenodo_deposition['id'];
        $name = pathinfo($zip_path, PATHINFO_FILENAME);
        $extension = pathinfo($zip_path, PATHINFO_EXTENSION);
        $file = Storage::get("tmp/".$token."/".$name.".".$extension);
        $file_data = ['name' => $name.'.'.$extension];

        // upload zip to Zenodo
        $this->zenodo->post_file_in_deposition($deposition_id,$file_data,$file);

        return 0;

    }

    public function delete_tmp_folder($request)
    {
        $token = $request->session()->token();
        Storage::deleteDirectory('/tmp/'.$token);

        return 0;
    }

    public function save_textplain($request)
    {
        $token = $request->session()->token();
        $textplain = $request->input('textplain');
        Storage::put('tmp/'.$token.'/textplain.txt', $textplain);
    }

    public function upload_textplain_to_zenodo($zenodo_deposition, $request)
    {
        $token = $request->session()->token();
        $file = Storage::get("tmp/".$token."/textplain.txt");
        $file_data = ['name' => "textplain.txt"];

        $deposition_id = $zenodo_deposition['id'];
        $this->zenodo->post_file_in_deposition($deposition_id,$file_data,$file);
    }

    public function save_textplain_in_repo($zenodo_deposition, $request)
    {
        $token = $request->session()->token();
        $deposition_id = $zenodo_deposition['id'];
        $old_directory = "tmp/".$token."/textplain.txt";
        $new_directory = '/dataset/deposition_'.$deposition_id.'/textplain.txt';

        // move into local storage
        Storage::move($old_directory, $new_directory);
    }

}