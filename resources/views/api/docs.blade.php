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


                                    <div class="code-block">

                                        <h5>
                                            <span class="badge badge-success">GET</span>
                                            List all datasets
                                        </h5>

                                        <br>

<h6 class="overline-title title">Required parameters</h6>

<pre class="prettyprint lang-html" id="npmi">
access_token : your_api_access_token
</pre>

<br>

<h6 class="overline-title title">Request sample</h6>

<pre class="prettyprint lang-html" id="npmi">
GET api/datasets
</pre>

<br>

<h6 class="overline-title title">Response sample</h6>

<p>Content type: application/json</p>

<pre class="prettyprint lang-html" id="npmi">
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
</pre>
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


