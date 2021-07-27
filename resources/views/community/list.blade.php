@extends('layouts.app')

@section('title')
    Communities
@endsection

@section('breadcrumb')

    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Communities</li>
        </ul>
    </nav>

@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">

            @foreach($communities as $community)
                <div class="col-md-4">
                    <div class="card card-bordered card-full">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-0">
                                <div class="card-title">
                                    <h6 class="subtitle">{{$community->organisation}}</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="" data-original-title="{{$community->info}}"></em>
                                </div>
                            </div>
                            <div class="card-amount">
                                <span class="amount"> {{$community->name}}</span>
                                <span class="change up text-light">{{$community->number_of_members}} members</span>
                            </div>
                            <div class="invest-data">
                                <div class="invest-data-amount g-2">
                                    <div class="invest-data-history">
                                        <div class="title">Total datasets</div>
                                        <div class="amount">{{$community->number_of_datasets}}</div>
                                    </div>
                                    <div class="invest-data-history">
                                        <div class="title">This week</div>
                                        <div class="amount">X</div>
                                    </div>
                                </div>
                                <div class="invest-data-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas class="iv-data-chart chartjs-render-monitor" id="totalDeposit" style="display: block; height: 68px; width: 86px;" width="301" height="238"></canvas>
                                </div>
                            </div>

                            <br>
                            <a href="#" class="btn btn-white btn-dim btn-outline-primary"><i class="fas fa-sign-in-alt"></i><span> &nbsp;&nbsp;Join</span></a>
                        </div>
                    </div><!-- .card -->
                </div>
            @endforeach

        </div>

    </div>

@endsection


