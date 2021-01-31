@extends('layouts.admin')
@section('title', '- '.__('Invoices'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Invoices') }}</h2>
    @include('components.grid', [
        'name'  => 'admin_invoice_grid',
        'container' => $invoice_grid
    ])

</div>
@endsection