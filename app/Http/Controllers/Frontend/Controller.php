<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Frontend\Pitch;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function WelcomeIndex()
    {
        $pitches = Pitch::get()->take(6);

        return view('frontend.welcome', [
            'pitches' => $pitches
        ]);
    }
}
