<a
    class="{{ $class }} @if(strpos(Route::current()->uri, $uri) !== false) active @endif"
    href="{{ route(str_replace('/', '.', $uri).'.index') }}"
>
    {{ __($title) }}
</a>