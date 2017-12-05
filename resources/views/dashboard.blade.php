@extends('_layouts.app')

@section("title", "Pagrindinis")

@section('content')

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-success text-center">
                                <i class="ti-bag"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Aktyvios Prekės</p> {{ $active_products }} vnt.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-warning text-center">
                                <i class="ti-package"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Sandėlio likutis</p> {{ $total_stock }} vnt.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-danger text-center">
                                <i class="ti-target"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Išparduota prekių</p> {{ $sold_out_products }} vnt.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Prekių apžvalga</h4>
                    <p class="category">Aktyvios/Atjungtos</p>
                </div>
                <div class="content">
                    <div id="chartProducts" class="ct-chart ct-perfect-fourth"></div>
                    <div class="footer">
                        <div class="chart-legend">
                            <i class="fa fa-circle text-success"></i> Aktyvios
                            <i class="fa fa-circle text-danger"></i> Atjungtos
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Prekių apžvalga</h4>
                    <p class="category">Yra sandėlyje/Išparduotos</p>
                </div>
                <div class="content">
                    <div id="chartStore" class="ct-chart"></div>

                    <div class="footer">
                        <div class="chart-legend">
                            <i class="fa fa-circle text-success"></i> Yra sandėlyje
                            <i class="fa fa-circle text-danger"></i> Išparduotos
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
    <script>

        Chartist.Pie('#chartProducts', {
            labels: ["{{ $product_labels->active }}", "{{ $product_labels->disabled }}"],
            series: [{
                value: parseInt("{{$active_products}}"),
                className: 'ct-series-d',
            }, {
                value: parseInt({{$disabled_products}}),
                className: 'ct-series-c',
            }]
        });

        Chartist.Pie('#chartStore', {
            labels: ["{{ $stock_labels->in_stock }}", "{{ $stock_labels->sold_out }}"],
            series: [{
                value: parseInt("{{$in_stock_products}}"),
                className: 'ct-series-d',
            }, {
                value: parseInt({{$sold_out_products}}),
                className: 'ct-series-c',
            }]
        });
    </script>
@endsection