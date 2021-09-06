<div class="col-lg-12">
    <div class="code-block">

        <h5>
            <span class="badge badge-success">{{$verb}}</span>
            {{$name}}
        </h5>

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