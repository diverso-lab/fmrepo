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
            <div class="col-md-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">University of Seville</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="" data-original-title="Total Deposited"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount"> Diverso Lab</span>
                            <span class="change up text-light">4 members</span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">Total datasets</div>
                                    <div class="amount">15</div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This week</div>
                                    <div class="amount">2</div>
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
            <div class="col-md-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">University of Seville</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="" data-original-title="Total Deposited"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount">Mechanics and Statistics</span>
                            <span class="change up text-light">2 members</span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">Total datasets</div>
                                    <div class="amount">10</div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This week</div>
                                    <div class="amount">0</div>
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
            <div class="col-md-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">Universidad Complutense de Madrid</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="" data-original-title="Total Deposited"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount">Architectural Acoustics</span>
                            <span class="change up text-light">5 members</span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">Total datasets</div>
                                    <div class="amount">23</div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This week</div>
                                    <div class="amount">1</div>
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
            <div class="col-md-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">Universitat Pompeu Fabra</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="" data-original-title="Total Deposited"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount"> The distributed group</span>
                            <span class="change up text-light">8 members</span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">Total datasets</div>
                                    <div class="amount">5</div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This week</div>
                                    <div class="amount">0</div>
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
            <div class="col-md-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">University of Sevilla</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="" data-original-title="Total Deposited"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount"> Quantum mechanics</span>
                            <span class="change up text-light">28 members</span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">Total datasets</div>
                                    <div class="amount">37</div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This week</div>
                                    <div class="amount">8</div>
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
            <div class="col-md-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">University of Pablo de Olavide</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="" data-original-title="Total Deposited"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount"> Advanced industrial processes</span>
                            <span class="change up text-light">2 members</span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">Total datasets</div>
                                    <div class="amount">20</div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This week</div>
                                    <div class="amount">1</div>
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
        </div>

        <div class="row g-gs">

            <div class="col-lg-12">

                <div class="nk-block nk-block-lg">
                    <div class="card card-preview">
                        <div class="card-inner">
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection


