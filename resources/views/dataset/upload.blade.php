@extends('layouts.app')

@section('title')
    Upload dataset
@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">

            <div class="col-lg-4">

                <div class="card card-preview">
                    <div class="card-inner">

                        <div class="row g-gs">
                            <x-input col="12" label="Title" id="title" attr="title" placeholder="Enter your dataset title" value="{{old('title')}}"/>
                        </div>

                        <div class="row g-gs mt-12">
                            <x-textarea col="12" label="Dataset description" id="description" attr="description" placeholder="Enter your description to your dataset" value="{{old('description')}}"/>
                        </div>

                        <div class="row g-gs">
                            <x-input col="12" label="Email (optional)" id="email" description="Your dataset will be reviewed by our work team. If you want us to notify you of its acceptance, tell us your email." attr="Email" placeholder="Enter your email" value="{{old('email')}}"/>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-lg-8">

                <div class="card card-preview">
                    <div class="card-inner">

                        <ul class="nav nav-tabs mt-n3">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabItem1">Import from your computer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabItem2">Import from GitHub</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabItem3">Import from ZIP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabItem4">Import from a text plain</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabItem1">

                                <form action="{{route('dataset.upload.computer')}}" method="POST" class="request_form">
                                    @csrf

                                    <input class="hidden_title" type="hidden" name="title" value="" required="">
                                    <input class="hidden_description" type="hidden" name="description" value="" required="">
                                    <input class="hidden_email" type="hidden" name="email" value="" required="">

                                    <div class="form-group">
                                        <input type="file" name="files[]" id="files" multiple>
                                    </div>

                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}

                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="feedbak-error">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                    @endif

                                    <br>

                                    <button type="submit" class="btn btn-primary">Upload dataset</button>

                                </form>


                            </div>
                            <div class="tab-pane" id="tabItem2">

                                <form action="{{route('dataset.upload.github')}}" method="POST" class="request_form">
                                    @csrf

                                    <div class="row g-gs">
                                        <x-input col="12" label="GitHub repository" attr="github" placeholder="Enter your GitHub repository to clone" value="{{old('title')}}"/>
                                    </div>

                                    <div class="row g-gs">

                                        <div class="col-lg-12">
                                            {!! NoCaptcha::renderJs() !!}
                                            {!! NoCaptcha::display() !!}

                                            @if ($errors->has('g-recaptcha-response'))
                                                <span class="feedbak-error">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                            @endif

                                            <br>

                                            <button type="submit" class="btn btn-primary">Upload dataset</button>

                                        </div>

                                    </div>

                                </form>


                            </div>
                            <div class="tab-pane" id="tabItem3">
                                <div class="row g-gs">
                                    <div class="form-group">
                                        <label class="form-label" for="customFileLabel">Select a ZIP folder from your computer</label>
                                        <div class="form-control-wrap">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-gs">

                                    <div class="col-lg-12">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}

                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="feedbak-error">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                        @endif

                                        <br>

                                        <button type="submit" class="btn btn-primary">Upload dataset</button>

                                    </div>

                                </div>


                            </div>
                            <div class="tab-pane" id="tabItem4">
                                <div class="row g-gs mt-12">
                                    <x-textarea col="12" label="Dataset description" attr="description" placeholder="Enter your description to your dataset" value="{{old('description')}}"/>
                                </div>

                                <div class="row g-gs">

                                    <div class="col-lg-12">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}

                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="feedbak-error">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                        @endif

                                        <br>

                                        <button type="submit" class="btn btn-primary">Upload dataset</button>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

@section('scripts')

    <script>

        // this is to add the title, description, email, etc, to the form
        $(document).ready(function () {
            var form = $(".request_form");

            form.submit(function (event){

                $(".hidden_title").val($("#title").val());
                $(".hidden_description").val($("#description").val());
                $(".hidden_email").val($("#email").val());

                return true;

            });
        });

        // plugins
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        FilePond.create(
            document.querySelector('input[id="files"]'),
            {
                maxFileSize: 50000000,
                maxTotalFileSize: 200000000,
                server: {
                    url: '{{route('dataset.upload.file')}}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },

            }
        );

    </script>

@endsection

@endsection


