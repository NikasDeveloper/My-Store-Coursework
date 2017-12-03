<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mano sandėlys') }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset("vendor/css/bootstrap.min.css") }}" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="{{ asset("vendor/css/animate.min.css") }}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset("vendor/css/paper-dashboard.css") }}" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset("vendor/css/font-awesome.min.css") }}" rel="stylesheet">
    <link href="{{ asset("vendor/css/themify-icons.css") }}" rel="stylesheet">

</head>
<body>

<div class="wrapper">

    @include("_components.sidebar")

    <div class="main-panel">

        @include("_components.navbar")

        <div class="content">
            <div class="container-fluid">
                @yield("content")
            </div>
        </div>

        @include("_components.footer")

    </div>
</div>


@include("_components.scripts")
@yield("scripts")

</body>
</html>
