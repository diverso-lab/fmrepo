@extends('layouts.app')

@section('title')
    Zenodo token
@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">
            <div class="col-lg-7 ">
                <div class="card card-bordered h-100">
                    <div class="card-inner">
                        <div class="card-title-group pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Creating a personal access token</h6>
                            </div>
                        </div>

                        <ul class="list list-sm ">

                            <li><a href="https://zenodo.org/signup" target="_blank">Register</a> for a Zenodo account if you don’t already have one.</li>
                            <li>Go to your <a href="https://zenodo.org/account/settings/applications/" target="_blank">Applications</a>, to <a href="https://zenodo.org/account/settings/applications/tokens/new/" target="_blank">create a new token</a>.</li>
                            <li>Select <code>deposit:write</code> and <code>deposit:actions</code>.</li>

                        </ul>


                        <form method="POST" action="{{ route('researcher.zenodo.token.p') }}">
                            @csrf

                            <div class="row">
                                <x-input col="12" label="Save token" attr="token" placeholder="Enter your Zenodo token" value="{{Auth::user()->zenodo_token->token ?? ''}}"/>
                            </div>

                            <div class="row mt-4">

                                <div class="col-lg-6">
                                    <button class="btn btn-primary ">Save token</button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .nk-block -->

@endsection
