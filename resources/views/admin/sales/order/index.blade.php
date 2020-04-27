@extends('layouts.admin')
@section('title', '- '.__('Admin Orders'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Admin Orders') }}</h2>
    @include('layouts.components.grid', [
        'name'  => 'admin_order_grid',
        'container' => $order_grid
    ])

</div>
@endsection