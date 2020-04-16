@extends('layouts.app')
@section('content')
<div class="flex-center position-ref full-height">

    @yield('menu')

    <div class="content">
        @yield('page_content')
    </div>
</div>
@endsection