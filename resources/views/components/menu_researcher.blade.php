@if(Auth::user()->has_role('RESEARCHER'))

    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Researcher</h6>
    </li>

    <x-li name="My models" route="researcher.model.list" icon="ni ni-network"/>



    <x-li name="Communities" route="researcher.community.list" icon="ni ni-users-fill"/>


@endif