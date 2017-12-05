<h5>Rezultatai ({{ $products->count() }})</h5>
<div class="card">
    <div class="content table-responsive table-full-width">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="text-left">Pavadinimas</th>
                <th class="text-right">Kiekis sandėlyje</th>
                <th class="text-center">Veiksmai</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="text-left">
                        <a href="{{ route("product.edit", ["product" => $product->id]) }}"> {{$product->name}}</a>
                    </td>
                    <td class="text-right">{{ $product->counter }} vnt.</td>
                    <td class="text-center">
                        <button type="submit" class="btn btn-success" data-id="{{ $product->id }}"
                                onclick="refillProduct(this);">
                            <span class="btn-label"><i class="ti-plus"></i></span>
                        </button>
                        <button type="submit" class="btn btn-danger" data-id="{{ $product->id }}"
                                onclick="restockProduct(this);">
                            <span class="btn-label"><i class="ti-close"></i></span>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>