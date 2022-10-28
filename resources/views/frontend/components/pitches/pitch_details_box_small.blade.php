<div class="single_package">
    <div class="pack_thumb">
        <img src="{{ asset('dream-it-assets') }}/images/pk1.jpg" alt="" />
        <div class="package_price">
            <span><i class="fa fa-heart"></i></span>
        </div>
    </div>
    <div class="package_content">
        <div class="package_meta">
            <span><i class="fa fa-user"></i>Difficulty: {{ $pitch->difficulty }}</span>
            <span><i class="fa fa-calendar"></i>Popularity: 2</span>
        </div>
        <div class="package_title">
            <h2><a href="single-pack.html">{{ $pitch->title }}</a></h2>
            <span>Barselona, Spain</span>
        </div>
        <div class="package_content_inner">
            <div class="package_btn">
                <a href="{{ route('pitch.details') }}?pitch_id={{ $pitch->id }}">Details</a>
            </div>
        </div>
    </div>
</div>
