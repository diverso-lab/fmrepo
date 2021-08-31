@extends('layouts.app')

@section('title')
    My communities
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">My communities</li>
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
                            <table id="depositions" class="datatable-init table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Members</th>
                                    <th>Datasets</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($communities as $community)
                                    <tr>
                                        <td><a href="{{route('community.view',$community->id)}}">{{$community->name}}</a></td>
                                        <td>{{$community->number_of_members}}</td>
                                        <td>{{$community->number_of_datasets}}</td>
                                        <td>
                                            <div class="tb-odr-btns d-none d-md-inline">
                                                <a href="{{route('researcher.community.joinrequests',$community->id)}}" class="btn btn-sm btn-info">
                                                    <em class="icon ni ni-user-check-fill"></em>&nbsp;Join requests</a>
                                            </div>

                                            <div class="tb-odr-btns d-none d-md-inline">
                                                <a href="{{route('researcher.community.manage',$community->id)}}" class="btn btn-sm btn-primary">
                                                    <em class="icon ni ni-account-setting-fill"></em>&nbsp;Manage</a>
                                            </div>
                                        </td>
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


