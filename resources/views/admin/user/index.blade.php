@extends('layouts.admin')
@section('title', '- '.__('Admin Users'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Admin Users') }}</h2>
    @include('layouts.components.grid', [
        'name'  => 'admin_user_grid',
        'items' => $users,
        'columns' => app('\App\Providers\Grid\Column\Model\User'),
        'actions' => [
            'edit'   => [
                'color' => 'info',
                'icon' => 'pen',
                'route' => function(\Illuminate\Database\Eloquent\Model $item) { return route('admin.users.edit'   , ['user' => $item]); },
            ],
            'delete' => [
                'color' => 'danger',
                'icon' => 'times',
                'route' => function(\Illuminate\Database\Eloquent\Model $item) { return route('admin.users.destroy', ['user' => $item]); }
            ],
        ]
    ])

</div>
@endsection