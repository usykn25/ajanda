<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Chrev : Crypto Admin Template" />
    <meta property="og:title" content="Chrev : Crypto Admin Template" />
    <meta property="og:description" content="Chrev : Crypto Admin Template" />
    <title>Yönetim Paneli</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{!! get_asset('img/favicon.png') !!}">
    <link rel="stylesheet" href="{!! get_asset('Backend/css/style.css', 'v=1.0') !!}">
    <link rel="stylesheet" href="{!! get_asset('Backend/css/toastr.min.css') !!}">
    @yield('css')
</head>
<body>
@yield('main')
<script type="application/javascript" src="{!! get_asset('Backend/js/global.min.js', 'v=1.0') !!}"/></script>
<script type="application/javascript" src="{!! get_asset('Backend/js/custom.min.js', 'v=1.0') !!}"/></script>
<script type="application/javascript" src="{!! get_asset('Backend/js/deznav-init.js', 'v=1.0') !!}"/></script>
<script type="application/javascript" src="{!! get_asset('Backend/js/demo.js', 'v=1.0') !!}"/></script>
<script src="{!! get_asset('Backend/js/toastr.min.js') !!}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('js')
</body>
</html>
