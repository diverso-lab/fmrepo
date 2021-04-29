@if(Auth::user()->has_role('RESEARCHER'))

    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Researcher</h6>
    </li>

    <x-li name="Zenodo token" route="researcher.zenodo.token" icon="ni ni-network"/>
    <x-li name="Depositions" route="researcher.deposition.list" icon="ni ni-archive"/>
    <x-li name="Upload Model" route="researcher.model.upload" icon="ni ni-upload"/>


@endif