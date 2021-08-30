@extends('layouts.app')

@section('title')
    Create community
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Create community</li>
        </ul>
    </nav>

@endsection

@section('content')

    <div class="nk-block">

        <form method="POST" action="{{route('community.create.p')}}">

        <div class="row g-gs">

                @csrf

                <div class="col-lg-6">

                    <div class="card card-preview">
                        <div class="card-inner">

                            <h5 class="mb-3">Basic info</h5>

                            <div class="row g-gs">
                                <x-input col="12" label="Name" attr="name" placeholder="Enter your community name" value="{{old('title')}}"/>
                            </div>

                            <div class="row g-gs">
                                <x-input col="8" label="Organisation" attr="organisation" placeholder="Enter your organisation (e.g. University of Seville)" value="{{old('title')}}"/>
                            </div>


                            <div class="row g-gs mt-6">
                                <x-textarea col="12" label="Info" attr="info" placeholder="Briefly describe the purpose of your community" value="{{old('description')}}"/>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="card card-preview">
                        <div class="card-inner">

                            <h5 class="mb-3">Add members</h5>

                            <p>
                                You can invite new members by searching by name, surname or username
                            </p>

                            <div class="row g-gs">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Add members</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select" multiple="multiple" name="users[]" data-placeholder="Search users">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->surname}}, {{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary">Create community</button>
                </div>


        </div>
    </form>
    </div>

@endsection


