@if(Auth::user()->has_role('RESEARCHER'))

    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Researcher</h6>
    </li>

    <x-li name="Create community" route="community.create" icon="ni ni-users-fill"/>
    <x-li name="My communities" route="community.mine" icon="ni ni-users-fill"/>

@endif