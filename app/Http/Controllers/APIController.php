<?php

namespace App\Http\Controllers;

use App\Http\Services\CommunityService;
use App\Http\Services\DatasetService;
use App\Http\Services\DepositionService;
use App\Models\DeveloperToken;
use App\Models\DeveloperTokenScope;
use Illuminate\Http\Request;

class APIController extends Controller
{
    private $dataset_service;
    private $deposition_service;
    private $community_service;

    public function __construct()
    {
        $this->dataset_service = new DatasetService();
        $this->deposition_service = new DepositionService();
        $this->community_service = new CommunityService();
    }

    public function docs()
    {
        return view('api.docs');
    }

    private function token_exists($access_token)
    {
        $maybe_a_token = DeveloperToken::where('token',$access_token)->first();
        return $maybe_a_token != null;
    }

    private function token_has_the_necessary_scope($access_token, $scope)
    {

        $res = false;
        $token = DeveloperToken::where('token',$access_token)->first();
        $token_scopes = $token->scopes;

        foreach($token_scopes as $token_scope){

            if(strcmp($token_scope->scope,$scope) == 0){
                $res = true;
                break;
            }
        }

        return $res;

    }

    private function access_token_validate($request, $scope = 'GET')
    {
        $access_token = $request->input('access_token');

        if($access_token == null){
            return response()->json(['error' => '400 Bad Request. The access token has not been provided.'], 400);
        }

        if(!$this->token_exists($access_token)){
            return response()->json(['error' => '401 Unauthorized. Is it a valid token?'], 401);
        }

        if(!$this->token_has_the_necessary_scope($access_token,$scope)){
            return response()->json(['error' => '401 Unauthorized. Check the scopes allowed for your token'], 401);
        }

        return response()->json(['success' => 'OK.']);
    }

    public function dataset_list(Request $request)
    {

        $response = $this->access_token_validate($request);

        if($response->status() == 200){

            $data = array();

            $depositions = $this->deposition_service->all();

            foreach ($depositions as $deposition){

                $files = array();

                foreach ($deposition->files as $file) {
                    $file = array(
                        'file_name' => $file->filename,
                        'file_size' => $file->filesize,
                        'zenodo_download_link' => $file->download_link,
                        'checksum' => $file->checksum
                    );
                    array_push($files,$file);
                }

                $dataset = array(
                    'id' => $deposition->dataset->id,
                    'created_at' => $deposition->created_at,
                    'updated_at' => $deposition->updated_at,
                    'doi' => $deposition->doi,
                    'doi_url' => $deposition->doi_url,
                    'zenodo_id' => $deposition->record_id,
                    'access_right' => $deposition->access_right,
                    'title' => $deposition->title,
                    'description' => $deposition->description,
                    'download_url' => route('dataset.download',$deposition->dataset->id),
                    'files' => $files
                );

                array_push($data, $dataset);
            }

            return response()->json(['datasets' => $data]);

        }

        return $response;

    }
}
