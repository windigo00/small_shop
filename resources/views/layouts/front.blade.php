@extends('layouts.app')

@section('styles')
<!-- Styles -->
<link href="{{ asset('css/front.css') }}" rel="stylesheet">
@endsection

@section('menu')
    @include('components.nav', ['links' => 'user::auth.components.links'])
@endsection

@section('content')
<div id="app">

    @yield('menu')

    <main class="py-4">
        @yield('page_content')
    </main>
</div>
@endsection

@section('scripts')
<script>
    window._cardCheckRoute = '{{ route('card.check') }}';
</script>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection