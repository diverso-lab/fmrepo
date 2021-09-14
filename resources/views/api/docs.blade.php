@extends('layouts.app')

@section('title')
    API Docs
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">API Docs</li>
        </ul>
    </nav>

@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">

            <div class="col-lg-12">

                <div class="nk-block nk-block-lg">
                    <div class="card card-preview">

                        <div class="card-inner">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabItem1">Datasets</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabItem2">Dataset files</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabItem3">Communities</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">

                                            <div class="row g-gs">

                                                <div class="col-md-4">
                                                    <ul class="nav link-list-menu border border-light round m-0">

                                                        <li>
                                                            <a class="active" data-toggle="tab" href="#get_all_datasets">Get all datasets &nbsp;&nbsp;</a>
                                                        </li>

                                                        <li>
                                                            <a data-toggle="tab" href="#get_dataset">Get a dataset &nbsp;&nbsp;</a>
                                                        </li>

                                                        <li>
                                                            <a data-toggle="tab" href="#create_dataset">Create a dataset &nbsp;&nbsp;</a>
                                                        </li>

                                                        <li>
                                                            <a data-toggle="tab" href="#publish_dataset">Publish a dataset &nbsp;&nbsp;</a>
                                                        </li>

                                                    </ul>
                                                </div>

                                                <div class="col-md-8">
                                                    <div class="tab-content">

                                                        <div class="tab-pane active" id="get_all_datasets">

                                                            <div class="row">

<x-api_item name="Get all datasets" verb="GET" endpoint="api/datasets">
{
    "datasets": [
        {
            "id": ...,
            "created_at": ...,
            "updated_at": ...,
            "doi": ...,
            "doi_url": ...,
            "zenodo_id": ...,
            "access_right": ...,
            "title": ...,
            "description": ...,
            "download_url": ...,
            "files": [
                {
                "file_name": ...,
                "file_size": ...,
                "zenodo_download_link": ...,
                "checksum": ...
                }
            ]
        }
    ]
}
</x-api_item>
                                                            </div>

                                                        </div>

                                                        <div class="tab-pane" id="get_dataset">

                                                            <div class="row">

<x-api_item name="Get a dataset" verb="GET" endpoint="api/datasets/<b>id</b>" parameters="id : dataset_id">
{
    "dataset": {
        "id": ...,
        "created_at": ...,
        "updated_at": ...,
        "doi": ...,
        "doi_url": ...,
        "zenodo_id": ...,
        "access_right": ...,
        "title": ...,
        "description": ...,
        "download_url": ...,
        "files": [
            {
                "file_name": ...,
                "file_size": ...,
                "zenodo_download_link": ...,
                "checksum": ...
            }
        ]
    }
}
</x-api_item>
                                                            </div>

                                                        </div>

                                                        <div class="tab-pane" id="create_dataset">

                                                            <div class="row">

                                                                <x-api_item name="Create a dataset" verb="POST" endpoint="api/datasets">
<x-slot name="body_request">

{
    "title" : ...,
    "description" : ...,
    "creators" : [
        {
            "name" : "Doe, John
        }
    ]
}

</x-slot>

{
    "dataset": {
        "id": ...,
        "created_at": ...,
        "updated_at": ...,
        "doi": "",
        "doi_url": ...,
        "zenodo_id": ...,
        "access_right": ...,
        "title": ...,
        "description": ...,
        "download_url": ...,
        "files": []
    }
}

                                                                </x-api_item>
                                                            </div>

                                                        </div>

                                                        <div class="tab-pane" id="publish_dataset">

                                                            <div class="row">

                                                                <x-api_item name="Publish a dataset" verb="PUT" endpoint="api/datasets/<b>id</b>/publish" parameters="id : dataset_id">

                                                                    <x-slot name="info_message">

                                                                        To publish a dataset in Zenodo and obtain a DOI, it is necessary that it has at least one associated file

