<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class DestinationController extends Controller
{
    public function index()
    {
        $data = array();
        $response_data = Http::post(config('app.api_base') . 'destinationlist');
        $data = json_decode($response_data);
        //echo "<pre>";print_r($data);die;
        return view('destination.index', compact('data'));
    }
    public function home_destination()
    {
        $data = array();
        $response_data = Http::post(config('app.api_base') . 'destinationlist');
        $data = json_decode($response_data);
        //echo "<pre>";print_r($data);die;
        return view('destination.home_destination', compact('data'));
    }
}
