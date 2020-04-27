@extends('layouts.admin')
@section('title', '- '.__('Admin Products'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Admin Products') }}</h2>
    @include('layouts.components.grid', [
        'name'  => 'admin_product_grid',
        'container' => $product_grid
    ])

</div>
@endsection