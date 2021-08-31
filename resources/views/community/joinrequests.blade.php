@extends('layouts.app')

@section('title')
    {{$community->name}} : Join requests
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('researcher.community.mine')}}">My communities</a></li>
            <li class="breadcrumb-item active">{{$community->name}} : Join requests</li>
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
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Accept</th>
                                    <th>Decline</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($community->join_requests as $joinrequest)
                                    <tr>
                                        <td>
                                            {{$joinrequest->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            {{$joinrequest->user->surname}}, {{$joinrequest->user->name}}
                                        </td>
                                        <td>
                                            {{$joinrequest->user->email}}
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('researcher.community.join_accept')}}">
                                                @csrf
                                                <input type="hidden" name="join_request_id" value="{{$joinrequest->id}}"/>
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <em class="icon ni ni-thumbs-up"></em>&nbsp;
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('researcher.community.join_decline')}}">
                                                @csrf
                                                <input type="hidden" name="join_request_id" value="{{$joinrequest->id}}"/>
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <em class="icon ni ni-thumbs-down"></em>&nbsp;
                                                </button>
                                            </form>
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


