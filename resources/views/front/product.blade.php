@extends('layouts.front')
@section('title', '- Product')
@section('page_content')
<div>product {{ $product->title }} </div>
<div>product {{ get_class(Auth::guard()) }} </div>
@endsection