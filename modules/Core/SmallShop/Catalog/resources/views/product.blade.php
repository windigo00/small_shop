<div class="product card">
    <img src="images/no-image.png" class="bd-placeholder-img card-img-top" alt="{{ $product->title }}">
    <div class="card-body">
        <h5 class="card-title">{{ $product->title }}</h5>
        <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's content.
        </p>
        <h6 class="card-subtitle price text-right">{{ $product->price }}</h6>
    </div>
    <div class="card-footer btn-group">
        <a href="#" class="btn btn-block btn-success">{{ __('Add to Cart') }}</a>
        <a href="#" class="btn btn-primary">1</a>
    </div>
</div>
