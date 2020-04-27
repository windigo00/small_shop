@extends('layouts.app')

@section('styles')
<!-- Styles -->
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">

@endsection

@section('menu')
    @include('layouts.components.nav', ['links' => 'admin.auth.components.links'])
    @include('admin.components.nav')
@endsection

@section('content')

<div id="app">

    @yield('menu')

    <main class="py-4">
        @yield('page_content')
    </main>

    <div id="mask">
        <div class="background bg-light"></div>
        <i class="fas fa-spin fa-cog text-primary fa-10x"></i>
    </div>
</div>


<!-- Scripts -->
<script src="{{ asset('js/admin.js') }}" defer></script>
@endsection
