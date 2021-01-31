@extends('layouts.app')

@section('styles')
<!-- Styles -->
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('menu')
    @include('components.nav', ['links' => 'user::admin.auth.components.links'])
    <x-navigation template="admin.components.nav" :links="app('navigation')->getItems()"></x-navigation>
@endsection

@section('content')
<div id="app">

    @yield('menu')

    <main class="py-4">

        @include('components.flashes')

        @yield('page_content')
    </main>

    <div id="mask">
        <div class="background bg-light"></div>
        <i class="fas fa-spin fa-link text-default fa-6x"></i>
    </div>
</div>
@endsection

@section('scripts')
<!-- Scripts -->
<script src="{{ asset('js/admin.js') }}" defer></script>
@endsection
