@extends('layouts.admin')
@section('title', '- '.__('Locales'))
@section('page_content')
<div class="container-fluid">
    <h2>{{ __('Locales') }}</h2>
    @include('components.grid', [
        'name'  => 'admin_locale_grid',
        'container' => $locale_grid
    ])
</div>
@endsection
