@extends('layouts.app')

@section('title')
    My API tokens
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">My API tokens</li>
        </ul>
    </nav>

@endsection

@section('content')

    @if (session('new_token'))
    <div class="row g-gs">

        <div class="col-lg-8">
            <div class="alert alert-fill alert-info alert-icon">
                Save your API access token in a safe place. It will not be shown again!
                <br>
                <em class="icon ni ni-alert-circle"></em> <strong>{{session('new_token')}}</strong>
            </div>
        </div>

    </div>
    @endif


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
                                    <th>Scopes</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($tokens as $token)
                                    <tr>

                                        <td>
                                            {{$token->name}}
                                        </td>

                                        <td>
                                            @foreach($token->scopes as $scope)
                                                <span class="badge badge-pill badge-light">{{$scope->scope}}</span>
                                            @endforeach
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


