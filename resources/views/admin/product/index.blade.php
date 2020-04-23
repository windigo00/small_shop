@extends('layouts.admin')
@section('title', '- '.__('Admin Products'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Admin Products') }}</h2>
    @include('layouts.components.grid', [
        'name'  => 'admin_product_grid',
        'items' => $products,
        'columns' => app('\App\Providers\Grid\Column\Model\Product'),
        'actions' => [
            'edit'   => [
                'color' => 'info',
                'icon' => 'pen',
                'route' => function(\Illuminate\Database\Eloquent\Model $item) { return route('admin.products.edit'   , ['product' => $item]); },
            ],
            'delete' => [
                'color' => 'danger',
                'icon' => 'times',
                'route' => function(\Illuminate\Database\Eloquent\Model $item) { return route('admin.products.destroy', ['product' => $item]); },
            ]
        ]
    ])

</div>
@endsection