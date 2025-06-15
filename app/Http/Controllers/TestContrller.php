<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
// Use App\Models\Activity_category;
// Use App\Models\Package_style_master;
// Use App\Models\Itinerary;
// Use App\Models\Package_hotels;
// Use App\Models\Hotels;
// Use App\Models\Activity;
// Use App\Models\Sightseeing;
// Use App\Models\Sightseeing_location;
// Use App\Models\Itinerary_location;
// Use App\Models\Cars;
// Use DB;
use Illuminate\Support\Facades\Session;
// use Exception;

class TestContrller extends Controller
{
    public function set_session()
    {
        Session::put('user_id', 5);
        echo Session::get('user_id');
    }

    public function get_session()
    {
        // session_start();
        print_r(Session::get('user_id'));
        die();
    }

}
