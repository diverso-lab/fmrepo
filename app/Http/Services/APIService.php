<?php


namespace App\Http\Services;


use App\Models\DepositionFile;
use App\Models\DeveloperToken;
use App\Models\DeveloperTokenScope;

class APIService
{

    public function __construct()
    {

    }

    public function register_token($data)
    {
        $name = $data["name"];
        $token = \Random::getRandomString(60);
        $me = Auth()->user();

        $developer_token = DeveloperToken::create([
            'name' => $name,
            'token' => $token,
            'user_id' => $me->id
        ]);

        if($data["scope_get"] == "on"){
            DeveloperTokenScope::create([
               'scope' => 'GET',
               'developer_token_id' => $developer_token->id
            ]);
        }

        if($data["scope_post"] == "on"){
            DeveloperTokenScope::create([
                'scope' => 'POST',
                'developer_token_id' => $developer_token->id
            ]);
        }

        if($data["scope_put"] == "on"){
            DeveloperTokenScope::create([
                'scope' => 'PUT',
                'developer_token_id' => $developer_token->id
            ]);
        }

        if($data["scope_delete"] == "on"){
            DeveloperTokenScope::create([
                'scope' => 'DELETE',
                'developer_token_id' => $developer_token->id
            ]);
        }

        return $token;
    }

    public function get_developer_tokens()
    {
        $me = Auth()->user();
        return $me->developer_tokens;
    }

    public function file_array($file)
    {
        return array(
            'file_name' => $file->filename,
            'file_size' => $file->filesize,
            'zenodo_download_link' => $file->download_link,
            'checksum' => $file->checksum
        );
    }

    public function files_array($deposition)
    {
        $files = array();

        foreach ($deposition->files as $file) {
            $file_array = $this->file_array($file);
            array_push($files,$file_array);
        }

        return $files;
    }

    public function dataset_array($deposition)
    {
        return array(
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
            'files' => $this->files_array($deposition)
        );
    }

    public function community_array($community)
    {
        return array(
            'id' => $community->id,
            'name' => $community->name,
            'organisation' => $community->organisation,
            'info' => $community->info,
            'number_of_members' => $community->number_of_members,
            'number_of_datasets' => $community->number_of_datasets,
            'members' => $this->members_array($community),
            'admins' => $this->admins_array($community)
        );
    }

    public function member_array($community_member): array
    {
        return array(
            'id' => $community_member->id,
            'name' => $community_member->user->name,
            'surname' => $community_member->user->surname
        );
    }

    public function members_array($community): array
    {
        $members = array();

        foreach ($community->members as $member) {
            $member_array = $this->member_array($member);
            array_push($members,$member_array);
        }

        return $members;
    }

    public function admin_array($community_admin)
    {
        return array(
            'id' => $community_admin->id,
            'name' => $community_admin->user->name,
            'surname' => $community_admin->user->surname
        );
    }

    public function admins_array($community)
    {
        $admins = array();

        foreach ($community->admins as $admin) {
            $admin_array = $this->admin_array($admin);
            array_push($admins,$admin_array);
        }

        return $admins;
    }

    public function datasets_array($community)
    {
        $datasets = array();

        foreach ($community->datasets as $dataset) {
            $dataset_array = $this->dataset_array($dataset->dataset->deposition);
            array_push($datasets,$dataset_array);
        }

        return $datasets;
    }

}