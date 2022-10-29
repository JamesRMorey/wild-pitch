@extends('frontend._layouts.app')
@section('content')
    <!-- Slick Slider area start -->
    <div class="slick-slider-area" id="home">
        <div class="slick-main slider-navegarion-style-one">
            <div class="slick-single-slider slider-2 text-center" data-stellar-background-ratio="0.3"
                 style="background: url('{{ asset('assets') }}/images/slider/wild_camp_1.jpg');">
                <div class="slider-content">
                    <h1>Amazing Experiences Only</h1>
                    <h1>Wild Camping Can Offer </h1>
                    <p>Pitches Provided By Verified UK Campers</p>
                    <a href="{{ route('pitches.index') }}" class="button">find a pitch</a>
                    <div class="scroll-next text-center wow infinite fadeInDown" data-wow-duration="2s">
                        <a href="#about"><i class="fa fa-long-arrow-down"></i></a>
                    </div>
                </div>
            </div>
            <div class="slick-single-slider slider-1 text-center" data-stellar-background-ratio="0.3"
                 style="background: url('{{ asset('assets') }}/images/slider/wild_camp_2.jpg');">
                <div class="slider-content">
                    <h1>Your Pitch,</h1>
                    <h1>Your Adventure </h1>
                    <p>Find The Best Wild Camping Spots in the United Kingdom</p>
                    <a href="{{ route('pitches.index') }}" class="button">find a pitch</a>
                    <div class="scroll-next text-center wow infinite fadeInDown" data-wow-duration="2s">
                        <a href="#about"><i class="fa fa-long-arrow-down"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Slider area end -->

    {{-- Popular pitches section--}}
    <div class="popular_package_area home-2">
        <div class="container">
            <div class="row">
                <!-- area section title-->
                <div class="col-md-12">
                    <div class="section-title  t_center">
                        <!-- title -->
                        <h2>Trending<span> Pitches</span></h2>
                        <i class="fa fa-fire"></i>
                        <!-- TEXT -->
                        <p>Todays most popular pitches from our users</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($pitches as $pitch)
                    <!-- SINGLE PACKAGE -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        @include('frontend.components.pitches.pitch_details_box_small', ['pitch' => $pitch])
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Our blogs section start --}}
    <div class="feature_area_main style2">
        <div class="container">
            <div class="row">
                <!-- area section title-->
                <div class="col-md-12">
                    <div class="section-title  t_center">
                        <!-- title -->
                        <h2>Our Latest Blogs<span> @wildpitch</span></h2>
                        <i class="fa fa-book"></i>
                        <!-- TEXT -->
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="row main_feature">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="feature-curousel owl-carousel curosel-style">
                            <div class="col-md-12">
                                <div class="single_feature">
                                    <div class="feture_icon">
                                        <i class="fa fa-car"></i>
                                    </div>
                                    <div class="feature_content">
                                        <h2>Travel Arrangements</h2>
                                        <p>There are many variations of passages of Lorem Ipsum available but the
                                            majority have suffered alteration.</p>
                                    </div>
                                    <div class="feature_button">
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single_feature">
                                    <div class="feture_icon">
                                        <i class="fa fa-plane"></i>
                                    </div>
                                    <div class="feature_content">
                                        <h2>Cheap Flights</h2>
                                        <p>There are many variations of passages of Lorem Ipsum available but the
                                            majority have suffered alteration.</p>
                                    </div>
                                    <div class="feature_button">
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single_feature">
                                    <div class="feture_icon">
                                        <i class="fa fa-usd"></i>
                                    </div>
                                    <div class="feature_content">
                                        <h2>Best Price Guarantee</h2>
                                        <p>There are many variations of passages of Lorem Ipsum available but the
                                            majority have suffered alteration.</p>
                                    </div>
                                    <div class="feature_button">
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single_feature">
                                    <div class="feture_icon">
                                        <i class="fa fa-usd"></i>
                                    </div>
                                    <div class="feature_content">
                                        <h2>Best Price Guarantee</h2>
                                        <p>There are many variations of passages of Lorem Ipsum available but the
                                            majority have suffered alteration.</p>
                                    </div>
                                    <div class="feature_button">
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single_feature">
                                    <div class="feture_icon">
                                        <i class="fa fa-car"></i>
                                    </div>
                                    <div class="feature_content">
                                        <h2>Travel Arrangements</h2>
                                        <p>There are many variations of passages of Lorem Ipsum available but the
                                            majority have suffered alteration.</p>
                                    </div>
                                    <div class="feature_button">
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- Our blogs section end--}}

    {{-- popular pitches section end--}}
    @include('frontend.components.email_subscribe')

@endsection
