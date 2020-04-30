<div class="dropdown-menu dropdown-menu-right" aria-labelledby="{{ $dropdown_id }}">
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
        {{ __('Log Out') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>