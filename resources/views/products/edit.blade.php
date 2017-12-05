@extends('_layouts.app')

@section("title", "Prekės redagavimas")

@section("content")

    <div class="card">
        <div class="header">
            <h4 class="title">{{ $product->name }} redagavimo forma</h4>
        </div>
        <form class="content" action="{{ route("product.edit", ["product" => $product->id]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field("PATCH") }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Pavadinimas</label>
                <input id="name" type="text" class="form-control border-input" name="name"
                       value="{{ old('name', $product->name) }}" required>
                @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                <label for="price" class="control-label">Kaina, &euro;</label>
                <input id="price" type="text" class="form-control border-input" name="price"
                       value="{{ old('price', moneyFloat($product->price)) }}" required>
                @if ($errors->has('price'))
                    <span class="help-block">{{ $errors->first('price') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="control-label">Apibūdinimas</label>
                <textarea id="description" class="form-control border-input"
                          name="description">{{ old('description', $product->description) }}</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has("status") ? " has-error" : "" }}">
                <label for="status" class="form-control-label">Būsena</label>
                <select class="form-control border-input" name="status" id="status">
                    <option @if("Y" == old('status', $product->status)) selected @endif value="Y">Aktyvi</option>
                    <option @if("N" == old('status', $product->status)) selected @endif value="N">Neaktyvi</option>
                </select>
                @if($errors->has("status"))
                    <small class="help-block">{{ $errors->first("status") }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-wd btn-success btn-magnify">
                <span class="btn-label"><i class="ti-save"></i></span> Redaguoti
            </button>
        </form>
    </div>

    <div class="card">
        <form class="content" method="POST" action="{{ route("product.delete", ["product" => $product->id]) }}">
            {{ csrf_field() }}
            {{ method_field("DELETE") }}
            <div class="text-center">
                <button type="submit" class="btn btn-fill btn-wd btn-warning btn-magnify">
                    <span class="btn-label"><i class="ti-trash"></i></span> Ištrinti
                </button>
            </div>
        </form>
    </div>

@endsection

@section("scripts")

    @if(Session::has("product_created"))
        <script>
            $.notify({
                icon: "ti-check",
                message: "{{ Session::pull("product_created") }}"

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

    @if(Session::has("product_updated"))
        <script>
            $.notify({
                icon: "ti-check",
                message: "{{ Session::pull("product_updated") }}"

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
@endsection