@extends('layouts.app')

@section('title')
    Register as a researcher
@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">
            <div class="col-lg-7 ">
                <div class="card card-bordered h-100">
                    <div class="card-inner">
                        <div class="card-title-group pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Title</h6>
                                <p>Subtitle.</p>
                            </div>
                        </div>

                        <form method="POST" action="{{route('register.researcher.p')}}">

                            @csrf

                            <button class="btn  btn-primary">I want to be a researcher</button>

                        </form>

                    </div>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .nk-block -->

@endsection
