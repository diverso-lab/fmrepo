<?php

namespace App\Http\Controllers;

use App\Http\Services\APIService;
use App\Http\Services\CommunityService;
use App\Http\Services\DatasetService;
use App\Http\Services\DepositionService;
use App\Models\Community;
use App\Models\Dataset;
use App\Models\DeveloperToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    private function get_user_by_token($request)
    {
        $access_token = $request->input('access_token');
        $token = DeveloperToken::where('token',$access_token)->first();
        return $token->user;
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

    public function dataset_post(Request $request)
    {
        $response = $this->access_token_validate($request, "PUT");

        if($response->status() == 200){

            // Rules need to be redefined because the API does not need a g-recaptcha-response
            $validation_rules = [
                'title' => 'required',
                'description' => 'required'
            ];

            $validator = Validator::make($request->all(), $validation_rules);
            if ($validator->passes()) {

                try{
                    // basic deposition data
                    $deposition_data = $this->deposition_service->create_deposition_data($request);

                    // upload deposition to Zenodo through REST API
                    $zenodo_deposition = $this->deposition_service->post_deposition_to_zenodo($deposition_data);

                    // upload deposition to REPO
                    $repo_deposition = $this->deposition_service->post_deposition_to_repo($zenodo_deposition);

                    // add token owner user
                    $user = $this->get_user_by_token($request);
                    $repo_deposition->user_id = $user->id;
                    $repo_deposition->save();

                    // return to API request
                    $dataset_array = $this->api_service->dataset_array($repo_deposition);
                    return response()->json(['dataset' => $dataset_array], 201);

                }catch(\Exception $e){
                    return response()->json(['error' => '500 Internal Server Error. There seems to be a problem uploading your dataset. Please try again later or contact us.'], 500);
                }

            } else {
                return response()->json(['errors' => $validator->errors()->all()], 400);
            }

        }

        return $response;
    }

    public function dataset_publish(Request $request)
    {
        $response = $this->access_token_validate($request);

        if($response->status() == 200){

            $user = $this->get_user_by_token($request);
            $dataset_id = $request->route('id');
            $dataset = Dataset::find($dataset_id);

            if($dataset == null){
                return response()->json(['error' => '400 Bad Request. Check that the dataset id is correct.'], 400);
            }

            // if dataset is not from my property
            if($dataset->deposition->user_id != $user->id){
                return response()->json(['error' => '403 Forbidden. Check that the dataset is one that you created.'], 403);
            }


            // if the dataset has no files
            if($dataset->deposition->files->count() == 0){
                return response()->json(['error' => '400 Bad Request. Minimum one file must be provided before publishing the dataset.'], 400);
            }

            // it is already published
            if($dataset->deposition->state == "done"){
                return response()->json(['error' => '400 Bad Request. The dataset has already been published.'], 400);
            }

            // publish deposition in Zenodo
            try{
                $deposition = $this->deposition_service->publish($dataset->deposition);
                $dataset_array = $this->api_service->dataset_array($deposition);
                return response()->json(['dataset' => $dataset_array]);
            }catch (\Exception $e){
                return response()->json(['error' => '500 Internal Server Error. There seems to be a problem publishing your dataset. Please try again later or contact us.'], 500);
            }

            /*

            // request for review
            $data = array(
                'dataset_id' => $dataset->id,
                'email' => $request->input('email') ?? '',
                'type_journal' => !empty($request->input('doi_conference') ? $request->input('doi_conference') : '0'),
                'type_conference' => $request->input('type_conference') === 'true' ?? '',
                'type_workshop' => $request->input('type_workshop') === 'true' ?? '',
                'type_tool' => $request->input('type_tool') === 'true' ?? '',
                'doi_journal' => $request->input('doi_journal') ?? '',
                'doi_conference' => $request->input('doi_conference') ?? '',
                'doi_workshop' => $request->input('doi_workshop') ?? '',
                'doi_tool' => $request->input('doi_tool') ?? ''
            );
            $this->dataset_service->create_request_for_review($dataset,$data);

            */



        }

        return $response;
    }

    public function dataset_files_upload_simple(Request $request)
    {
        $request->files;
        $file = $request->file('file');
        return response()->json(['file' => $file->extension()], 200);
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
