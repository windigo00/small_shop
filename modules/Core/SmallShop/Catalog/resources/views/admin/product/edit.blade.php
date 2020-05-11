@extends('layouts.admin')
@section('title', '- '.__('Products Information'))
@section('page_content')
<form method="POST" action="{{ route('admin.products.update', $product) }}">
    {{ method_field('PATCH') }}
    @csrf
    <div class="container-fluid">
        <!--<h2>{{ __('Admin Product Edit') }}</h2>-->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Products Information') }}</div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" class="form-control" id="name" aria-describedby="titleHelp" name="title" value="{{ old('title', $product->title) }}">
                            <small id="titleHelp" class="form-text text-muted">{{ __('We\'ll never share your email with anyone else.') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="seo_name">{{ __('SEO Name') }}</label>
                            <input type="text" class="form-control" id="name" aria-describedby="seoHelp" name="seo_name" value="{{ old('seo_name', $product->seo_name) }}">
                            <small id="seoHelp" class="form-text text-muted">{{ __('SEO SEO SEO.') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="price">Password</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="visible">
                            <label class="custom-control-label" for="visible">{{ __('is visible') }}</label>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-primary">{{ __('Submit') }}</button>
                        <button type="button" class="btn btn-block btn-secondary">{{ __('Cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection