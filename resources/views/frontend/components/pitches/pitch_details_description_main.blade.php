<div class="course_details">
    <div class="course_title">
        <h1>{{ $pitch->title }}</h1>
        <p>{{ $pitch->subtitle }}</p>
    </div>
    <br>
    <div class="blog_dtl_thumb">
        <div class="slick-slider-area" id="home" style="height: 40vh;">
            <div class="slick-main slider-navegarion-style-one" style="height: 40vh;">
                <div class="slick-single-slider slider-2 text-center" data-stellar-background-ratio="0.3" style="background: url('{{ asset('dream-it-assets') }}/images/slide-5.jpg'); height: 40vh;"></div>
                <div class="slick-single-slider slider-1 text-center" data-stellar-background-ratio="0.3" style="background: url('{{ asset('dream-it-assets') }}/images/slider-1.jpg'); height: 40vh;" ></div>
                <div class="slick-single-slider slider-1 text-center" data-stellar-background-ratio="0.3" style="background: url('{{ asset('dream-it-assets') }}/images/dest3.jpg'); height: 40vh;" ></div>
            </div>
        </div>
    </div>
    <div class="course_dtl_content">
        <p>{{ $pitch->description }}</p>
    </div>
    <br>
    <div class="course_single_tab_inner">
        <h2>Pitch Info</h2>
        <ul>
            <li><i class="fa fa-map-marker"></i>Location <span>Thailand</span></li>
            <li><i class="fa fa-plane"></i>Start <span>Thailand</span></li>
            <li><i class="fa fa-calendar-check-o"></i>Difficulty <span>25/3/2022</span></li>
        </ul>
    </div>
</div>
