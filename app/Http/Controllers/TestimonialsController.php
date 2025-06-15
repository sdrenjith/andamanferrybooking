<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class TestimonialsController extends Controller
{
    public function index()
    {
        $data = array();
        $response_data = Http::post(config('app.api_base') . 'testimoniallist');
        $data = json_decode($response_data);
        //echo "<pre>";print_r($data);die;
        return view('testimonials.index', compact('data'));
    }
    public function home_testimonials()
    {
        $response_data = Http::post(config('app.api_base') . 'testimoniallist');
        $data = json_decode($response_data);
        return view('testimonials.home_testimonials', compact('data'));
    }
}
