<?php

namespace App\Providers;

use App\Models\Frontend\Location;
use Illuminate\Support\ServiceProvider;

class GeoServiceProvider extends ServiceProvider
{
    public function __construct()
    {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function getLatLng($address)
    {
        $address = strtolower(preg_replace('/[^a-zA-Z]/i', '', $address));

        $location = Location::
            whereRaw('LOWER(REGEXP_REPLACE(name, "[^a-zA-Z]", "")) LIKE "%'.$address.'%"')
            ->first();

        if(!isset($location)) return false;

        $lat = $location->lat;
        $lng = $location->lng;

        return ['lat' => $lat, 'lng' => $lng];
    }
}
