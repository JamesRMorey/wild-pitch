<!-- HEADER DEFAULT MANU AREA -->
<div class="dreamit-main-menu one_page hidden-xs hidden-sm">
    <div class="dreamit_nav_area scroll_fixed">
        <div class="container">
            <div class="row logo-left">
                <!-- LOGO -->
                <div class="col-md-3 col-sm-3 col-xs-4">
                    <div class="logo">
                        <a class="main_sticky_main_l" href="{{ route('welcome.index') }}" title="wildpitch">
{{--                            <img src="{{ asset('dream-it-assets') }}/images/1.png" alt="dreamit" />--}}
                            <h4>Wild Pitch</h4>
                        </a>
                        <a class="main_sticky_l" href="{{ route('welcome.index') }}" title="wildpitch">
{{--                            <img src="{{ asset('dream-it-assets') }}/images/logo-tr.png" alt="dreamit" />--}}
                            <h4>Wild Pitch</h4>
                        </a>
                    </div>
                </div>

                <!-- MAIN MENU -->
                <div class="col-md-9 col-sm-9 col-xs-8">
                    <nav class="dreamit_menu main-search-menu">
                        <ul class="sub-menu nav_scroll">
{{--                            <li><a href="{{ route('pitches.index') }}">Find a pitch</a></li>--}}
                            <li><a href="#package">About</a>
                                <ul class="sub-menu">
                                    <li><a href="package-1.html">Meet The Team</a></li>
                                    <li><a href="single-package.html">Mission</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('pitches.index') }}">find a pitch</a></li>
                            <li><a href="hotel.html">Tips</a>
                                <ul class="sub-menu">
                                    <li><a href="package-1.html">Wild Camping Law</a></li>
                                    <li><a href="single-package.html">Gear Review</a></li>
                                </ul>
                            </li>
                            <li><a href="#blog">Blog</a></li>
                            <li><a href="{{ route('pitches.index') }}">contact</a></li>
                        </ul>
                        <div class="donate-btn-header">
                            <a class="dtbtn" href="{{ route('pitches.index') }}">Go Wild</a>
                        </div>
                    </nav>
                </div>
                <!-- END MAIN MENU -->
            </div>
        </div>
    </div>
</div>
<!-- END HEADER MENU AREA -->
