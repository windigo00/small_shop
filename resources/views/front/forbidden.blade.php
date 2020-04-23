@extends('layouts.front')
@section('title', '- '.__('Forbidden'))
@section('page_content')
<div id="panel" class="container">
    <div class="card">
        <div class="card-header">&nbsp</div>
        <div class="card-body text-center">
            <h1>{{ __('Access Forbidden') }}</h1>
        </div>
        <div class="card-footer">&nbsp;</div>
    </div>
</div>
@endsection

@section('styles')
@parent
<style type="text/css">
    #panel .card-header,
    #panel .card-footer {
        background-image: linear-gradient(45deg, #ff0000 25%, #ffff00 25%, #ffff00 50%, #ff0000 50%, #ff0000 75%, #ffff00 75%, #ffff00 100%);
        background-size: 56.57px 56.57px;
    }
</style>
@endsection