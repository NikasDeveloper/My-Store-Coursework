@extends('_layouts.app')

@section("title", "Sandėlys")

@section("content")

    <div class="card">
        <div class="header">
            <h4 class="title">Sandėlio apžvalga</h4>
        </div>
        <form class="content" action="{{ route("store") }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group{{ $errors->has("product") ? " has-error" : "" }}">
                        <label for="product" class="form-control-label">Prekės numeris</label>
                        <input type="text" class="form-control border-input" name="product" id="product"
                               autocomplete="off" value="{{ old('product', $bindings->product ?? "") }}">
                        @if($errors->has("product"))
                            <small class="help-block">{{ $errors->first("product") }}</small>
                        @endif
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                        <label for="name" class="form-control-label">Prekės pavadinimas</label>
                        <input type="text" class="form-control border-input" name="name" id="name"
                               autocomplete="off" value="{{ old('name', $bindings->name ?? "") }}">
                        @if($errors->has("name"))
                            <small class="help-block">{{ $errors->first("name") }}</small>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group{{ $errors->has("status") ? " has-error" : "" }}">
                        <label for="status" class="form-control-label">Būsena</label>
                        <select class="form-control border-input" name="status" id="status">
                            <option @if(null == old('status', $bindings->status ?? null))  selected @endif value="">
                                Visos prekės
                            </option>
                            <option @if("Y" == old('status', $bindings->status ?? null))  selected @endif value="Y">
                                Esančios sandėlyje prekės
                            </option>
                            <option @if("N" == old('status', $bindings->status ?? null))  selected @endif value="N">
                                Išparduotos prekės
                            </option>
                        </select>
                        @if($errors->has("status"))
                            <small class="help-block">{{ $errors->first("status") }}</small>
                        @endif
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-wd btn-success btn-magnify">
                <span class="btn-label"><i class="ti-search"></i></span> Paieška
            </button>
        </form>
    </div>

    @if($searched ?? false)
        @if($products->isEmpty())
            <h4 class="text-center">- Rezultatų nerasta -</h4>
        @else
            @include("store.result")
        @endif
    @endif

@endsection
