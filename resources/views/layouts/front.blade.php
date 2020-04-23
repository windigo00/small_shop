@extends('layouts.app')

@section('styles')
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@endsection

@section('menu')
    @include('layouts.components.nav', ['links' => 'auth.components.links'])
@endsection

@section('content')

<div id="app">

    @yield('menu')

    <main class="py-4">
        @yield('page_content')
    </main>
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection