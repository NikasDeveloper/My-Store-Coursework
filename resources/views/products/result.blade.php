<h5>Rezultatai ({{ $products->count() }})</h5>
<div class="card">
    <div class="content table-responsive table-full-width">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="text-left">Pavadinimas</th>
                <th class="text-right">Kaina</th>
                <th class="text-center">Būsena</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="text-left">
                        <a href="javascript:void(0)"> {{$product->name}}</a>
                    </td>
                    <td class="text-right">{{ moneyFloat($product->price )}} &euro;</td>
                    <td class="text-center">
                        @if($product->active)
                            <i class="ti-check-box"></i>
                        @else
                            <i class="ti-na"></i>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>