@extends('layouts.app')

@section('title')
    Upload Model
@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">
            <div class="col-lg-12">
                <div class="card card-bordered h-100">
                    <div class="card-inner">

                        <form method="POST" action="{{ route('researcher.model.upload.p') }}">
                            @csrf

                            <div class="row">
                                <x-input col="6" label="Title" attr="title" placeholder="Enter your model title" value="{{old('title')}}"/>
                            </div>

                            <div class="row mt-2">
                                <x-input col="6" label="Description" attr="description" placeholder="Enter your description" value="{{old('title')}}"/>
                            </div>

                            <div class="row mt-4">

                                <div class="col-lg-6">
                                    <button class="btn btn-primary ">Upload model</button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .nk-block -->

@endsection


