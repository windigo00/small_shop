@extends('layouts.admin')
@section('title', '- '.__('Admin Users'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Admin Users') }}</h2>
    @include('components.grid', [
        'name'  => 'admin_user_grid',
        'container' => $user_grid
    ])

</div>
@endsection