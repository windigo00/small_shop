@extends('layouts.empty')

@section('page_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @yield('empty_header')
                    <x-system-language-selector class="float-right"></x-system-language-selector>
                </div>

                <div class="card-body">
                    @yield('empty_content')
                </div>
                <div class="card-footer">
                    @if (!Route::is('login'))
                    <a href="{{ route('login') }}">{{ __('Login') }}</a> |
                    @endif
                    @if (!Route::is('register'))
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @if (Route::has('password.request') && !Route::is('password.request'))
                    @if (!Route::is('register')) | @endif
                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection