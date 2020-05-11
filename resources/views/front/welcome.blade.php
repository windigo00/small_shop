@extends('layouts.front')
@section('title', '- '.__('Welcome'))
@section('page_content')

<div class="container">
    <div class="title m-b-md">
        {{ __('Welcome') }}
    </div>

    <div class="row">
        @include('catalog::product.list', ['products' => $products])
    </div>
</div>

@endsection