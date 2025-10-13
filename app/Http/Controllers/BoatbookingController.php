<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BoatSchedule;
use App\Models\BoatCustomBooking;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BoatbookingController extends Controller
{
   public function boat_booking(){
    $boat_lists = BoatCustomBooking::where('status','Y')->get();
    $testimonials = DB::table('testimonials')->where('status',0)->where('delete',0)->get(); 
    $faqs = DB::table('faq')->where(['status'=> 0 , 'delete' => 0])->get();
    $date = date('Y-m-d', strtotime("+1 day"));
    $tourlocations = DB::table('locations')->get(); 
    $partners = DB::table('partners')->get(); 

    return view('booking.boat.boat-list', compact('boat_lists','testimonials','faqs', 'date', 'tourlocations', 'partners'));
   } 



    public function boat_booking_search(Request $request){
   
                $data['boat_lists'] = BoatCustomBooking::where('status','Y')->get();
                

                $id = $request->input('id');
                $date = $request->input('date');
                $no_of_pax = $request->input('passengers');
                $infants = $request->input('infants');

                $rules = [
                    'passengers' => ['required', 'integer', 'min:1', 'max:8'],
                ];


                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                try {
                    $parsedDate = Carbon::parse($date);
                
                } catch (\Exception $e) {
                    return back()->withErrors(['date' => 'Invalid date format']);
                }

                $data['boat_datas'] = DB::table('boat_schedule')
                    ->where('id', $id)
                    ->where('status', 'Y')
                    ->where('from_date', '<=', $parsedDate)
                    ->where('to_date', '>=', $parsedDate)
                    ->first();

                    
                    if(!empty($data['boat_datas'])){
                        if($data['boat_datas']->is_chartered_boat == 'Y'){
                            $boat_price_detail = DB::table('boat_schedule_price')->where(['boat_schedule_id'=> $id, 'no_of_passenger'=>$no_of_pax])->first();
                            $data['boat_price'] = $boat_price_detail->per_passenger_price;
                        } else {
                            $data['boat_price'] = $data['boat_datas']->price;
                        }
                    } 

                    return view('booking.boat.search-result-boat', $data);
    }

    public function boatBookingPage()
    {
        $boat_lists = BoatCustomBooking::where('status','Y')->get();
        return view('booking.boat.boat-booking', compact('boat_lists'));
    }
}

