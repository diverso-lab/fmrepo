@extends('layouts.app')

@section('title')
    Dataset: {{$dataset->deposition->title}}
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('dataset.list')}}">Datasets</a></li>
            <li class="breadcrumb-item active">Dataset: {{$dataset->deposition->title}}</li>
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

                            <h2>
                                {{$dataset->deposition->title}}
                            </h2>

                            <p>
                                <a target="_blank" href="{{$dataset->deposition->doi_url}}">{{$dataset->deposition->doi_url}}</a>
                            </p>

                            <p>
                                {!! $dataset->deposition->description !!}
                            </p>

                            @if(Auth::check())
                                @if(Auth::user()->has_role('REVIEWER'))

                                    <a href="{{route('reviewer.review.request.verificate',$dataset->request_review->id)}}" class="btn btn-success"> <span>Verificate</span> </a>

                                @endif

                            @endif

                            <a href="" class="btn btn-primary"><em class="icon ni ni-download"></em>&nbsp; Download dataset</a>

                            <a href="" class="btn btn-primary"><em class="icon ni ni-file-docs"></em>&nbsp; Add to download queue</a>

                        </div>
                    </div>



                </div>

            </div>

            <div class="col-lg-4">

                <div class="nk-block nk-block-lg">

                    <div class="card card-preview">
                        <div class="card-inner">

                            Options

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection


