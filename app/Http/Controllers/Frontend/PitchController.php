<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Frontend\Pitch;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class PitchController extends BaseController
{
    public function PitchesIndex()
    {
        $pitches = Pitch::get();

        return view('frontend.pitches.index', [
            'title' => 'Find A Pitch',
            'pitches' => $pitches
        ]);
    }

    public function PitchDetails(Request $request)
    {
        $params = $request->query();

        $pitch_id = $params['pitch_id'];

        $pitch = Pitch::find($pitch_id);

        return view('frontend.pitches.details', [
            'title' => 'Pitch Details',
            'pitch' => $pitch
        ]);
    }

    public function PitchWeather(Request $request)
    {
        $params = $request->query();

        $pitch_id = $params['pitch_id'];

        $pitch = Pitch::find($pitch_id);

        /** get forecast for next 5 days */
        $start = Carbon::now()->startOf('day')->format('Y-m-d');
        $end = Carbon::now()->startOf('day')->addDays(4)->format('Y-m-d');

        $response = Http::get('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/' . $pitch->lat .',' . $pitch->lon . '/' . $start .'/' . $end .'?key=ARRP3L8VYS7ALS5TZYA9WVJPS&unitGroup=metric');

        $body = $response->json();

        return Response()->json($body, 200, [], JSON_PRETTY_PRINT);
    }

}
