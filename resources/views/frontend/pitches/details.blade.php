@extends('frontend._layouts.app')
@section('content')
    <div class="pitch-up-details">
        <div class="course_area course-grid course-details" id="course">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                        <div class="row">
                            <div class="col-md-12">
                                @include('frontend.components.pitches.pitch_details_description_main', ['pitch' => $pitch])
                            </div>
                        </div>
                    </div>

                    <div class=" col-lg-4 col-md-4 col-sm-5 col-xs-12 sidebar-right content-widget pdsr">
                        @include('frontend.components.pitches.pitch_details_info_bar', ['pitch' => $pitch])
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title2">
                            <h2>In The Area...</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        @include('frontend.components.pitches.pitch_details_box_small', ['pitch' => $pitch])
                    </div>
                </div>
            </div>
        </div>
        <!-- BLOG_AREA END -->
    </div>
@endsection
{{-- jQuery--}}
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
{{--<script type="text/javascript" src="{{ asset('js') }}/frontend/pitches/pitch-details.js"></script>--}}
<script>
    let pitch = {!! $pitch !!};

    $(document).ready(function() {
        getWeatherData(pitch);
    });

    function getWeatherData(pitch) {
        $.ajax({
            url: '{{ route('pitch.weather') }}',
            type: 'GET',
            data: {
                pitch_id: pitch.id
            },
            success: function(response) {
                for(let day of response.days) {
                    let dayName = moment(day.datetime, 'YYYY-MM-DD').format('ddd');
                    let weatherIcon = "";
                    switch (day.icon) {
                        case "rain":
                            weatherIcon = 'fa-regular fa-cloud-rain'
                            break;
                        case "snow":
                            weatherIcon = 'fa-regular fa-cloud-snow'
                            break;
                        case "wind":
                            weatherIcon = 'fa-regular fa-wind'
                            break;
                        case "fog":
                            weatherIcon = 'fa-regular fa-cloud-fog'
                            break;
                        case "cloudy":
                            weatherIcon = 'fa-regular fa-cloud'
                            break;
                        case "partly-cloudy-day":
                            weatherIcon = 'fa-regular fa-cloud'
                            break;
                        case "partly-cloudy-night":
                            weatherIcon = 'fa-regular fa-clouds-moon'
                            break;
                        case "clear-day":
                            weatherIcon = 'fa-regular fa-sun'
                            break;
                        case "clear-night":
                            weatherIcon = 'fa-sharp fa-moon'
                            break;
                        default:
                            break;
                    }

                    $('#weather_form #weather_data').append(`
                        <div class="col-lg-2 col-xs-2" style="display: flex; justify-content: center;">
                            <div style="flex: 1; align-content: space-between">
                                <div class="text-center weather-stat"><b>` + dayName + `</b></div>
                                <div class="text-center weather-stat">` + day.temp + `</div>
                                <div class="text-center weather-stat"><i class="` + weatherIcon + `"></i></div>
                                <div class="text-center weather-stat">` + day.precipprob + `%</div>
                                <div class="text-center weather-stat">` + day.windspeed + `</div>
                            </div>
                        </div>
                    `);
                }
                /** add the units on the end in same format */
                $('#weather_form #weather_data').append(`
                    <div class="col-lg-2 col-xs-2" style="display: flex; justify-content: center;">
                        <div>
                            <div class="text-center weather-stat"></div>
                            <div class="text-center weather-stat">&#8451</div>
                            <div class="text-center weather-stat"></div>
                            <div class="text-center weather-stat"><i class="fa fa-droplet"></i></div>
                            <div class="text-center weather-stat"><i class="fa fa-wind"></i></div>
                        </div>
                    </div>
                `);

                $('#weather_form #weather_data').slideDown();

                $('#weather_form  .fa-spinner').hide(); /** hide the loading wheel */
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

</script>
