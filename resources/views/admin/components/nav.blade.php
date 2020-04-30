<ul class="nav justify-content-start menu shadow-sm">
    <li class="nav-item">
        @include('components.nav.link', ['uri' => 'admin/dashboard', 'title' => 'Dashboard', 'class' => 'nav-link'])
    </li>
    <li class="nav-item">
        @include('components.nav.link', ['uri' => 'admin/products', 'title' => 'Products', 'class' => 'nav-link'])
    </li>
    <li class="nav-item">
        @include('components.nav.link', ['uri' => 'admin/customers', 'title' => 'Customers', 'class' => 'nav-link'])
    </li>
    <li class="nav-item">
        @include('components.nav.link', ['uri' => 'admin/users', 'title' => 'Users', 'class' => 'nav-link'])
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle  @if(strpos(Route::current()->uri, 'admin/sales') !== false) active @endif" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ __('Sales') }}</a>
        <div class="dropdown-menu">
            @include('components.nav.link', ['uri' => 'admin/sales/orders', 'title' => 'Orders', 'class' => 'dropdown-item'])
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link dropdown-toggle  @if(strpos(Route::current()->uri, 'admin/system') !== false) active @endif" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ __('System') }}</a>

        <div class="dropdown-menu">
            @include('components.nav.link', ['uri' => 'admin/system/settings', 'title' => 'Settings', 'class' => 'dropdown-item'])
            @include('components.nav.link', ['uri' => 'admin/system/locale', 'title' => 'Locale', 'class' => 'dropdown-item'])
        </div>
    </li>
</ul>