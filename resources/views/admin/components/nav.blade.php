<ul class="nav justify-content-start menu shadow-sm">
    @foreach($links as $item)
    <li class="nav-item">
        @include('components.nav.link', array_merge(['class' => 'nav-link'], $item))
    </li>
    @endforeach
    <li class="nav-item">
        <!--@ include('components.nav.link', ['uri' => 'admin/products', 'title' => 'Products', 'class' => 'nav-link'])-->
    </li>
    <li class="nav-item">
        <!--@ include('components.nav.link', ['uri' => 'admin/customers', 'title' => 'Customers', 'class' => 'nav-link'])-->
    </li>
    <li class="nav-item">
        <!--@ include('components.nav.link', ['uri' => 'admin/users', 'title' => 'Users', 'class' => 'nav-link'])-->
    </li>
</ul>