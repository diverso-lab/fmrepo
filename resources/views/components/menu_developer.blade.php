@if(Auth::user()->has_role('DEVELOPER'))

    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Developer</h6>
    </li>

    <x-li name="Get an API Token" route="developer.token.get" icon="ni ni-terminal"/>
    <x-li name="My API tokens" route="developer.token.list" icon="ni ni-grid-add-fill-c"/>

@endif