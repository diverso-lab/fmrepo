@extends('layouts.app')

@section('title')
    Get an API token
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Get an API token</li>
        </ul>
    </nav>

@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">
            <div class="col-lg-7 ">
                <div class="card card-bordered h-100">
                    <div class="card-inner">
                        <div class="card-title-group pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">You can interact with our REST API!</h6>
                            </div>
                        </div>

                        <p>
                            To use the FaMaREPO REST API you must first obtain an access token.

                            This token will only appear once, so you should keep it in a safe place.

                            <b>If you lose the token, you will have to create a new one.</b>
                        </p>

                        <form method="POST" action="{{route('developer.token.get_p')}}">
                            @csrf

                            <div class="row g-gs mb-4">
                                <x-input col="6" label="Name" id="title" attr="name" placeholder="Enter your token name" value="{{old('name')}}"/>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card-title card-title-sm mt-4">
                                        <h6 class="title">Scopes</h6>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-lg-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="scope_get" checked>
                                        <label class="custom-control-label" for="customCheck1">GET</label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2" name="scope_post" checked>
                                        <label class="custom-control-label" for="customCheck2">POST</label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3" name="scope_put" checked>
                                        <label class="custom-control-label" for="customCheck3">PUT/PATCH</label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck4" name="scope_delete" checked>
                                        <label class="custom-control-label" for="customCheck4">DELETE</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary">Create API token</button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .nk-block -->

@endsection
