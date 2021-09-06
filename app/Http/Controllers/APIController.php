<?php

namespace App\Http\Controllers;

use App\Http\Services\APIService;
use App\Http\Services\CommunityService;
use App\Http\Services\DatasetService;
use App\Http\Services\DepositionService;
use App\Models\Community;
use App\Models\Dataset;
use App\Models\Deposition;
use App\Models\DeveloperToken;
use App\Models\DeveloperTokenScope;
use Illuminate\Http\Request;

class APIController extends Controller
{
    private $dataset_service;
    private $deposition_service;
    private $community_service;
    private $api_service;

    public function __construct()
    {
        $this->dataset_service = new DatasetService();
        $this->deposition_service = new DepositionService();
        $this->community_service = new CommunityService();
        $this->api_service = new APIService();
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

    /*
     *  API END POINTS
     */

    public function dataset_list(Request $request)
    {

        $response = $this->access_token_validate($request);

        if($response->status() == 200){

            $data = array();

            $depositions = $this->deposition_service->all();
            foreach ($depositions as $deposition){

                $dataset = $this->api_service->dataset_array($deposition);
                array_push($data, $dataset);
            }

            return response()->json(['datasets' => $data]);

        }

        return $response;

    }

    public function dataset_get(Request $request)
    {
        $response = $this->access_token_validate($request);

        if($response->status() == 200){

            $dataset_id = $request->route('id');
            $dataset = Dataset::find($dataset_id);

            if($dataset == null){
                return response()->json(['error' => '400 Bad Request. Check that the dataset id is correct.'], 400);
            }

            $data = $this->api_service->dataset_array($dataset->deposition);

            return response()->json(['dataset' => $data]);

        }

        return $response;
    }

    public function dataset_files(Request $request)
    {
        $response = $this->access_token_validate($request);

        if($response->status() == 200){

            $dataset_id = $request->route('id');
            $dataset = Dataset::find($dataset_id);

            if($dataset == null){
                return response()->json(['error' => '400 Bad Request. Check that the dataset id is correct.'], 400);
            }

            $data = $this->api_service->files_array($dataset->deposition);

            return response()->json(['files' => $data]);

        }

        return $response;
    }

    public function communities_list(Request $request)
    {
        $response = $this->access_token_validate($request);

        if($response->status() == 200){

            $data = array();

            $communities = $this->community_service->all();
            foreach ($communities as $community){

                $community_array = $this->api_service->community_array($community);
                array_push($data, $community_array);
            }

            return response()->json(['communities' => $data]);

        }

        return $response;
    }

    public function community_get(Request $request)
    {
        $response = $this->access_token_validate($request);

        if($response->status() == 200){

            $community_id = $request->route('id');
            $community = Community::find($community_id);

            if($community == null){
                return response()->json(['error' => '400 Bad Request. Check that the community id is correct.'], 400);
            }

            $data = $this->api_service->community_array($community);

            return response()->json(['community' => $data]);

        }

        return $response;
    }

    public function community_members(Request $request)
    {
        $response = $this->access_token_validate($request);

        if($response->status() == 200){

            $community_id = $request->route('id');
            $community = Community::find($community_id);

            if($community == null){
                return response()->json(['error' => '400 Bad Request. Check that the community id is correct.'], 400);
            }

            $data = $this->api_service->members_array($community);

            return response()->json(['members' => $data]);

        }

        return $response;
    }

    public function community_admins(Request $request)
    {
        $response = $this->access_token_validate($request);

        if($response->status() == 200){

            $community_id = $request->route('id');
            $community = Community::find($community_id);

            if($community == null){
                return response()->json(['error' => '400 Bad Request. Check that the community id is correct.'], 400);
            }

            $data = $this->api_service->admins_array($community);

            return response()->json(['admins' => $data]);

        }

        return $response;
    }

    public function community_datasets(Request $request)
    {
        $response = $this->access_token_validate($request);

        if($response->status() == 200){

            $community_id = $request->route('id');
            $community = Community::find($community_id);

            if($community == null){
                return response()->json(['error' => '400 Bad Request. Check that the community id is correct.'], 400);
            }

            $data = $this->api_service->datasets_array($community);

            return response()->json(['datasets' => $data]);

        }

        return $response;
    }
}
