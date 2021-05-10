@extends('layouts.app')

@section('title')
    Get an API token
@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">
            <div class="col-lg-7 ">
                <div class="card card-bordered h-100">
                    <div class="card-inner">
                        <div class="card-title-group pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">You can interact with our API REST!</h6>
                            </div>
                        </div>

                        <p>
                            To use the FM REPO API REST you must first obtain an access token.

                            This token will only appear once, so you should keep it in a safe place.

                            <b>If you lose the token, you will have to create a new one.</b>
                        </p>

                        <form method="POST" action="{{ route('researcher.zenodo.token.p') }}">
                            @csrf

                            <div class="row mt-4">

                                <div class="col-lg-6">
                                    <button class="btn btn-primary ">Create API token</button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .nk-block -->

@endsection
