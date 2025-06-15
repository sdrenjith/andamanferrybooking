<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class SightseeingController extends Controller
{
    public function index(Request $request)
    {
        $data = $requestdata = array();
        $loc_response_data = Http::post(config('app.api_base') . 'destinationlist');
        $loc_data = json_decode($loc_response_data);
        if (!empty($request->input('location'))) {
            $requestdata['location_id'] = $request->input('location');
        }
        $response_data = Http::post(config('app.api_base') . 'sightseeinglist', $requestdata);
        $data = json_decode($response_data);
        //echo "<pre>";print_r($requestdata);die;
        return view('sightseeing.index', compact('data', 'loc_data'));
    }
    
    public function detail($id)
    {
        $data = $requestdata = $other_data = array();
        $response_data = Http::post(config('app.api_base') . 'sightseeinglist/' . $id);
        $data = json_decode($response_data);


        if (!empty($data->data[0]->location->id)) {
            $requestdata['location_id'] = $data->data[0]->location->id;

            $other_response_data = Http::post(config('app.api_base') . 'sightseeinglist', $requestdata);
            $other_data = json_decode($other_response_data);
        }
        //echo "<pre>";print_r($data);die;
        return view('sightseeing.detail', compact('data','other_data'));
    }
}
