<li class="nk-menu-item

    @isset($secondaries)
        @foreach(explode(',', $secondaries) as $secondary)

            @if(Route::currentRouteName() == $secondary)
                active current-page
            @endif
        @endforeach
    @endisset

    {{ (Route::currentRouteName() == $route) ? 'active current-page' : '' }}

">
    <a href="{{ route($route) }}" class="nk-menu-link">
        <span class="nk-menu-icon"><em class="icon {{$icon}}"></em></span>
        <span class="nk-menu-text">{{$name}}</span>
    </a>
</li>
