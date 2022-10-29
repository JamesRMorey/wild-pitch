<!-- dreamit BREADCRUMB AREA -->
<div class="breatcome_area" style="background: url('{{ asset('assets') }}/images/banners/snowdon_reservoir_banner.png'); background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breatcome_title">
                    <div class="breatcome_title_inner">
                        <h2>@if(isset($title)){{ $title }}@else{{ 'Wild Pitch' }}@endif</h2>
                        <div class="breatcome_content">
                            <ul>
                                @if(isset($breadcrumbs))
                                    <li>{!! $breadcrumbs !!}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
