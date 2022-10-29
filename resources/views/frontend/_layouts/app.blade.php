<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>@if (isset($title)) {{ $title }} @else Wild Pitch @endif</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- jQuery--}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="56x56" href="assets/images/fav-icon/icon.png">
	<!-- bootstrap CSS -->
	<link rel="stylesheet" 	href="{{ asset('dream-it-assets') }}/css/bootstrap.min.css" type="text/css" media="all" />
	<!-- venobox CSS -->
	<link rel="stylesheet" 	href="{{ asset('dream-it-assets') }}/venobox/venobox.css" type="text/css" media="all" />
	<!-- nivo-slider CSS -->
	<link rel="stylesheet" 	href="{{ asset('dream-it-assets') }}/css/animate.css" type="text/css" media="all" />
	<!-- slick CSS -->
	<link rel="stylesheet"  href="{{ asset('dream-it-assets') }}/css/slick.css" type="text/css" media="all" />
	<!-- owl-carousel CSS -->
	<link rel="stylesheet" 	href="{{ asset('dream-it-assets') }}/css/owl.carousel.css" type="text/css" media="all" />
	<!-- owl-transitions CSS -->
	<link rel="stylesheet" 	href="{{ asset('dream-it-assets') }}/css/owl.transitions.css" type="text/css" media="all" />
	<!-- font-awesome CSS -->
	<link rel="stylesheet"  href="{{ asset('dream-it-assets') }}/css/font-awesome.min.css" type="text/css" media="all" />
	<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" type="text/css" media="all" />
	<!-- meanmenu CSS -->
	<link rel="stylesheet"  href="{{ asset('dream-it-assets') }}/css/meanmenu.min.css" type="text/css" media="all" />
	<!-- theme-default CSS -->
	<link rel="stylesheet"  href="{{ asset('dream-it-assets') }}/css/theme-default.css" type="text/css" media="all" />
	<!-- widget CSS -->
	<link rel="stylesheet"  href="{{ asset('dream-it-assets') }}/css/widget.css" type="text/css" media="all" />
	<!-- unittest CSS -->
	<link rel="stylesheet"  href="{{ asset('dream-it-assets') }}/css/unittest.css" type="text/css" media="all" />
    <!-- leaflet CSS -->
    <link rel="stylesheet"  href="{{ asset('assets') }}/css/leaflet.css" type="text/css" media="all" />
	<!-- Main Style CSS -->
	<link rel="stylesheet"  href="{{ asset('dream-it-assets') }}/css/style.css" type="text/css" media="all" />
	<!-- responsive CSS -->
	<link rel="stylesheet"  href="{{ asset('dream-it-assets') }}/css/responsive.css" type="text/css" media="all" />
    <!-- fronted custom CSS -->
    <link rel="stylesheet"  href="{{ asset('frontend') }}/css/frontend.css" type="text/css" media="all" />
	<!-- modernizr js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/vendor/modernizr-3.5.0.min.js"></script>

</head>
<body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->


        @include('frontend._layouts.partials.top_banner')

        @include('frontend._layouts.partials.header_menu')

        @include('frontend._layouts.partials.mobile_menu')

        @yield('content')

        @include('frontend._layouts.partials.footer')

	<!-- Main jquery js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/vendor/jquery-3.2.1.min.js"></script>
    <!-- moment js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/vendor/moment.min.js"></script>
	<!-- bootstrap js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/bootstrap.min.js"></script>
	<!-- directional js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/jquery.directional-hover.min.js"></script>
	<!-- imagesloaded js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/imagesloaded.pkgd.min.js"></script>
	<!-- meanmenu js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/jquery.meanmenu.js"></script>
	<!-- isotope js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/isotope.pkgd.min.js"></script>
	<!-- owl-carousel js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/owl.carousel.min.js"></script>
	<!-- scrollUp js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/jquery.scrollUp.js"></script>
	<!-- nivo-slider js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/jquery.nivo.slider.pack.js"></script>
	<!-- counterup js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/jquery.counterup.min.js"></script>
	<!-- slick js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/slick.min.js"></script>
	<!-- jquery Nav js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/jquery.nav.js"></script>
	<!-- wow js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/wow.js"></script>
	<!-- scrolltofixed js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/jquery-scrolltofixed-min.js"></script>
	<!-- venobox js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/venobox/venobox.min.js"></script>
	<!-- waypoints js -->
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/waypoints.min.js"></script>
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/jquery.countdown.min.js"></script>
    {{--leaflet--}}
    <script type="text/javascript" src="{{ asset('assets') }}/js/leaflet-src.js"></script>

    {{-- google maps api--}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNUrYCkPswcjrl8YUE110fo1saIf6sQik&callback=initMap"></script>
	<!-- Main js -->
    <script type="text/javascript" src="{{ asset('js') }}/app.js"></script>
	<script type="text/javascript" src="{{ asset('dream-it-assets') }}/js/theme.js"></script>

	<script type="text/javascript" src="//themera.net/embed/themera.js?id=79364"></script>
{{--        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>--}}
	</body>
</html>
