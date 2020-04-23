@extends('layouts.admin')
@section('title', '- '.__('Admin Customers'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Admin Customers') }}</h2>
    @include('layouts.components.grid', [
        'name'  => 'admin_customer_grid',
        'items' => $customers,
        'columns' => app('\App\Providers\Grid\Column\Model\Customer'),
        'actions' => [
            'edit'   => [
                'color' => 'info',
                'icon' => 'pen',
                'route' => function(\Illuminate\Database\Eloquent\Model $item) { return route('admin.customers.edit'   , ['customer' => $item]); },
            ],
            'delete' => [
                'color' => 'danger',
                'icon' => 'times',
                'route' => function(\Illuminate\Database\Eloquent\Model $item) { return route('admin.customers.destroy', ['customer' => $item]); }
            ],
        ]
    ])

</div>
@endsection