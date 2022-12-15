@foreach($products as $product)
    <option value="{{ $product->id }}"> {{  $product->product_name }}</option>
@endforeach
