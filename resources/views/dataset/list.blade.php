@extends('layouts.app')

@section('title')
    Datasets
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Datasets</li>
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
                            <table id="depositions" class="datatable-init table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>DOI</th>
                                    <th>DOI URL</th>
                                    <th>Title</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($datasets as $dataset)
                                    <tr>
                                        <td>

                                            @if(isset($dataset->request_review->review))

                                                @if($dataset->request_review->review->verificate)
                                                    <i class="far fa-check-circle"></i>
                                                @endif

                                            @endif

                                        </td>
                                        <td>{{$dataset->deposition->doi ?? ''}}</td>
                                        <td><a target="_blank" href="{{$dataset->deposition->doi_url ?? ''}}">{{$dataset->deposition->doi_url ?? ''}}</a></td>
                                        <td>{{$dataset->deposition->title ?? ''}}</td>
                                        <td>

                                            <div class="tb-odr-btns d-none d-md-inline">
                                                <a href="{{route('dataset.view',$dataset->id)}}" class="btn btn-sm btn-primary">View</a>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->

            </div>

        </div><!-- .row -->
    </div><!-- .nk-block -->

@endsection


