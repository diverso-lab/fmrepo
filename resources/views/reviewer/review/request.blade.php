@extends('layouts.app')

@section('title')
    Requests for review
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Requests for review</li>
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
                            <table id="request" class="datatable-init table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>DOI URL</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($requests as $request)
                                    <tr>
                                        <td>{{$request->dataset->deposition->title}}</td>
                                        <td><a target="_blank" href="{{$request->dataset->deposition->doi_url}}">{{$request->dataset->deposition->doi_url}}</a></td>
                                        <td><a class="btn btn-sm btn-primary" href="{{route('dataset.view',$request->dataset->id)}}">View dataset</a></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection


