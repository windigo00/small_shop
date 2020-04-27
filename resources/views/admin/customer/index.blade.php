@extends('layouts.admin')
@section('title', '- '.__('Admin Customers'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Admin Customers') }}</h2>
    @include('layouts.components.grid', [
        'name'  => 'admin_customer_grid',
        'container' => $customer_grid
    ])

</div>
@endsection