@if(Auth::user()->has_role('REVIEWER'))

    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Reviewer</h6>
    </li>

    <x-li name="Requests for review" route="reviewer.review.request" icon="ni ni-users-fill"/>


@endif