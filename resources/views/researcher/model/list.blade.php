@extends('layouts.app')

@section('title')
    Models
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

                                @foreach($feature_models as $feature_model)
                                    <tr>
                                        <td>{{$feature_model->deposition->doi ?? ''}}</td>
                                        <td>{{$feature_model->deposition->doi_url ?? ''}}</td>
                                        <td>{{$feature_model->deposition->prereserve_doi ?? ''}}</td>
                                        <td>{{$feature_model->deposition->title ?? ''}}</td>
                                        <td>{{$feature_model->deposition->state ?? ''}}</td>
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


