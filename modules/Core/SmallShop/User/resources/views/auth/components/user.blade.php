<li class="nav-item dropdown">
    @if (Auth::user() !== null)
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>
    @endif
    @include('user::auth.components.logout', ['dropdown_id' => 'navbarDropdown'])
</li>