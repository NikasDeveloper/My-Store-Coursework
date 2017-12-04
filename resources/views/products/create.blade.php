@extends('_layouts.app')

@section("title", "Prekės kūrimas")

@section("content")
    <div class="card">
        <div class="header">
            <h4 class="title">Prekės kūrimo forma</h4>
        </div>
        <form class="content" action="{{ route("product.create") }}" method="POSt">
            {{ csrf_field() }}
            {{ method_field("PUT") }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Pavadinimas</label>
                <input id="name" type="text" class="form-control border-input" name="name" value="{{ old('name') }}"
                       required>
                @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                <label for="price" class="control-label">Kaina</label>
                <input id="price" type="text" class="form-control border-input" name="price" value="{{ old('price') }}"
                       required>
                @if ($errors->has('price'))
                    <span class="help-block">{{ $errors->first('price') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="control-label">Apibūdinimas</label>
                <textarea id="description" class="form-control border-input"
                          name="description">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has("status") ? " has-error" : "" }}">
                <label for="status" class="form-control-label">Būsena</label>
                <select class="form-control border-input" name="status" id="status">
                    <option @if("Y" == old('status')) selected @endif value="Y">Aktyvi</option>
                    <option @if("N" == old('status')) selected @endif value="N">Neaktyvi</option>
                </select>
                @if($errors->has("status"))
                    <small class="help-block">{{ $errors->first("status") }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-wd btn-success btn-magnify">
                <span class="btn-label"><i class="ti-save"></i></span> Sukurti
            </button>
        </form>
    </div>
@endsection

