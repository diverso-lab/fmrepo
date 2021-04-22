@if(Auth::user()->has_role('RESEARCHER'))

    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Researcher</h6>
    </li>

    <x-li name="Zenodo token" route="researcher.zenodo.token" icon="fas fa-cogs"/>
    <x-li name="Depositions" route="researcher.deposition.list" icon="fas fa-cogs"/>

@endif