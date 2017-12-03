@extends('_layouts.app')

@section("title", "Pagrindinis")

@section('content')
    <div class="card">
        <div class="header">
            <h4 class="title">Sveiki atvykę į programėlę - {{ config('app.name', 'Mano sandėlys') }}</h4>
            <p class="category">Peržiūrėkite programėlėje esančius puslapius</p>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Pavadiniams</th>
                    <th class="text-center">Veiksmas</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Sandėlys</td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-info btn-fill btn-wd">Peržiūra</a>
                    </td>
                </tr>
                <tr>
                    <td>Prekės</td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-info btn-fill btn-wd">Peržiūra</a>
                    </td>
                </tr>
                <tr>
                    <td>Pagalba</td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-info btn-fill btn-wd">Peržiūra</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
