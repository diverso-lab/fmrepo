@extends('layouts.app')

@section('title')
    Datasets
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
                                    <th>DOI</th>
                                    <th>DOI URL</th>
                                    <th>Prerreserved DOI</th>
                                    <th>Title</th>
                                    <th>State</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($datasets as $dataset)
                                    <tr>
                                        <td>{{$dataset->deposition->doi ?? ''}}</td>
                                        <td><a target="_blank" href="{{$dataset->deposition->doi_url ?? ''}}">{{$dataset->deposition->doi_url ?? ''}}</a></td>
                                        <td>{{$dataset->deposition->prereserve_doi ?? ''}}</td>
                                        <td>{{$dataset->deposition->title ?? ''}}</td>
                                        <td>{{$dataset->deposition->state ?? ''}}</td>
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


