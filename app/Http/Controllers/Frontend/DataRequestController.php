<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Frontend\Location;
use App\Models\Frontend\Pitch;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class DataRequestController extends BaseController
{

    public function PitchWeather(Request $request)
    {
        $params = $request->query();
        $pitchId = $params['pitch_id'];

        if(!isset($pitchId)) return $this->respondError(400, 'no pitch provided');

        $pitch = Pitch::find($pitchId);

        if(!isset($pitch)) return $this->respondError(400, "we couldn't find that pitch");

        /** get forecast for next 5 days */
        $start = Carbon::now()->startOf('day')->format('Y-m-d');
        $end = Carbon::now()->startOf('day')->addDays(4)->format('Y-m-d');

        $response = Http::get('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/' . $pitch->lat .',' . $pitch->lon . '/' . $start .'/' . $end .'?key=ARRP3L8VYS7ALS5TZYA9WVJPS&unitGroup=metric');

        if($response->status() != 200) return $this->respondError(400, 'weather not found');

        $body = $response->json();

        return $this->respondSuccess(200, 'weather loaded', $body);
    }

    public function ProcessSearch(Request $request)
    {
        $params = $request->query();
        $locationId = $params['location_id'];

        if(!isset($locationId)) return $this->respondError(400, 'no location provided');

        $location = Location::find($locationId);

        if(!isset($location)) return $this->respondError(400, "we couldn't find that location");

        $lat = (float)$location->lat;
        $lng = (float)$location->lng;

        $pitches = Pitch::where('verified', 1)
            ->whereBetween('lat', [$lat-0.45, $lat+0.45])
            ->whereBetween('lon', [$lng-0.8, $lng+0.8])
            ->get();

        if(count($pitches) == 0) return $this->respondError(400, 'We dont have any pitches in that area :(');;

        return $this->respondSuccess(200, 'pitches found', $pitches);
    }

    public function LocationsForSearchTerm(Request $request)
    {
        $params = $request->query();
        $searchTerm = $params['search_term'];

        if(!isset($searchTerm)) return $this->respondError(400, 'no search term provided');

        $searchTerm = $this->prepTextForMatch($searchTerm);

        $locations = Location::
            whereRaw('LOWER(CONCAT(REGEXP_REPLACE(name, "[^a-zA-Z]", ""), REGEXP_REPLACE(county, "[^a-zA-Z]", ""))) LIKE "'.$searchTerm.'%"')
            ->get()
            ->take(6);

        if(count($locations) == 0) return $this->respondError(400, "We couldn't find that location :(");;

        return $this->respondSuccess(200, 'locations found', $locations);
    }

    private function prepTextForMatch($text)
    {
        $result = strtolower(preg_replace('/[^a-zA-Z]/i', '', $text));

        return $result;
    }

}
