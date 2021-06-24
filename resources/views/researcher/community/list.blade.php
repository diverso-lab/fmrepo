@extends('layouts.app')

@section('title')
    Models
@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">

            <div class="nk-block nk-block-lg">
                <div class="card card-preview">
                    <div class="card-inner">
                        <table id="depositions" class="datatable-init table">
                            <thead>
                            <tr>
                                <th>DOI</th>
                                <th>Title</th>
                                <th>State</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($depositions as $deposition)
                                <tr>
                                    <td>{{$deposition->doi}}</td>
                                    <td>{{$deposition->title}}</td>
                                    <td>{{$deposition->state}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div><!-- .card-preview -->
            </div> <!-- nk-block -->

        </div><!-- .row -->
    </div><!-- .nk-block -->

@endsection


