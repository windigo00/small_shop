@php
$hasItems = isset($items) && !empty($items);
@endphp
<a
    class="{{ $class }} @if(strpos(Route::current()->uri, $uri) !== false) active @endif @if($hasItems) dropdown-toggle @endif"
    @if($hasItems) data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"
    @else href="{{ strpos($uri, '/') !== false ? url($uri) : route($uri) }}" @endif
>
    {{ __($title) }}
</a>

@if($hasItems)
<div class="dropdown-menu">
    @foreach($items as $item)
    @include('components.nav.link', array_merge(['class' => 'dropdown-item', 'items' => []], $item))
    @endforeach
</div>
@endif