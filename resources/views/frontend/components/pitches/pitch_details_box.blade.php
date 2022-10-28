<div class="row">
    <div class="col-md-12">
        <div class="single_testimonial" style="display: flex; align-content: space-between;">
            <div style="flex: 2">
                <div class="em_testi_text">
                    <p>{{ $pitch->title }}</p>
                </div>
                <div class="em_testi_content">
                    <div class="em_testi_title">
                        <h2>{{ 'Something Here' }}<span>{{ $pitch->subtitle }}</span></h2>
                    </div>
                    <div>
                        <a class="btn" href="{{ route('pitch.details') }}?pitch_id={{ $pitch->id }}">Details</a>
                    </div>
                </div>
            </div>
            <div class="em_test_thumb" style="flex: 1; text-align: right; padding: 0; max-height: 150px;">
                <img style="aspect-ratio: 1; object-fit: contain; height: 100%" src="{{ url('dream-it-assets') }}/images/dest2.jpg" alt="">
            </div>
        </div>
    </div>
</div>

