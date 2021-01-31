<ul class="nav justify-content-start menu shadow-sm">
    @foreach($links as $item)
    <li class="nav-item">
        @include('components.nav.link', ['class' => 'nav-link', 'item' => $item])
    </li>
    @endforeach
</ul>