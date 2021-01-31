@extends('layouts.admin')
@section('title', '- '.__('Admin Tasks'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Tasks') }}</h2>
    <x-calendar name="admin_task_calendar" :repository="$item_repo" :time="$time" :routes="$routes">
    </x-calendar>
</div>
@endsection

@section('scripts')
<!-- Scripts -->
<script src="{{ asset('js/Core/SmallShop/Business/index.js') }}" defer></script>
@endsection
