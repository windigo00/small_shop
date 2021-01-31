@extends('layouts.admin')
@section('title', '- '.__('Contractors'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Contractors') }}</h2>

    @include('components.grid', [
        'name'  => 'admin_contractor_grid',
        'container' => $contractor_grid
    ])
</div>
@endsection
