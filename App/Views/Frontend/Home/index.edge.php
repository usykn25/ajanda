@extends('Frontend/frontend-master')

@section('css')
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <!--====== USEFULL META ======-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== TITLE TAG ======-->
    <title>Yekda Tekstil</title>

    <!--====== FAVICON ICON =======-->
    <link rel="shortcut icon" type="image/ico" href="{{ PUBLIC_DIR}}/img/favicon.png" />

    <!--====== STYLESHEETS ======-->
    <link rel="stylesheet" href="{{ PUBLIC_DIR}}/Frontend/css/normalize.css">
    <link rel="stylesheet" href="{{ PUBLIC_DIR}}/Frontend/css/animate.css">
    <link rel="stylesheet" href="{{ PUBLIC_DIR}}/Frontend/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ PUBLIC_DIR}}/Frontend/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ PUBLIC_DIR}}/Frontend/css/typed.css">
    <link href="{{ PUBLIC_DIR}}/Frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ PUBLIC_DIR}}/Frontend/css/font-awesome.min.css" rel="stylesheet">

    <!--====== MAIN STYLESHEETS ======-->
    <link href="{{ PUBLIC_DIR}}/Frontend/style.css" rel="stylesheet">
    <link href="{{ PUBLIC_DIR}}/Frontend/css/responsive.css" rel="stylesheet">

    <script src="{{ PUBLIC_DIR}}/Frontend/js/vendor/modernizr-2.8.3.min.js"></script>
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

@endsection

@section('content')



<body class="transparent-layer">

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!--- PRELOADER -->
<div class="preeloader">
    <div class="preloader-spinner">
        <img src="img/loading.svg" alt="">
    </div>
</div>

<!--START MAIN AREA-->
<div class="main-area" id="home">
    <div class="main-area-bg"></div>

    <!--WELCOME AREA CONTENT-->
    <div class="welcome-text-area">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 col-sm-12 col-xs-12">
                    <div class="welcome-text text-center">
                        <div class="clock-countdown">
                            <div class="site-config" data-date="12/01/2021 00:00:00" data-date-timezone="+0"></div>
                            <div class="days-counter">
                                <div class="digit">
                                    <span class="days">16</span>
                                    <span class="txt">YIL</span>
                                </div>
                            </div>
                            <div class="hour-counter">
                                <div class="border"></div>
                            </div>
                        </div>
                        <h3>Biz</h3>
                        <h1 class="visible-xs">Hizmetteyiz</h1>
                        <h1 class="hidden-xs cd-headline clip is-full-width">
                            <!--<span class="hero-text">Coming</span>-->
                            <span class="cd-words-wrapper">
                                    <b class="is-visible">Sizin için</b>
                                    <b>Hizmetteyiz</b>
                                </span>
                        </h1>
                        <div class="subscriber-form">
                            <form id="" method="post" action="{!! route('sipSorgu') !!}">
                                <label class="mt10" for="mc-email"></label>
                                <input type="text" id="mc-email" name="sipCode" placeholder="Sipariş Kodu">
                                <button type="submit" class="plus-btn">Sorgula</button>
                            </form>
                        </div>
                        <div class="home-button">
                            <a class="contact-button" href="#">İletişim</a>
                            <a class="info-button" href="#">Hakkımızda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="social-book-mark">
        <ul>
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
        </ul>
    </div>

    <!--WELCOME AREA CONTENT END-->

    <!--LEFT CONTACT CONTENT-->
    <div class="left-contact-content">
        <div class="push-content-close"><i class="fa fa-close"></i></div>
        <div class="contact-address-and-details section-padding">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="area-title title-inverse">
                        <div class="title-box"></div>
                        <h2>İletişim</h2>
                    </div>
                </div>
            </div>
            <div class="contact-details">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="logo text-center">
                            <img src="{{ PUBLIC_DIR}}/img/titan.png" alt="">
                            <h3></h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="single-contact">
                            <h4>Adres:</h4>
                            <p>H-496, R-10, West Nakhalpara, Dhaka, 1215 United States.</p>
                        </div>
                        <div class="single-contact">
                            <h4>E Posta:</h4>
                            <p><a href="mailto:info@yourcompany.com">info@yourcompany.com</a></p>
                            <p><a href="mailto:info@yourcompany.com">info@yourcompany.com</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="single-contact">
                            <h4>Telefon:</h4>
                            <p>+88 012345 123 123</p>
                            <p>+88 012345 123 123</p>
                        </div>
                        <div class="single-contact">
                            <h4>Follow Us On:</h4>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--LEFT CONTACT CONTENT END-->

    <!--RIGHT ABOUT AREA-->
    <div class="right-details-content">
        <div class="push-content-close"><i class="fa fa-close"></i></div>
        <div class="about-area section-padding">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="area-title">
                        <div class="title-box"></div>
                        <h2>Hakkımızda</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="about-details">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas aut quidem numquam! Molestias nisi odio itaque eaque vitae dolorem ipsum a, exercitationem laboriosam in quibusdam debitis sequi impedit quia officiis, esse ut fuga doloribus voluptas magnam quasi quo atque dolorum.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas aut quidem numquam! Molestias nisi odio itaque eaque vitae dolorem ipsum a, exercitationem laboriosam in quibusdam debitis sequi impedit quia officiis, esse ut fuga doloribus voluptas magnam quasi quo atque dolorum.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-area dark-bg">
            <div class="footer-copyright text-center">
                <p><a href="{!! route('adminLogin') !!}"> Yönetici Girşi</a></p>
            </div>
        </div>
    </div>
    <!--RIGHT ABOUT AREA END-->

</div>
<!--END MAIN AREA-->

<!--====== SCRIPTS JS ======-->
<script src="{{ PUBLIC_DIR}}/Frontend/js/vendor/jquery-1.12.4.min.js"></script>
<script src="{{ PUBLIC_DIR}}/Frontend/js/vendor/bootstrap.min.js"></script>

<!--====== PLUGINS JS ======-->
<script src="{{ PUBLIC_DIR}}/Frontend/js/vendor/jquery.easing.1.3.js"></script>
<script src="{{ PUBLIC_DIR}}/Frontend/js/vendor/jquery-migrate-1.2.1.min.js"></script>
<script src="{{ PUBLIC_DIR}}/Frontend/js/typed.js"></script>
<script src="{{ PUBLIC_DIR}}/Frontend/js/jquery.downCount.js"></script>
<script src="{{ PUBLIC_DIR}}/Frontend/js/jquery.nicescroll.min.js"></script>
<script src="{{ PUBLIC_DIR}}/Frontend/js/jquery.magnific-popup.min.js"></script>
<script src="{{ PUBLIC_DIR}}/Frontend/js/jquery.ajaxchimp.js"></script>
<script src="{{ PUBLIC_DIR}}/Frontend/js/contact-form.js"></script>

<!--===== ACTIVE JS=====-->
<script src="{{ PUBLIC_DIR}}/Frontend/js/main.js"></script>
</body>

@endsection

@section('js')

</html>

@endsection
