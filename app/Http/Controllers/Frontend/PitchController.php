<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Frontend\Pitch;

use App\Providers\ResponseServiceProvider;
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

        if(!isset($pitch)) abort(404, "We couldn't find that pitch");

        return view('frontend.pitches.details', [
            'title' => 'Pitch Details',
            'pitch' => $pitch
        ]);
    }

    public function PitchOthersInArea(Request $request)
    {
        $params = $request->query();

        $pitch_id = $params['pitch_id'];

        $pitch = Pitch::find($pitch_id);
        $lat = (float)$pitch->lat;
        $lng = (float)$pitch->lon;

        $pitches = Pitch::where('verified', 1)
            ->whereBetween('lat', [$lat-0.45, $lat+0.45])
            ->whereBetween('lon', [$lng-0.8, $lng+0.8])
            ->where('id', '!=', $pitch->id)
            ->get()->take(3);

        if(count($pitches) == 0) return $this->respondError(400, 'We dont have any other pitches around this area :(');

        return $this->respondSuccess(200, 'pitches found in the area', $pitches);
    }

}
