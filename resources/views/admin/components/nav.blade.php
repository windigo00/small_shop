<ul class="nav justify-content-start menu shadow-sm">
    <li class="nav-item">
        @include('layouts.components.nav.link', ['uri' => 'admin/dashboard', 'title' => 'Dashboard', 'class' => 'nav-link'])
    </li>
    <li class="nav-item">
        @include('layouts.components.nav.link', ['uri' => 'admin/products', 'title' => 'Products', 'class' => 'nav-link'])
    </li>
    <li class="nav-item">
        @include('layouts.components.nav.link', ['uri' => 'admin/customers', 'title' => 'Customers', 'class' => 'nav-link'])
    </li>
    <li class="nav-item">
        @include('layouts.components.nav.link', ['uri' => 'admin/users', 'title' => 'Users', 'class' => 'nav-link'])
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle  @if(strpos(Route::current()->uri, 'admin/sales') !== false) active @endif" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Sales</a>
        <div class="dropdown-menu">
            @include('layouts.components.nav.link', ['uri' => 'admin/sales/orders', 'title' => 'Orders', 'class' => 'dropdown-item'])
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="{{ route('admin.dashboard.index') }}">{{ __('Off limits') }}</a>
    </li>
</ul>