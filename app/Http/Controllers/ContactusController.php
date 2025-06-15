<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;

class ContactusController extends Controller
{
    public function index()
    {
        $data = array();
        return view('contactus.index', compact('data'));
    }

    public function save(Request $request)
    {
        $input = $request->all();
        if (!empty($input['name']) && !empty($input['email']) && !empty($input['mobile'])) {
            $insert_array['name'] = $input['name'];
            $insert_array['email'] = $input['email'];
            $insert_array['mobile'] = $input['mobile'];
            $insert_array['message'] = $input['message'];
            $response_data = Http::post(config('app.api_base') . 'contactsave', $insert_array);
            $data = json_decode($response_data);
            //echo "<pre>";print_r($data);die;
            if ($data->success == 1) {
                //return redirect()->route('ContactusController.index')
                //->with('success', $data->message);
                return Redirect::back()->with(['msg' => $data->message]);
            } else {
                return Redirect::back()->withErrors(['msg' => $data->message]);
            }
        }
    }
    public function book_a_call(Request $request){

        $validated = $request->validate([
            'mobile_no' => 'required|numeric',
            'name' => 'required|string|max:255',
        ]);
        $data = [
            'mobile' => $validated['mobile_no'],
            'name' => $validated['name'],
        ];
    
        DB::table('contactus')->insert($data);

        return response()->json(['success' => 'OTP verified successfully.']);
    }
}
