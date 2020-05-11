@foreach ($products as $product)
<div class="col-3 mb-4">
    @include('catalog::product', ['product' => $product])
</div>
@endforeach
