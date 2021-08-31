@extends('layouts.app')

@section('title')
    Join {{$community->name}}
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('community.list')}}">Communities</a></li>
            <li class="breadcrumb-item"><a href="{{route('community.view',$community->id)}}">Community : {{$community->name}}</a></li>
            <li class="breadcrumb-item active">Join</li>
        </ul>
    </nav>

@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">

            <div class="col-lg-8">

                <div class="nk-block nk-block-lg">
                    <div class="card card-preview">
                        <form method="post" action="{{route('researcher.community.join_p')}}">

                            @csrf

                            <input type="hidden" name="community_id" value="{{$community->id}}"/>

                            <div class="card-inner">

                                <p>
                                    You can join this community if you want. We will send an invitation request to
                                    the administrators of this community.</p>

                                <p>
                                    If you are accepted, you will be able to add your own datasets to this community
                                    along with the other members.
                                </p>

                                <button type="submit" class="btn btn-primary">

                                    <em class="icon ni ni-user-add-fill"></em>
                                    &nbsp;&nbsp;Join {{$community->name}}
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


