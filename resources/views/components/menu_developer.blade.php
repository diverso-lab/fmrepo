@if(Auth::user()->has_role('DEVELOPER'))

    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Developer</h6>
    </li>

    <x-li name="Get an API Token" route="developer.token.get" icon="ni ni-clipboad-check-fill"/>
    <x-li name="API Docs" route="developer.token.get" icon="ni ni-file-docs"/>

@endif