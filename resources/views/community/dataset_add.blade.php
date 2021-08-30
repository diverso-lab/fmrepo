@extends('layouts.app')

@section('title')
    Add your datasets
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('community.list')}}">Communities</a></li>
            <li class="breadcrumb-item"><a href="{{route('community.view',$community->id)}}">Community : {{$community->name}}</a></li>
            <li class="breadcrumb-item active">Add your datasets</li>
        </ul>
    </nav>

@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">

            <div class="col-lg-8">

                <div class="nk-block nk-block-lg">
                    <div class="card card-preview">
                        <form method="post" action="{{route('researcher.community.dataset.add_p')}}">

                            @csrf

                            <input type="hidden" name="community_id" value="{{$community->id}}"/>

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
                                        <th>DOI URL</th>
                                        <th>Title</th>
                                        <th>Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($depositions as $deposition)
                                        <tr>

                                            <td class="nk-tb-col nk-tb-col-check sorting_1">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" value="{{$deposition->dataset->id}}" id="id_{{$deposition->dataset->id}}" name="datasets[]">
                                                    <label class="custom-control-label" for="id_{{$deposition->dataset->id}}"></label>
                                                </div>
                                            </td>
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

                                <br>

                                <button type="submit" class="btn btn-primary">
                                    <em class="icon ni ni-grid-add-c"></em>
                                    &nbsp;&nbsp;Add datasets to community
                                </button>

                            </div>

                        </form>

                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                <div class="nk-block nk-block-lg">

                    <div class="card card-preview">
                        <div class="card-inner">

                            <div class="card-title">
                                <h6 class="subtitle">{{$community->organisation}}</h6>
                            </div>

                            <div class="card-amount">
                                <span class="amount"> {{$community->name}}</span>
                                <span class="change up text-light">{{$community->number_of_members}} members</span>
                            </div>

                            <p>
                                {!! $community->info !!}
                            </p>

                            <div class="card-title card-title-sm">
                                <h6 class="title">Admins</h6>
                                <p>
                                    @foreach($community->admins as $admin)
                                        {{$admin->user->surname}}, {{$admin->user->name}}
                                    @endforeach
                                </p>
                            </div>

                            <div class="card-title card-title-sm">
                                <h6 class="title">Members</h6>
                                <p>
                                    @foreach($community->members as $member)
                                        {{$member->user->surname}}, {{$member->user->name}}
                                    @endforeach
                                </p>
                            </div>

                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>

@endsection


