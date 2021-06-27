@extends('layouts.app')

@section('title')
    Upload
@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">

            <div class="col-lg-4">

                <div class="card card-preview">
                    <div class="card-inner">

                        <div class="row g-gs">
                            <x-input col="12" label="Title" attr="title" placeholder="Enter your dataset title" value="{{old('title')}}"/>
                        </div>

                        <div class="row g-gs mt-12">
                            <x-textarea col="12" label="Dataset description" attr="description" placeholder="Enter your description to your dataset" value="{{old('description')}}"/>
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

                                <form action="{{route('researcher.model.upload.computer')}}" method="POST" id="computer">
                                    @csrf

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

                                    <button type="submit" class="btn btn-primary ">Upload dataset</button>

                                </form>


                            </div>
                            <div class="tab-pane" id="tabItem2">
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

                                        <button class="btn btn-primary ">Upload dataset</button>

                                    </div>

                                </div>


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

                                        <button class="btn btn-primary ">Upload dataset</button>

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

                                        <button class="btn btn-primary ">Upload dataset</button>

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

        $("#computer").submit(function(e){
           e.preventDefault();
           console.log("aa");
           $(this).submit();
        });

        setInterval(function () {
            $(".filepond--file-info-main").each(function() {
                var uri = $(this).text();
                $( this ).text(decodeURI(uri));
            });
        },1);

        // plugins de interés
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        FilePond.create(
            document.querySelector('input[id="files"]'),
            {
                maxFileSize: 50000000,
                maxTotalFileSize: 200000000,
                labelMaxTotalFileSizeExceeded: 'Tamaño total máximo excedido',
                labelMaxFileSizeExceeded: 'El archivo es demasiado grande',
                labelMaxFileSize: 'El tamaño máximo es de {filesize}',
                labelMaxTotalFileSize: 'El tamaño máximo total es de {filesize}',
                labelFileTypeNotAllowed: 'Tipo de archivo no válido',
                server: {
                    url: '{{route('researcher.model.upload.file')}}',
                    process: '/',
                    load: (source, load, error, progress, abort, headers) => {

                        var request = new Request(decodeURI(source));
                        fetch(request).then(function(response) {

                            response.blob().then(function(myBlob) {

                                load(myBlob);

                                $(".filepond--file-info-main").each(function() {
                                    var uri = $(this).text();
                                    $( this ).text(decodeURI(uri));
                                });

                            });
                        });

                        $(".filepond--file-info-main").each(function() {
                            var uri = $(this).text();
                            $( this ).text(decodeURI(uri));
                        });

                    },
                    remove: function(source, load, errorCallback) {
                        var filename = source.split('/').pop()
                        var url = 'http://evidentia.test/21/evidence/upload/remove/' + filename;
                        var request = new Request(url);

                        fetch(request).then(function(response) {
                            console.log(response);
                        });

                        load();
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },

            }
        );



    </script>

@endsection

@endsection


