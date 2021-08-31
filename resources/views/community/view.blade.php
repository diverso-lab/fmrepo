@extends('layouts.app')

@section('title')
    Community : {{$community->name}}
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('community.list')}}">Communities</a></li>
            <li class="breadcrumb-item active">Community : {{$community->name}}</li>
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

                            <h3>
                                Datasets
                            </h3>

                            <p>

                            @auth
                                @if($community->I_belong_to_this_community())
                                    <a href="{{route('researcher.community.dataset.add',$community->id)}}" class="btn btn-primary"><em class="icon ni ni-grid-add-c"></em> &nbsp;&nbsp;Add your dataset</a>
                                @endif

                                @if($community->I_am_admin())
                                    <a href="#" class="btn btn-primary"><em class="icon ni ni-setting"></em> &nbsp;&nbsp;Manage datasets</a>
                                @endif
                            @endauth

                            </p>

                            <table id="depositions" class="datatable-init table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>DOI URL</th>
                                    <th>Owner</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($community_datasets as $community_dataset)
                                    <tr>
                                        <td>

                                            <a href="{{route('dataset.view',$community_dataset->dataset->id)}}">
                                                {{$community_dataset->dataset->deposition->title ?? ''}}
                                            </a>

                                        </td>
                                        <td><a target="_blank" href="{{$community_dataset->dataset->deposition->doi_url ?? ''}}">{{$community_dataset->dataset->deposition->doi_url ?? ''}}</a></td>
                                        <td>

                                            {{$community_dataset->community_dataset_owner->user->surname}}, {{$community_dataset->community_dataset_owner->user->name}}

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
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


