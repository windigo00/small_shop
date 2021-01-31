@php
$hasItems = $item->hasChildren();
$uri = $item->getUri();
$testUri = str_replace('.', '/', $uri);
if (strpos($uri, '.') !== false) {
    $testUri = str_replace('/index', '', $testUri);
}
@endphp
<a
    class="{{ $class }} @if(strpos(Route::current()->uri, $testUri) !== false) active @endif @if($hasItems) dropdown-toggle @endif"
    @if($hasItems) data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"
    @else href="{{ strpos($uri, '/') !== false ? url($uri) : route($uri) }}" @endif
>
    {{ __($item->getTitle()) }}
</a>

@if($hasItems)
<div class="dropdown-menu">
    @foreach($item->getItems() as $item)
    @include('components.nav.link', ['class' => 'dropdown-item', 'item' => $item])
    @endforeach
</div>
@endif