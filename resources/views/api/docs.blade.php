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

            <div class="col-lg-8">

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

                                    <div class="row">





                                    </div>

                                    <div class="row">
                                    </div>


                                </div>
                                <div class="tab-pane" id="tabItem2">

                                </div>
                                <div class="tab-pane" id="tabItem3">

                                </div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection


