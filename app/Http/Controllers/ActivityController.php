<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use App\Models\Faq;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
       
        $data = $requestdata = array();
        if (!empty($request->input('search_txt'))) {
            $requestdata['search_txt'] = $request->input('search_txt');
        }
        $activity_cat = $_GET['activity_cat'] ?? null;

        if (!empty($_REQUEST['activity_type'])) {
            $requestdata['activity_type'] = ($_REQUEST['activity_type']);

        }


        if(!empty($activity_cat)){
            $requestdata['category_id'] =  $activity_cat;
            $response_data = Http::post(config('app.api_base') . 'activitylist', $requestdata);
            $data = json_decode($response_data);
        }else{
            $response_data = Http::post(config('app.api_base') . 'activitylist', $requestdata);
            $data = json_decode($response_data);       
            
        }


        
       
        //echo "<pre>";print_r($data);die;
        return view('activity.index', compact('data'));
    }
    public function detail($id)
    {
        $data = $requestdata = $other_data = array();
        $response_data = Http::post(config('app.api_base') . 'activitylist/' . $id);
        $data = json_decode($response_data);
        $faq= Faq::get()->where('status', 0)-> where ('delete', 0)->where('related_module', 'activity');


        if (!empty($data->data)) {
            $other_response_data = Http::post(config('app.api_base') . 'activitylist');
            $other_data = json_decode($other_response_data);
        }
        //echo "<pre>";print_r($data);die;
        // Test
        return view('activity.detail', compact('data', 'other_data', 'faq'));
    }
    public function home_activity()
    {
        $data = array();
        $response_data = Http::post(config('app.api_base') . 'activitylist');
        $data = json_decode($response_data);
      
        return view('activity.home_activity', compact('data')); 
    }
}
