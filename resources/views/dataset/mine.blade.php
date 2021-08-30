@extends('layouts.app')

@section('title')
    My datasets
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">My datasets</li>
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

                                @foreach($depositions as $deposition)
                                    <tr>
                                        <td>

                                            @if(isset($deposition->dataset->request_review->review))

                                                @if($deposition->dataset->request_review->review->verificate)
                                                    <i class="far fa-check-circle"></i>
                                                @endif

                                            @endif

                                        </td>
                                        <td>{{$deposition->doi ?? ''}}</td>
                                        <td><a target="_blank" href="{{$deposition->doi_url ?? ''}}">{{$deposition->doi_url ?? ''}}</a></td>
                                        <td>{{$deposition->title ?? ''}}</td>
                                        <td>

                                            <div class="tb-odr-btns d-none d-md-inline">
                                                <a href="{{route('dataset.view',$deposition->dataset->id)}}" class="btn btn-sm btn-primary">View</a>
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
    </div>

@endsection


