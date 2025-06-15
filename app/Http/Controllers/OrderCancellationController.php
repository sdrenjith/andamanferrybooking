<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class OrderCancellationController extends Controller
 {
    public function ticket_cencel_request()
 {
        return view( 'ticket-cencel.cancel-ticket-request' );
    }

    public function ticket_cencel_preview( Request $request ) {

        if ( !empty( $request->pnr_id ) ) {
            
            $cancelledBookings = DB::table( 'pnr_status as ps' )
            ->leftJoin( 'booking as b', 'b.id', '=', 'ps.booking_id' )
            ->leftJoin( 'booking_passenger_details as bpd', 'bpd.booking_id', '=', 'b.id' )
             ->where( 'ps.pnr_id', $request->pnr_id )
             ->orwhere( 'b.order_id', $request->pnr_id )
            ->where( 'bpd.request_for_cancel', 'N' )
            ->exists();

            //dd( $cancelledBookings );
            if ( !$cancelledBookings ) {
                
                return redirect()->back()->with( 'msg', 'You Credential does not matched' );
                } else {
                $booking = DB::table( 'pnr_status as ps' )
                ->leftJoin( 'booking as b', 'b.id', '=', 'ps.booking_id' )
                ->leftJoin( 'booking_passenger_details as bpd', 'bpd.booking_id', '=', 'b.id' )
                ->where( 'ps.pnr_id', $request->pnr_id )
                ->orwhere( 'b.order_id', $request->pnr_id )
                ->where( 'bpd.request_for_cancel', 'N' )
                ->select( '*' )
                ->get();

             
                if (!empty($booking)) {
                     
                 if ( $booking[0]->type == 'ferry' ) {
                  
                        $data[ 'ferry_bookings' ] = $booking;

                        // $data[ 'ferry_bookings' ] = DB::table( 'booking' )
                        // ->leftJoin( 'ferry_schedule as fs', 'fs.id', '=', 'booking.schedule_id' )
                        // ->leftjoin( 'ship_master as sm', 'sm.id', 'fs.ship_id' )
                        // ->leftJoin( 'ferry_locations as from_location', 'from_location.id', '=', 'fs.from_location' )
                        // ->leftJoin( 'ferry_locations as to_location', 'to_location.id', '=', 'fs.to_location' )
                        // ->leftjoin( 'ferry_schedule_price as f_s_p', 'f_s_p.schedule_id', 'fs.id' )
                        // ->leftjoin( 'ship_classes as sc', 'sc.id', '=', 'f_s_p.class_id' )
                        // ->where( 'booking.id', $booking[0]->id )
                        // ->select( 'booking.*',  'sm.title', 'f_s_p.price', 'from_location.title as from_location_name', 'to_location.title as to_location_name', 'sm.title as master_title', 'sc.title as ship_class_title' )
                        // ->first();

                        // $data[ 'passenger_details' ] = DB::table( 'booking_passenger_details' )
                        // ->where( 'booking_id', $booking[0]->id )
                        // ->get();

                        return view( 'ticket-cencel.cancel-ticket-priview-ferry' )->with( $data );
                    
                } else {
                    return redirect()->back()->with( 'msg', 'Creadiancial Not Match' );
                }
            }

        } 
        }elseif( !empty( $request->booking_id ) ) {

            $is_exist = DB::table( 'booking as b' )
            ->leftJoin( 'booking_passenger_details as bpd', 'bpd.booking_id', '=', 'b.id' )
            ->where( 'b.order_id', $request->booking_id )
            ->where( 'bpd.request_for_cancel', 'N' )
            ->exists();

           

            if ( !$is_exist ) {
                return redirect()->back()->with( 'msg', 'Creadiancial Not Match' );
            } else {
                $cancelledBookings = DB::table( 'booking as b' )
                ->leftJoin( 'booking_passenger_details as bpd', 'bpd.booking_id', '=', 'b.id' )
                ->where( 'b.order_id', $request->booking_id )
                ->where( 'bpd.request_for_cancel', 'N' )
                ->get();

                    $data['boat_details'] = DB::table('booking as b')
                    ->leftJoin('boat_schedule', 'boat_schedule.id', '=', 'b.schedule_id')
                    ->leftJoin( 'booking_passenger_details as bpd', 'bpd.booking_id', '=', 'b.id' )
                    ->where('b.type', '=', 'boat')
                    ->where('bpd.request_for_cancel', '=', 'N')
                    ->where('b.order_id', $cancelledBookings[0]->order_id)
                    
                    ->get();    
 
                    return view( 'ticket-cencel.cancel-ticket-priview-boat' )->with( $data );

                
            }
        }
    }

    public function ticket_cencel_details_ferry( Request $request ){

        // DB::table( 'booking' )
        // ->where( 'id', $request->booking_id )
        // ->update( [
        //     'request_for_cancel' => 'Y',
        //     'request_for_cancel_date' => date( 'Y-m-d H:i:s' ),
        // ] );

        if ( !is_null( $request->passenger_ids ) && is_array( $request->passenger_ids ) ) {
            foreach ( $request->passenger_ids as $passengerId ) {
                DB::table( 'booking_passenger_details' )
                ->where( [ 'id' => $passengerId ] )
                ->update( [
                    'request_for_cancel' => 'Y',
                ] );
            }
        } else {
            return redirect()->back()->with( 'error', 'No passengers selected for cancellation.' );
        }

        return view( 'ticket-cencel.cancel-successful' );
    }

    public function ticket_cencel_details_boat( Request $request )
 {

        // DB::table( 'booking' )
        // ->where( 'id', $request->booking_id )
        // ->update( [
        //     'request_for_cancel' => 'Y',
        //     'request_for_cancel_date' => date( 'Y-m-d H:i:s' ),
        // ] );

        if ( !is_null( $request->passenger_ids ) && is_array( $request->passenger_ids ) ) {
            foreach ( $request->passenger_ids as $passengerId ) {

                DB::table( 'booking_passenger_details' )
                ->where( [ 'id' => $passengerId ] )
                ->update( [
                    'request_for_cancel' => 'Y',
                ] );
            }
        } else {
            return redirect()->back()->with( 'error', 'No passengers selected for cancellation.' );
        }
        return view( 'ticket-cencel.cancel-successful' );
    }
}
