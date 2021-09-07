<div class="col-lg-12">
    <div class="code-block">

        <h5>

            @if($verb == "GET")
                <span class="badge badge-success">{{$verb}}</span>
            @endif

            @if($verb == "POST")
                <span class="badge badge-info">{{$verb}}</span>
            @endif

            @if($verb == "PUT" || $verb == "PATCH")
                <span class="badge badge-warning">{{$verb}}</span>
            @endif

            @if($verb == "DELETE")
                <span class="badge badge-danger">{{$verb}}</span>
            @endif

            {{$name}}

        </h5>

        @if($info_message != "")
            <br>
            <div class="row g-gs">

                <div class="col-lg-12">
                    <div class="alert alert-fill alert-info alert-icon">
                        <em class="icon ni ni-alert-circle"></em>
                        <strong>
                            {{$info_message}}
                        </strong>
                    </div>
                </div>

            </div>
        @endif



        <br>

        <h6 class="overline-title title">Required parameters</h6>

<pre class="prettyprint lang-html" id="npmi">
access_token : your_api_access_token
@isset($parameters)
@foreach(explode(',', $parameters) as $parameter)
{{$parameter}}
@endforeach
@endisset
</pre>

        <br>

        @if($body_request != "")
            <h6 class="overline-title title">Request body</h6>

<pre class="prettyprint lang-html" id="npmi">
{{$body_request}}
</pre>

            <br>
        @endif



        <h6 class="overline-title title">Request sample</h6>

<pre class="prettyprint lang-html" id="npmi">
{{$verb}} {!! $endpoint !!}?access_token=<b>your_api_access_token</b>
</pre>

        <br>

        <h6 class="overline-title title">Response sample</h6>

        <p>Content type: application/json</p>

<pre class="prettyprint lang-html" id="npmi">
{{$slot}}
</pre>

    </div>
</div>