</x-slot>
{
    "dataset": {
        "id": ...,
        "created_at": ...,
        "updated_at": ...,
        "doi": ...,
        "doi_url": ...,
        "zenodo_id": ...,
        "access_right": ...,
        "title": ...,
        "description": ...,
        "download_url": ...,
        "files": [
            {
                "file_name": ...,
                "file_size": ...,
                "zenodo_download_link": ...,
                "checksum": ...
            }
        ]
    }
}
</x-api_item>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                </div>
                                <div class="tab-pane" id="tabItem2">

                                    <div class="row g-gs">

                                        <div class="col-md-4">
                                            <ul class="nav link-list-menu border border-light round m-0">

                                                <li>
                                                    <a class="active" data-toggle="tab" href="#get_files_from_dataset">Get files from dataset &nbsp;&nbsp;</a>
                                                </li>

                                            </ul>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="tab-content">

                                                <div class="tab-pane active" id="get_files_from_dataset">

                                                    <div class="row">

<x-api_item name="Get files from dataset" verb="GET" endpoint="api/datasets/<b>id</b>/files" parameters="id : dataset_id">
{
    "files": [
        {
        "file_name": ...,
        "file_size": ...,
        "zenodo_download_link": ...,
        "checksum": ...
        },
        {
        "file_name": ...,
        "file_size": ...,
        "zenodo_download_link": ...,
        "checksum": ...
        }
    ]
}
</x-api_item>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="tabItem3">

                                    <div class="row g-gs">

                                        <div class="col-md-4">
                                            <ul class="nav link-list-menu border border-light round m-0">

                                                <li>
                                                    <a class="active" data-toggle="tab" href="#get_all_communities">Get all communities &nbsp;&nbsp;</a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#get_community">Get a community &nbsp;&nbsp;</a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#get_members">Get members from community &nbsp;&nbsp;</a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#get_admins">Get admins from community &nbsp;&nbsp;</a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#get_datasets">Get datasets from community &nbsp;&nbsp;</a>
                                                </li>

                                            </ul>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="tab-content">

                                                <div class="tab-pane active" id="get_all_communities">

                                                    <div class="row">

<x-api_item name="Get all communities" verb="GET" endpoint="api/communities">
{
    "communities": [
        {
            "id": ...,
            "name": ...,
            "organisation": ...,
            "info": ...,
            "number_of_members": ...,
            "number_of_datasets": ...,
            "members": [
                {
                "id": ...,
                "name": ...,
                "surname": ...
                }
            ]
        }
    ]
}
</x-api_item>
                                                    </div>

                                                </div>

                                                <div class="tab-pane" id="get_community">

                                                    <div class="row">

<x-api_item name="Get a community" verb="GET" endpoint="api/communities/<b>id</b>" parameters="id : community_id">
{
    "community": {
        "id": ...,
        "name": ...,
        "organisation": ...,
        "info": ...,
        "number_of_members": ...,
        "number_of_datasets": ...,
        "members": [
            {
            "id": ...,
            "name": ...,
            "surname": ...
            }
        ],
        "admins": [
            {
            "id": ...,
            "name": ...,
            "surname": ...
            }
        ]
    }
}
</x-api_item>
                                                    </div>

                                                </div>

                                                <div class="tab-pane" id="get_members">

                                                    <div class="row">

<x-api_item name="Get members from community" verb="GET" endpoint="api/communities/<b>id</b>/members" parameters="id : community_id">
{
    "members": [
        {
            "id": ...,
            "name": ...,
            "surname": ...
        }
    ]
}
</x-api_item>
                                                    </div>

                                                </div>

                                                <div class="tab-pane" id="get_admins">

                                                    <div class="row">

<x-api_item name="Get admins from community" verb="GET" endpoint="api/communities/<b>id</b>/admins" parameters="id : community_id">
{
    "admins": [
        {
            "id": ...,
            "name": ...,
            "surname": ...
        }
    ]
}
</x-api_item>
                                                    </div>

                                                </div>

                                                <div class="tab-pane" id="get_datasets">

                                                    <div class="row">

<x-api_item name="Get datasets from community" verb="GET" endpoint="api/communities/<b>id</b>/datasets" parameters="id : community_id">
{
    "datasets": [
        {
            "id": ...,
            "created_at": ...,
            "updated_at": ...,
            "doi": ...,
            "doi_url": ...,
            "zenodo_id": ...,
            "access_right": ...,
            "title": ...,
            "description": ...,
            "download_url": ...,
            "files": [
                {
                    "file_name": ...,
                    "file_size": ...,
                    "zenodo_download_link": ...,
                    "checksum": ...
                }
            ]
        }
    ]
}
</x-api_item>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection


