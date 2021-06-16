@extends('layouts.app')

@section('title')
    Upload Feature Model
@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">
            <div class="col-lg-12">
                <div class="card card-bordered h-100">
                    <div class="card-inner">

                        <form method="POST" action="{{ route('researcher.model.upload.p') }}">
                            @csrf

                            <div class="row">
                                <x-input col="6" label="Title" attr="title" placeholder="Enter your model title" value="{{old('title')}}"/>
                            </div>

                            <div class="row mt-2">
                                <x-input col="6" label="Description" attr="description" placeholder="Enter your description" value="{{old('title')}}"/>
                            </div>

                            <div class="row mt-2">

                                <div class="form-group col-lg-12">
                                    <input type="file" name="files[]" id="files" multiple>
                                </div>

                            </div>

                            <div class="row mt-4">

                                <div class="col-lg-6">
                                    <button class="btn btn-primary ">Upload model</button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .nk-block -->

@section('scripts')

    <script>

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


