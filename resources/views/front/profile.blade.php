@extends('layouts.front')
@section('title', '- '.__('Product'))
@section('page_content')
<div>
{{ $customer->fullName() }}

</div>
@endsection