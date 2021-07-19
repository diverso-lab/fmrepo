@extends('layouts.app')

@section('title')
    Upload dataset
@endsection

@section('content')

    <div class="nk-block">

        <div class="row g-gs">

            <div class="col-lg-6">

                <div class="card card-preview">
                    <div class="card-inner">

                        <h5 class="mb-3">Basic info</h5>

                        <div class="row g-gs">
                            <x-input col="12" label="Title" id="title" attr="title" placeholder="Enter your dataset title" value="{{old('title')}}"/>
                        </div>

                        <div id="authors">

                            <div class="row g-gs">
                                <x-input col="4" class="mt-0 pt-0 mb-0 pb-0" label="Author surname" attr="title" placeholder="Enter an author surname"/>
                                <x-input col="4" class="mt-0 pt-0 mb-0 pb-0" label="Author name" attr="title" placeholder="Enter an author name"/>
                            </div>

                        </div>

                        <div class="row g-gs">

                            <div class="form-group col-lg-6 mt-0 pt-0 m-0">
                                <button class="btn btn-light btn-sm" onclick="add_author();">Add author</button>
                            </div>

                        </div>


                        <div class="row g-gs mt-6">
                            <x-textarea col="12" label="Dataset description" id="description" attr="description" placeholder="Enter your description to your dataset" value="{{old('description')}}"/>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card card-preview">
                    <div class="card-inner">

                        <h5 class="mb-3">Verification (optional)</h5>

                        <div class="row g-gs">
                            <x-input col="6" label="Email" id="email" description="Your dataset will be reviewed by our work team. If you want us to notify you of its acceptance, tell us your email." attr="Email" placeholder="Enter your email" value="{{old('email')}}"/>
                            <x-input col="6" label="DOI url" id="doi_url" description="If you provide us with a url of your DOI, we can speed up the verification process." attr="Email" placeholder="Enter your DOI url" value="{{old('doi_url')}}"/>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="row g-gs">



            <div class="col-lg-12">

                <div class="card card-preview" id="loading" style="display:none">

                    <div class="card-inner">
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="card card-preview" id="load_dataset">


                    <div class="card-inner">

                        <h5 class="mb-3">Import your dataset</h5>

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
                                    <input class="hidden_authors" type="hidden" name="authors" value="" required="">
                                    <input class="hidden_doi_url" type="hidden" name="doi_url" value="" required="">

                                    <div class="form-group">
                                        <div class="row g-gs">
                                        <div class="col-lg-6">

                                            <input type="file" name="files[]" id="files" multiple>

                                        </div>
                                    </div>

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
                                        <x-input col="6" label="GitHub repository" attr="github" placeholder="Enter your GitHub repository to clone" value="{{old('title')}}"/>
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

                                <form action="{{route('dataset.upload.zip')}}" method="POST" class="request_form" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row g-gs">
                                        <div class="form-group">
                                            <label class="form-label" for="customFileLabel">Select a ZIP folder from your computer</label>
                                            <div class="form-control-wrap">
                                                <div class="custom-file">
                                                    <input type="file" name="zip" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose ZIP file</label>
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

                                </form>


                            </div>
                            <div class="tab-pane" id="tabItem4">

                                <form action="{{route('dataset.upload.textplain')}}" method="POST" class="request_form">

                                    @csrf

                                    <div class="row g-gs mt-12">
                                        <x-textarea col="6" label="Dataset description" attr="description" placeholder="Enter your description to your dataset" value="{{old('description')}}"/>
                                    </div>

                                    <div class="row g-gs">

                                        <div class="col-lg-6">
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

                $("#load_dataset").hide();
                $("#loading").show();

                // authors
                var authors = "";
                var i = 1;
                $("#authors input[type=text]").each(function(){
                    var input = $(this);
                    var val = input.val();
                    val = val.replaceAll(",","");
                    val = val.replaceAll(";","");
                    authors += val + ", ";
                    if (i%2 == 0)
                    {
                        authors += ";"
                    }
                    i++;
                });

                authors = authors.replaceAll(", ;",";");

                $(".hidden_title").val($("#title").val());
                $(".hidden_description").val($("#description").val());
                $(".hidden_email").val($("#email").val());
                $(".hidden_authors").val(authors);
                $(".hidden_doi_url").val($("#doi_url").val());

                return true;

            });
        });

        function make_id(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return result;
        }

        function add_author(){
            var id = make_id(10);
            $("#authors").append('' +
                '<div class="row g-gs" id="'+id+'">'+
                '<div class="form-group col-lg-4 mt-0 pt-0 mb-0 pb-0">'+
                '<input id="" type="text" class="form-control " placeholder="Enter an author surname" name="title" value="" required="" autocomplete="title" autofocus="">'+

                '<small class="form-text text-muted"></small>'+

            '</div>'+


            '<div class="form-group col-lg-4 mt-0 pt-0 mb-0 pb-0">'+
                '<input id="" type="text" class="form-control " placeholder="Enter an author name" name="title" value="" required="" autocomplete="title" autofocus="">'+

                    '<small class="form-text text-muted"></small>'+

            '</div>'+


            '<div class="form-group col-lg-4 text-right">'+
                '<label class="form-label" for="title">'+
                    '<button class="btn btn-light btn-block" onclick="remove_author(\''+id+'\');">Remove author</button>'+
                '</label>'+
            '</div>'+
        '</div>');
        }

        function remove_author(identificator)
        {
            $("#"+identificator).remove();
        }

        // Filepond plugins
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        // Filepond
        FilePond.create(
            document.querySelector('input[id="files"]'),
            {
                maxFileSize: 50e9,
                maxTotalFileSize: 50e9,
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


