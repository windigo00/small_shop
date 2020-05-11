@extends('layouts.admin')
@section('title', '- '.__('Orders'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Orders') }}</h2>
    @include('components.grid', [
        'name'  => 'admin_order_grid',
        'container' => $order_grid
    ])

</div>
@endsection