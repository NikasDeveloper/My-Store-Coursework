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

@section("scripts")
    <script>

        function restockProduct(button) {

            const url = "{{ route("store.restock") }}";
            const id = $(button).attr("data-id");

            if ($(button).prop("disabled") === true) return;

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr("content"),
                    "_method": "DELETE",
                    "product": id
                },
                dataType: "json",
                beforeSend: function () {
                    $(button).prop("disabled", true);
                },
                complete: function () {
                    $(button).prop("disabled", false);
                },
                success: function (data) {
                    const notification = data.notification;
                    $(button).closest("tr").find("td.text-right").html("0 vnt.");
                    swal(notification.title, notification.message, 'success');
                },
                error: function (xhr) {
                    const response = xhr.responseJSON;
                    swal(response.error.title, response.error.message, 'error');
                },
            });

        }

        function refillProduct(button) {

            const url = "{{ route("store.refill") }}";
            const id = $(button).attr("data-id");

            if ($(button).prop("disabled") === true) return;

            swal({
                title: 'Submit email to run ajax request',
                input: 'number',
                showCancelButton: true,
                confirmButtonText: 'Pridėti',
                cancelButtonText: 'Atšaukti',
                showLoaderOnConfirm: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value.indexOf(".") !== -1 || value.indexOf(",") !== -1) {
                            resolve('Kiekis turi būti sveikasis skaičius.');
                        } else if (value <= 0) {
                            resolve('Kiekis turi būti didesnis už 0.');
                        } else if (value > 5000) {
                            resolve('Kiekis turi iki 5000.');
                        } else {
                            resolve();
                        }
                    })
                },
                preConfirm: (number) => {
                    return new Promise((resolve) => {

                        if (number <= 0) {
                            swal.showValidationError('Kiekis turi būti teigiamas.');
                            resolve();
                        }

                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                "_token": $('meta[name="csrf-token"]').attr("content"),
                                "_method": "PUT",
                                "product": id,
                                "amount": parseInt(number),
                            },
                            dataType: "json",
                            beforeSend: function () {
                                $(button).prop("disabled", true);
                            },
                            complete: function () {
                                $(button).prop("disabled", false);
                            },
                            success: function (data) {
                                const notification = data.notification;
                                $(button).closest("tr").find("td.text-right").html(data.in_stock + " vnt.");
                                swal(notification.title, notification.message, 'success');
                            },
                            error: function (xhr) {
                                const response = xhr.responseJSON;
                                swal(response.error.title, response.error.message, 'error');
                            },
                        });

                    })
                },
                allowOutsideClick: false
            });

        }

    </script>
@endsection
