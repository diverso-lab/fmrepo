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
                        <form method="post" action="{{route('dataset.massive_download')}}">

                            @csrf

                            <div class="card-inner">

                            <table id="depositions" class="datatable-init table">
                                <thead>
                                <tr>
                                    <th class="nk-tb-col nk-tb-col-check sorting_asc" rowspan="1" colspan="1">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="selectAll">
                                            <label class="custom-control-label" for="selectAll"></label>
                                        </div>
                                    </th>
                                    <th>Verificated</th>
                                    <th>Title</th>
                                    <th>DOI</th>
                                    <th>DOI URL</th>

                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($datasets as $dataset)
                                    <tr>

                                        <td class="nk-tb-col nk-tb-col-check sorting_1">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" value="{{$dataset->id}}" id="id_{{$dataset->id}}" name="datasets[]">
                                                <label class="custom-control-label" for="id_{{$dataset->id}}"></label>
                                            </div>
                                        </td>

                                        <td>

                                            @if(isset($dataset->request_review->review))

                                                @if($dataset->request_review->review->verificate)
                                                    <i class="far fa-check-circle"></i>
                                                @endif

                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{route('dataset.view',$dataset->id)}}">{{$dataset->deposition->title ?? ''}}</a>
                                        </td>
                                        <td>{{$dataset->deposition->doi ?? ''}}</td>
                                        <td><a target="_blank" href="{{$dataset->deposition->doi_url ?? ''}}">{{$dataset->deposition->doi_url ?? ''}}</a></td>

                                        <td>

                                            <div class="tb-odr-btns d-none d-md-inline">
                                                <a href="{{route('dataset.download',$dataset->id)}}" class="btn btn-sm btn-primary"><em class="icon ni ni-download"></em></a>
                                            </div>

                                            <div class="tb-odr-btns d-none d-md-inline">
                                                <a href="#" onclick="add_dataset({{$dataset->id}})" class="btn btn-sm btn-primary"><em class="icon ni ni-file-docs"></em></a>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <br>

                            <div class="tb-odr-btns d-none d-md-inline">

                                <button type="submit" name="download" value="massive" class="btn btn-primary">
                                    <em class="icon ni ni-download"></em>&nbsp; Download datasets
                                </button>

                                <button type="submit" name="download" value="queue" class="btn btn-primary">
                                    <em class="icon ni ni-file-docs"></em>&nbsp; Add to download queue
                                </button>

                            </div>

                        </div>

                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection


