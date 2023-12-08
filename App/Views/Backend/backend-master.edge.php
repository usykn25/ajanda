@extends('Backend/shared/Main')
@section('main')
<div id="preloader">
    <div class="lds-ripple">
        <div></div>
        <div></div>
    </div>
</div>
<div id="main-wrapper">
    <div class="nav-header">
        <a href="{!! route('adminHome') !!}" class="brand-logo">
            <img src="{!! get_asset('img/titan.png') !!}" alt="" height="50">
        </a>
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>

    @include('Backend.shared.Header')
    @include('Backend.shared.LeftMenu')
    <div class="content-body">
        @yield('content')
    </div>
    @include('Backend.shared.Footer')
</div>
@endsection


