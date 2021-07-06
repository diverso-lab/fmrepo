@extends('layouts.app')

@section('title')
    Verification: {{$request_review->dataset->deposition->title}}
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('dataset.list')}}">Datasets</a></li>
            <li class="breadcrumb-item">Dataset: <a href="{{route('dataset.view',$request_review->dataset->id)}}">{{$request_review->dataset->deposition->title}}</a></li>
            <li class="breadcrumb-item active">Verification</li>
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

                            <form method="POST" action="{{route('reviewer.review.request.verificate_p')}}">

                                @csrf

                                <input type="hidden" name="request_review_id" value="{{$request_review->id}}" />

                                <div class="form-group row">

                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Option 1</label>
                                        </div>
                                    </div>

                                </div>



                                <div class="form-group row">

                                    <div class="col-lg-12">
                                        <button class="btn btn-success" type="submit" value="Verificate">Verificate</button>

                                    </div>

                                </div>

                            </form>

                            <p>
                            </p>

                        </div>
                    </div>



                </div>

            </div>

        </div>
    </div>

@endsection


