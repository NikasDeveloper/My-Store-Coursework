@extends('_layouts.app')

@section("title", "Sandėlio papildymas")

@section("content")

    <div class="card">
        <div class="header">
            <h4 class="title">Sandėlio pildymo forma</h4>
        </div>
        @if(!$products->isEmpty())
            <form class="content" action="{{ route("store.refill") }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group{{ $errors->has("product") ? " has-error" : "" }}">
                    <label for="product" class="form-control-label">Prekė</label>
                    <select class="form-control border-input" name="product" id="product">
                        @foreach($products as $product)
                            <option @if($product->id == old('product')) selected @endif value="{{ $product->id }}">
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has("product"))
                        <small class="help-block">{{ $errors->first("product") }}</small>
                    @endif
                </div>
                <div class="form-group{{ $errors->has("amount") ? " has-error" : "" }}">
                    <label for="amount" class="form-control-label">Kiekis</label>
                    <input type="text" class="form-control border-input" name="amount" id="amount"
                           autocomplete="off" value="{{ old('amount') }}" required>
                    @if($errors->has("amount"))
                        <small class="help-block">{{ $errors->first("amount") }}</small>
                    @endif
                </div>
                <button type="submit" class="btn btn-wd btn-success btn-magnify">
                    <span class="btn-label"><i class="ti-shopping-cart-full"></i></span> Papildyti
                </button>
            </form>
        @else
            <div class="content">
                Nėra aktyvių prekių. Aktyvuokite bent vieną!
            </div>
        @endif

    </div>

@endsection

@section("scripts")

    @if(Session::has("stock_refilled"))
        <script>
            $.notify({
                icon: "ti-check",
                message: "{{ Session::pull("stock_refilled") }}"

            }, {
                type: "success",
                timer: 4000,
                placement: {
                    from: "top",
                    align: "right"
                }
            });
        </script>
    @endif

    @if($errors->has("amount"))
        <script>
            $("#amount").val("").focus();
        </script>
    @endif

@endsection