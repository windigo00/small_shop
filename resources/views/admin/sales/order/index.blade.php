@extends('layouts.admin')
@section('title', '- '.__('Admin Orders'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Admin Orders') }}</h2>
    @include('layouts.components.grid', [
        'name'  => 'admin_order_grid',
        'items' => $orders,
        'columns' => app('\App\Providers\Grid\Column\Model\Order'),
        'actions' => [
            'print'  => [
                'color' => 'primary',
                'icon' => 'print',
                'route' => function(\Illuminate\Database\Eloquent\Model $item) { return route('admin.sales.orders.print'  , ['order' => $item]); },
            ],
        ]
    ])

</div>
@endsection