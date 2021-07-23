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
                                            <input type="checkbox" checked disabled class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Journal paper</label>
                                        </div>
                                        <br>
                                        {{$request_review->doi_journal}}
                                        <a href="">https://doi.org/10.5072/zenodo.34343429</a>

                                    </div>

                                    <br>

                                    <div class="col-12 mt-3">

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" disabled class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Conference paper</label>
                                        </div>
                                        <br>
                                        <a href="">https://doi.org/10.5072/zenodo.90834093</a>

                                    </div>

                                    <div class="col-12 mt-3">

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" checked disabled class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Workshop paper</label>
                                        </div>
                                        <br>
                                        <a href="">https://doi.org/10.5072/zenodo.57928344</a>

                                    </div>

                                    <div class="col-12 mt-3 mb-3">

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" disabled class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Tool paper</label>
                                        </div>
                                        <br>
                                        <a href="">https://doi.org/10.5072/zenodo.22989237</a>

                                    </div>

                                    <br>

                                    <x-textarea col="6" label="Commentaries" id="description" attr="description" placeholder="Enter your description to your dataset" value="{{old('description')}}"/>


                                </div>



                                <div class="form-group row">

                                    <div class="col-lg-12">
                                        <button class="btn btn-success" type="submit" value="Verificate"><i class="fas fa-check"></i> &nbsp;&nbsp; Verificate</button>
                                        <a href="#" class="btn btn-gray"><i class="fas fa-check"></i> &nbsp;&nbsp; <span>Discard</span> </a>
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


