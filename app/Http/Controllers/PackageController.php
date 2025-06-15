<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
Use App\Models\Activity_category;
Use App\Models\Package_style_master;
Use App\Models\Itinerary;
Use App\Models\Package_hotels;
Use App\Models\Hotels;
Use App\Models\Activity;
Use App\Models\Sightseeing;
Use App\Models\Sightseeing_location;
Use App\Models\Itinerary_location;
Use App\Models\Cars;
Use DB;
use Illuminate\Support\Facades\Session;
use Exception;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $requestdata = array();
        if (!empty($request->input('search_txt'))) {
            $requestdata['search_txt'] = $request->input('search_txt');
        }
        if (!empty($_REQUEST['style_type'])) {
            $requestdata['style_type'] = ($_REQUEST['style_type']);

        }

        $response_data = Http::post(config('app.api_base') . 'packagelist', $requestdata);
        $data['package'] = json_decode($response_data); 
        $package_style = Package_style_master::where('status', 0)->get();

        // echo "<pre>";print_r($data);die;

        return view('package.index', compact('data', 'package_style'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function detail($id)
    {
        $data = $requestdata = $other_data = array();
        $response_data = Http::post(config('app.api_base') . 'packagelist/' . $id);
        $data = json_decode($response_data);

        if (!empty($data->data)) {
            $other_response_data = Http::post(config('app.api_base') . 'packagelist');
            $other_data = json_decode($other_response_data);
        }
       
        $itinerarys= Itinerary::where('package_id', $id)->with('sightseeingmodel','hotels','activity')->get();

        $activitySum= 0;
        foreach($itinerarys as $rowIti){
            $activitySum += $rowIti->activity->price;
        }
    
        // echo "<pre>"; 
        // print_r($activitySum);
        // die();
       
        foreach($itinerarys as $itn) {  
            $sightseeing_id=$itn->sightseeingmodel->id;
          
            $location = $itn->location_id;
            $itinerary_id=$itn->id;

            $itn->itinerary_location= Itinerary_location::where('itinerary_id',$itinerary_id)->with('sightseeing_location')->get();
            
            // $sightseeing_place= Sightseeing_location::where('status', 0)->where('sightseeing_id', $sightseeing_id)->get();
            $itn->sightseeing_place= Itinerary_location::with('sightseeing_location')->where('itinerary_id', $itinerary_id)->where('type', 'location')->get();

            // $itinerary = Itinerary::with('sightseeingmodel', 'sightseeingmodel.sight_locations')->where('package_id', $id)->get()->toArray();
            $itinerary = DB::table('itinerarys as i')
            ->select('users.id','users.name','profiles.photo')
            ->join('sightseeing_location as sl','sl.sightseeing_id','=','i.sightseeing_id')
            ->where(['i.package_id' => $id, 'sl.sightseeing_id' => $sightseeing_id])
            ->sum('sl.hatchback_price');

            $itn->sightseeing_price = $itinerary;

        }     

        $cars= Cars::where('status', 0)->get();

        return view('package.detail', compact('data', 'other_data', 'itinerarys','cars', 'activitySum'));
    }

    public function home_package()
    {
        $data = array();
        $response_data = Http::post(config('app.api_base') . 'packagelist');
        $package = json_decode($response_data); 

    $html= view('package.home_package', compact('package'));
       $data['html']=(string)$html;
       $data['success']=1;

       return json_encode($data);
    }


    public function itinerary_activity(Request $request)
    {
        $input=$request->all();
        $location_id= $input['get_location_id'];
        $itinerary_day= $input['itinerary_day'];
        $active_activity_id= $input['active_activity_id']; 


        $activities= Activity::where('location_id', $location_id)->with('activity_images')->get();

        $html= view('package.dropdown_activity', compact('activities', 'itinerary_day', 'active_activity_id', 'location_id'));
        $data['html']=(string)$html;
        $data['success']=1;

        return json_encode($data);
        // return view('package.itinerary_activity', compact('activity'));
    }

    
    public function change_activity_select_wise(Request $request)
    {
        $input=$request->all();
        $id= $input['actv_id'];
        $location_id= $input['get_location_id'];
        $itinerary_day= $input['itinerary_day'];
 
        $activity= Activity::where('id', $id)->with('activity_images')->first();
        $html= view('package.itinerary_activity', compact('activity', 'itinerary_day', 'location_id'));
        $data['html']=(string)$html;
        $data['success']=1;

        return json_encode($data);
    }

    public function itinerary_sightseeing_location(Request $request)
    {
        $input=$request->all();
        echo "<pre>";
       print_r( $input);
        die();
    }

    public function itinerary_hotel(Request $request)
    {
        $input=$request->all();
        $location_id= $input['get_location_id'];
        $itenaryDay= $input['itenaryDay'];
        
        $hotels = Hotels::with('hotel_price', 'hotel_facilities', 'hotel_category', 'hotel_images', )
        ->where('location_id', $location_id)
        ->get();

        $html= view('package.itinerary_hotel', compact('hotels', 'itenaryDay', 'location_id'));
        $data['html']=(string)$html;
        $data['success']=1;
        
        return json_encode($data);
    }
    public function change_hotel_select_wise(Request $request)
    {
        $input=$request->all();
        $hotel_id= $input['hotel_id'];
        $location_id= $input['get_location_id'];
        $itineraryday= $input['itineraryday'];
        
        $hotels= Hotels::where('id', $hotel_id)->with('hotel_images','hotel_price', 'hotel_facility')->first();

        $html= view('package.change_hotel', compact('hotels', 'location_id', 'itineraryday'));
        $data['html']=(string)$html;
        $data['success']=1;

        return json_encode($data);

       
    }
    public function change_car_select_wise(Request $request)
    {
        $input=$request->all();
        $car_id= $input['car_id'];
        $package_id = $input['package_id'];

        $car= Cars::where('id', $car_id)->first();

        $itinerary = Itinerary::with('sightseeingmodel', 'sightseeingmodel.sight_locations')->where('package_id', $package_id)->get()->toArray();
        
        $priceData = array();

        foreach($itinerary as $row){
            

            foreach($row['sightseeingmodel']['sight_locations'] as $innerRow){

                if($car_id == 1){
                    $priceData[$innerRow['sightseeing_id']]['price'] = !empty($priceData[$innerRow['sightseeing_id']]['price']) ? $priceData[$innerRow['sightseeing_id']]['price'] + $innerRow['hatchback_price'] : $innerRow['hatchback_price']; 
                } else if($car_id == 2){
                    $priceData[$innerRow['sightseeing_id']]['price'] = !empty($priceData[$innerRow['sightseeing_id']]['price']) ? $priceData[$innerRow['sightseeing_id']]['price'] + $innerRow['sedan_price'] : $innerRow['sedan_price']; 
                } else if($car_id == 3){
                    $priceData[$innerRow['sightseeing_id']]['price'] = !empty($priceData[$innerRow['sightseeing_id']]['price']) ? $priceData[$innerRow['sightseeing_id']]['price'] + $innerRow['xuv_price'] : $innerRow['xuv_price']; 
                } 
            }
        }

        $data['sightessing_price']  = $priceData;

        $html= view('package.change_car', compact('car',));
        $data['html']=(string)$html;
        $data['success']=1;

        return json_encode($data);
    }

    public function create_custom_package(Request $request)
    {
        $input=$request->all();
        var_dump(Session::all());
        //custom_package_input
        $car_id= $input['car_id'];
        $package_id= $input['package_id'];
        $journey_date = date('Y-m-d H:i:s');
        $userId = Session::get('get_user_id');

        $data = array();
        $data['car_type']= $car_id;
        $data['package_id']= $package_id;
        $data['user_id']=  $userId;
        $data['no_of_pax']= 1;
        $data['date_of_journey']= $journey_date;
        $data['created_by']= 1;

        $custom_package_id = DB::table('custom_packages')->insertGetId($data);

        //custom_package_hotel_input
        $hotel_ids= $input['hotel_ids'];
        $sightseeing_ids= $input['sightseeing_ids'];
  
        $itinerary_days= $input['itinerary_days'];
        $meal_ids = $input['meal'] ?? 0;
        $flower_bed= $input['flower_bed']?? 0;
        $candle_light= $input['candle_light']?? 0;
        $extra_person_with_mat= $input['extra_person_with_mat']?? 0;
        $extra_person_without_mat= $input['extra_person_without_mat']?? 0;

        if(!empty($input['activity_ids'])){
            $activity_ids= $input['activity_ids'];
        }
        

        $data1 = array();
        $data2 = array();
        $data3 = array();

        $data1['custom_package_id']=  $custom_package_id;
        $data2['custom_package_id']=  $custom_package_id;
        $data3['custom_package_id']=  $custom_package_id;
        $data1['category_id']= 1;
        $data1['cp']= 1;

        $data1['created_by']= 1;
        $data2['created_by']= 1;
        $data3['created_by']= 1;

        foreach($itinerary_days as $day){
            $data1['itinerary_day']= $day;
            $data2['itinerary_day']= $day;
            $data3['itinerary_day']= $day;
            $hotel_id = $hotel_ids[$day];
           
            $sightseeing_id = $sightseeing_ids[$day];

            $meal = $meal_ids[$day]?? 0;
            if ($meal > 0) {
                $data1['meal'] = 1;
            } else {
                $data1['meal'] = 0;
            }

            $extra_person_with_mattres = $extra_person_with_mat[$day]?? 0;
            if ($extra_person_with_mattres > 0) {
                $data1['extra_person_with_mattres'] = 1;
            } else {
                $data1['extra_person_with_mattres'] = 0;
            }

            $extra_person_without_mattres = $extra_person_without_mat[$day]?? 0;
            if ($extra_person_without_mattres > 0) {
                $data1['extra_person_without_mattres'] = 1;
            } else {
                $data1['extra_person_without_mattres'] = 0;
            }
            
            $flower_bed_decoration = $flower_bed[$day]?? 0;
            if ($flower_bed_decoration > 0) {
                $data1['flower_bed_decoration'] = 1;
            } else {
                $data1['flower_bed_decoration'] = 0;
            }

            $candle_light_dinner = $candle_light[$day]?? 0;
           
            if ($candle_light_dinner > 0) {
                $data1['candle_light_dinner'] = 1;
            } else {
                $data1['candle_light_dinner'] = 0;
            }

            $data1['hotel_id']=  $hotel_id;
            $data2['sightseeing_id']=  $sightseeing_id;
            
          
            $custom_package_hotel_id = DB::table('custom_package_hotel')->insert($data1);
            $custom_package_sightseeing_id = DB::table('custom_package_sighseeing')->insert($data2);

           if (isset($activity_ids[$day])) {
                foreach ($activity_ids[$day] as $activity_id) {
                $data3['activity_id'] = $activity_id;
                DB::table('custom_package_activity')->insert($data3);
                }
            }
        }

        $data['success']=1;
        $data['custom_package_id']=$custom_package_id;
        return json_encode($data);
    }

    
    public function new_booking(Request $request)
    {

        $user_id = Session::get('get_user_id');
        
        
        $custom_package_id = $request->input('custom_package_id');

        $package_details= DB::table('custom_packages as cpg')
        ->leftJoin('packages as p', 'p.id','=','cpg.package_id')
        ->where('cpg.id', $custom_package_id)
        ->first();

        $activity_price = DB::table('custom_packages as cpg')
            ->leftJoin('custom_package_activity as cpa', 'cpa.custom_package_id', '=', 'cpg.id')
            ->join('activitys as a', 'a.id', '=', 'cpa.activity_id')
            ->where('cpg.id', $custom_package_id)
            ->select(DB::raw('SUM(a.price) as total_activity_price'))
            ->groupBy('cpg.id')
            ->first();
        
        $total_activity_price = $activity_price ? $activity_price->total_activity_price : 0;



        $car_fare = DB::table('custom_packages as cpg')
            ->leftJoin('custom_package_sighseeing as cps', 'cps.custom_package_id', '=', 'cpg.id')
            ->leftJoin('sightseeing_location as sl', 'sl.sightseeing_id', '=', 'cps.sightseeing_id')
            ->where('cpg.id', $custom_package_id)
            ->select(DB::raw("
                SUM(
                    CASE
                        WHEN cpg.car_type = 1 THEN sl.hatchback_price
                        WHEN cpg.car_type = 2 THEN sl.sedan_price
                        WHEN cpg.car_type = 3 THEN sl.xuv_price
                        ELSE 0
                    END
                ) as total_car_price
            
            "))
            ->first();
    
        $total_car_fare = $car_fare->total_car_price ;
        $total_car_fare = $total_car_fare ? $total_car_fare : 0;



        $hotel_room_price = DB::table('custom_package_hotel as cph')
            ->leftJoin('hotel_facilities as hf', 'hf.hotel_id', '=', 'cph.hotel_id')
            ->leftJoin('hotel_price as hp', function($join) {
                $join->on('hp.id', '=', 'cph.hotel_id')
                    ->where('hp.category_id', '=', 1);
            })
            ->where('cph.custom_package_id', $custom_package_id)
            ->select(DB::raw("
                SUM(
                    CASE
                        WHEN cph.cp = 1 THEN hp.cp
                        WHEN cph.map = 1 THEN hp.map
                        WHEN cph.ap = 1 THEN hp.ap
                        WHEN cph.ep = 1 THEN hp.ep
                        ELSE 0
                    END
                ) as total_hotel_room_price
            "))
            ->first();
    
        $total_hotel_room_price = $hotel_room_price ? $hotel_room_price->total_hotel_room_price : 0;

    
        $facility_price = DB::table('custom_package_hotel as cph')
            ->leftJoin('hotel_facilities as hf', 'hf.hotel_id', '=', 'cph.hotel_id')
            ->where('cph.custom_package_id', $custom_package_id)
            ->select(DB::raw("
                SUM(CASE WHEN cph.meal = 1 THEN COALESCE(hf.meal_price, 0) ELSE 0 END) +
                SUM(CASE WHEN cph.flower_bed_decoration = 1 THEN COALESCE(hf.flower_bed_price, 0) ELSE 0 END) +
                SUM(CASE WHEN cph.candle_light_dinner = 1 THEN COALESCE(hf.candle_light_dinner_price, 0) ELSE 0 END) +
                SUM(CASE WHEN cph.extra_person_with_mattres = 1 THEN COALESCE(hf.extra_person_with_mattres, 0) ELSE 0 END) +
                SUM(CASE WHEN cph.extra_person_without_mattres = 1 THEN COALESCE(hf.extra_person_without_mattres, 0) ELSE 0 END)
                AS total_facility_price
            "))
            ->first();

        $total_facility_price = $facility_price ? $facility_price->total_facility_price : 0;


        $total_price=$total_activity_price+$total_hotel_room_price+$total_facility_price+$total_car_fare;
        $gst_price= $total_price*18/100;
        $grand_total_amount=$total_price+$gst_price;
        
        Session::put('package_id', $custom_package_id);
        Session::put('amount', $grand_total_amount);
        
        return view('package.new_booking', compact('total_price', 'gst_price', 'package_details', 'custom_package_id'));
    }

   

    public function pdf(){

        return view('package.pdf_generate');
    }

    public function user_register(request $request){
        $input=$request->all();
        $mobile_no= $input['mobile_no'];
        function generateOTP($length) {
            $otp = '';
            for ($i = 0; $i < $length; $i++) {
                $otp .= random_int(1, 9);
            }
            return $otp;
        }
        
        // Example usage
        $otp = generateOTP(4);

        $data['phone_no']= $mobile_no;
        $data['otp']=$otp;
        $web_users_data = DB::table('web_users')->where('phone_no', $mobile_no)->first();

        if ($web_users_data) {
            $user_id = $web_users_data->id;
            DB::table('web_users')->where('id', $user_id)->update($data);
        } else {
            $user_id = DB::table('web_users')->insertGetId($data);
        }
    
        $data2['user_id']=$user_id;
        $data2['otp']= $otp;
        $data2['success']=1;

        return json_encode($data2);

    }

    public function booking_details(Request $request)
    {
        
        $request->validate([
            'full_name_per1' => 'required',
            'full_name_per2' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'date_of_journey' => 'required'
        ]);

       $input=$request->all();
       $email=  $input['email'];
       $mobile_no=  $input['mobile_no'];
       $date_of_journey=  $input['date_of_journey'];
       $custom_package_id=  $input['package_id'];
       $user_id = Session::get('get_user_id');
       
       $data=array();

       $full_name_per1=  $input['full_name_per1'];
       $gender_person1=  $input['gender_person1'];
       $age_per1=  $input['age_per1'];

       $full_name_per2=  $input['full_name_per2'];
       $gender_person2=  $input['gender_person2'];
       $age_per2=  $input['age_per2'];
        

       $data['user_id']= $user_id;
       $data['custom_package_id']= $custom_package_id;
       $data['email']= $email;
       $data['mobile_no']= $mobile_no;
       $data['journey_date']= $date_of_journey;
       $package_booking_details_id=DB::table('package_booking_details')->insertGetId($data);

       $data1=array();
       $data2=array();

       $data1['user_id']= $user_id;
       $data1['package_booking_details_id']= $package_booking_details_id;
       $data1['full_name']= $full_name_per1;
       $data1['gender']= $gender_person1;
       $data1['age']=$age_per1;
       $data1['email']= $email;
       $data1['mobile_no']= $mobile_no;
       DB::table('booking_traveller_details')->insert($data1);

       $data2['user_id']= $user_id;
       $data2['package_booking_details_id']=$package_booking_details_id;
       $data2['email']= $email;
       $data2['mobile_no']= $mobile_no;

       $data2['full_name']= $full_name_per2;
       $data2['gender']= $gender_person2;
       $data2['age']=$age_per2;
       DB::table('booking_traveller_details')->insert($data2);

        return redirect()->route('razorpay.payment', ['id' => $custom_package_id, 'package_booking_details_id' => $package_booking_details_id] )
        ->with('success', 'User details submitted successfully');

    }

    public function verify_otp(Request $request)
    {
        $mobile_no = $request->input('mobile_no');
        $enteredOTP = $request->input('enteredOTP');
    

        $user = DB::table('web_users')->where('phone_no', $mobile_no)->first();

        if ($user && $user->otp == $enteredOTP) {
            $otp= $user->otp;
            $user_id= $user->id;
            Session::put('get_user_id', $user_id );
            // OTP is correct
            return response()->json(['success' => 'OTP verified successfully.', 'user_id' => Session::get('get_user_id')]);
        } else {
            return response()->json(['error' => 'Invalid OTP or mobile number.'], 200);
        }
    }

    public function set_session(){
        Session::put("user_id", 5);
       
        echo Session::get("user_id");

        
    }
    public function get_session(){
       echo session('user_id');

    }
    

    

}
