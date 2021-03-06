@if(Auth::user()->has_role('RESEARCHER'))

    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Researcher</h6>
    </li>

    <x-li name="My datasets" route="dataset.mine" icon="ni ni-network"/>
    <x-li name="My communities" route="researcher.community.mine" secondaries="researcher.community.joinrequests" icon="icon ni ni-user-list-fill"/>
    <x-li name="Create community" route="researcher.community.create" icon="icon ni ni-note-add-fill"/>

@endif