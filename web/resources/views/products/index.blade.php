<ul>
@foreach ($products as $product)
    <li>{{ $product->slug }}</li>
@endforeach
</ul>