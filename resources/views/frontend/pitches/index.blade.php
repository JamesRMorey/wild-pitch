@extends('frontend._layouts.app')
@section('content')
    <div class="pitch-up">
        @include('frontend.components.breadcrumb', ['breadcrumbs' => '<a href="#">Home<i class="fa fa-angle-right"></i></a>Find A Pitch'])
        <div class="row" class="main-search-container" style="margin: 15px 0;">
            <div class="col-lg-12 col-md-12 col-xs-12">
                @include('frontend.components.search_bar', ['search_bar_button_text' => 'lets go!', 'search_bar_place_holder' => 'Where are you going?'])
            </div>
        </div>

        <div class="row" style="margin: 15px 0;">
            <div class="medium-container">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 sidebar-right content-widget pdsr">
                    <div class="blog-left-side widget">
                        <div id="em_recent_post_widget-8" class="widget widget_recent_data">
                            <div class="single-widget-item">
                                <h2 class="widget-title">Popular Post</h2>
                                <div class="recent-post-item">
                                    <div class="recent-post-image">
                                        <a href="#">
                                            <img width="100" height="80" src="assets/images/recent1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="recent-post-text">
                                        <h4><a href="#">
                                                3 Ways to Transform Your Blog Into
                                            </a>
                                        </h4>
                                        <span class="rcomment">October 16, 2018</span>
                                    </div>
                                </div>
                                <div class="recent-post-item">
                                    <div class="recent-post-image">
                                        <a href="#">
                                            <img width="100" height="80" src="assets/images/recent2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="recent-post-text">
                                        <h4><a href="#">
                                                How Important Is Design To Business.
                                            </a></h4>
                                        <span class="rcomment">October 16, 2018</span>
                                    </div>
                                </div>
                                <div class="recent-post-item">
                                    <div class="recent-post-image">
                                        <a href="#">
                                            <img width="100" height="80" src="assets/images/recent3.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="recent-post-text">
                                        <h4><a href="#">
                                                Your Small Business Web Design Solution.
                                            </a></h4>
                                        <span class="rcomment">October 16, 2018</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div id="categories-3" class="widget widget_categories">
                            <h2 class="widget-title">Categories</h2>
                            <ul>
                                <li class="cat-item cat-item-8"><a href="#/">Bridge Calbart</a>
                                </li>
                                <li class="cat-item cat-item-10"><a href="#">Corporate building</a>
                                </li>
                                <li class="cat-item cat-item-9"><a href="#">Corporate Office</a>
                                </li>
                                <li class="cat-item cat-item-11"><a href="#">Road Map</a>
                                </li>
                            </ul>
                        </div>
                        <div id="text-4" class="widget widget_text">
                            <h2 class="widget-title">Instagram</h2>
                            <div class="textwidget">
                                <div id="sb_instagram" class="sbi sbi_disable_mobile sbi_col_3 sbi_small"
                                     style="width:100%;" data-id="6711435208" data-num="6" data-res="auto" data-cols="3"
                                     data-options="{&quot;sortby&quot;: &quot;none&quot;, &quot;showbio&quot;: &quot;false&quot;, &quot;headercolor&quot;: &quot;&quot;, &quot;imagepadding&quot;: &quot;5&quot;}"
                                     data-sbi-index="0">
                                    <div id="sbi_images" style="padding: 5px;">
                                        <div class="sbi_item sbi_type_image">
                                            <div class="sbi_photo_wrap">
                                                <a class="sbi_photo" href="#">
                                                    <img src="assets/images/n.jpg" alt="" width="100" height="100">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="sbi_item sbi_type_image">
                                            <div class="sbi_photo_wrap">
                                                <a class="sbi_photo" href="#">
                                                    <img src="assets/images/n1.jpg" alt="" width="100" height="100">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="sbi_item sbi_type_image">
                                            <div class="sbi_photo_wrap">
                                                <a class="sbi_photo" href="#">
                                                    <img src="assets/images/n2.jpg" alt="" width="100" height="100">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="sbi_item sbi_type_image">
                                            <div class="sbi_photo_wrap">
                                                <a class="sbi_photo" href="#">
                                                    <img src="assets/images/n3.jpg" alt="" width="100" height="100">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="sbi_item sbi_type_image">
                                            <div class="sbi_photo_wrap">
                                                <a class="sbi_photo" href="#">
                                                    <img src="assets/images/n4.jpg" alt="" width="100" height="100">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="sbi_item sbi_type_image">
                                            <div class="sbi_photo_wrap">
                                                <a class="sbi_photo" href="#">
                                                    <img src="assets/images/n5.jpg" alt="" width="100" height="100">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="archives-3" class="widget widget_archive">
                            <h2 class="widget-title">Archives</h2>
                            <ul>
                                <li><a href="#">21 October 2018</a></li>
                                <li><a href="#">10 February 2018</a></li>
                            </ul>
                        </div>

                        <div id="tags" class="widget tagcloud">
                            <h2 class="widget-title">Archives</h2>
                            <a href="">Event</a>
                            <a href="">Food</a>
                            <a href="">Water</a>
                            <a href="">Glass</a>
                            <a href="">Ciramic</a>
                            <a href="">Plastic</a>
                            <a href="">Polite</a>
                            <a href="">Modern</a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    @foreach($pitches as $pitch)
                        @include('frontend.components.pitches.pitch-details-box', ['pitch' => $pitch])
                    @endforeach
                </div>
            </div>

        </div>

    </div>
@endsection

