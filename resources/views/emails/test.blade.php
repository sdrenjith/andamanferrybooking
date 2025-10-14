<!DOCTYPE html>
<html>
<head>
    <title>Email</title>
</head>
<body>
    <style>
        td{
            padding: 10px;
        }
        th{
            padding: 10px;
        }
    </style>

    @php
        $booking_id= $details['booking_id'];
        $trip2_booking_id= !empty($details['trip2_booking_id']) ? $details['trip2_booking_id'] : NuLL;
        $trip3_booking_id= !empty($details['trip3_booking_id']) ? $details['trip3_booking_id'] : NuLL;
        $greet= !empty($details['greet']) ? $details['greet'] : NuLL;
       
        //  $booking_id='401';
        //  $return_booking='402';

        $single_booking = DB::table('booking as b')
            ->leftJoin( 'booking_passenger_details as bpd', 'bpd.booking_id', '=', 'b.id' )
            ->leftJoin( 'pnr_status as ps', 'ps.booking_id', '=', 'b.id' )
            ->where('b.id', $booking_id)
            ->select('*', 'ps.pnr_id')
            ->get();

    @endphp

    <div style="padding:5px">
    @if(empty($greet))
        <div style="text-align: center; padding:10px">
            <h2 style="color: #1592eb; font-size:28px; margin:10px">Andaman Ferry Booking</h2>
            <div>
                <img src="https://andamanferrybookings.com/assets/images/logo.png" style="margin: 5px;" width="40px" alt="">
            </div>

            
            <div style="text-align: center; display: inline-block; background: #44707e; color: #FFF; font-size: 18px; padding: 5px 45px; border-radius: 5px;">
                <P>Payment Successful - Advance Booking Confirmed</P>
            </div>
        </div>

        <h5> Hi , &nbsp; {{$single_booking[0]->c_name}}, </h5>
        <h5> Your advance booking payment has been received successfully!</h5>
        <h5> Our team will contact you shortly to confirm your ferry booking details.</h5>
        @if(ucfirst($single_booking[0]->ship_name) == 'Makruzz')
        <b>Download PNR: <a href="https://makruzz.com/OnlineUserSeatSelection/print_ticket/{{ $single_booking[0]->pnr_id }}">Click here</a></b>
        @endif
    @else
     <h5> {{$greet}}.</h5>
    @endif
        <h2>[Order:{{$single_booking[0]->order_id}}]({{ date('M d, Y', strtotime($single_booking[0]->created_at))}})</h2>

        <div style="text-align: center; color:#636363;">
            <table style="border: 2px solid #e5e5e5; width: 100%;text-align: center; align-items: center;margin: 0 auto;border-collapse: collapse;">
                <thead style="border: 1px solid #e5e5e5">
                    <th style="border: 1px solid #e5e5e5">Product</th>
                    <th style="border: 1px solid #e5e5e5">No Of Passenger</th>
                    <th style="border: 1px solid #e5e5e5">Price</th>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: 1px solid #e5e5e5; width:70% ; text-align:left">
                            <h5>Booking For: <span style="padding-left:15px "> {{ucfirst($single_booking[0]->type)}} </span>  </h5>
                            <h5>Vessel: <span style="padding-left:15px "> {{ucfirst($single_booking[0]->ship_name)}} </span>  </h5> 
                            <h5>From Location: <span style="padding-left:15px "> {{  $single_booking[0]->from_location == 1 ? 'Port Blair' : ($single_booking[0]->from_location == 2 ? 'Havlock' : 'Neil') }} </span>  </h5> 
                            <h5>To Location: <span style="padding-left:15px "> {{ $single_booking[0]->to_location == 1 ? 'Port Blair' : ($single_booking[0]->to_location == 2 ? 'Havlock' : 'Neil') }} </span>  </h5> 
                            <h5>Journey Date: <span style="padding-left:15px "> {{$single_booking[0]->date_of_jurney}}  </span>  </h5>
                            {{-- <h5>Class: <span style="padding-left:15px "> {{ucfirst($single_booking[0]->ferry_class)}}  </span>  </h5> --}}
                        </td>
                        <td style="border: 1px solid #e5e5e5">{{$single_booking[0]->no_of_passenger}}</td>
                        <td style="border: 1px solid #e5e5e5">{{$single_booking[0]->amount}}</td>
                    </tr>
                    <tr style="border: 2px solid #e5e5e5;">
                        <td style="border: 1px solid #e5e5e5; width:80% ; text-align:left">Subtotal:</td>
                        <td style="border: 1px solid #e5e5e5;"></td>
                        <td style="border: 1px solid #e5e5e5">{{$single_booking[0]->amount}} </td>
                    </tr>

                    {{--********************* if return trip abook then show eturn details *****************--}}
                    @if(!empty($trip2_booking_id))
                        <?php
                            $trip2_booking_id = DB::table('booking as b')
                            ->leftJoin('booking_passenger_details as bpd', 'bpd.booking_id', '=', 'b.id')
                            ->leftJoin( 'pnr_status as ps', 'ps.booking_id', '=', 'b.id' )
                            ->where('b.id', $trip2_booking_id)
                            ->select('*', 'ps.pnr_id')
                            ->get();
                        ?>

                        <tr>
                            <td style="border: 1px solid #e5e5e5; width:70% ; text-align:left">
                                <h5 style="text-align: center">Round 2 Trip Details</h5>
                                <h5>Booking For: <span style="padding-left:15px "> {{ucfirst($trip2_booking_id[0]->type)}} </span>  </h5>
                                <h5>Vessel: <span style="padding-left:15px "> {{ucfirst($trip2_booking_id[0]->ship_name)}} </span>  </h5> 
                                <h5>From Location: <span style="padding-left:15px "> {{ucfirst($trip2_booking_id[0]->from_location)}} </span>  </h5> 
                                <h5>To Location: <span style="padding-left:15px "> {{ucfirst($trip2_booking_id[0]->to_location)}} </span>  </h5> 
                                <h5>Round 2 Date: <span style="padding-left:15px "> {{$trip2_booking_id[0]->date_of_jurney}}  </span>  </h5>
                                {{-- <h5>Class: <span style="padding-left:15px "> {{ucfirst($trip2_booking_id[0]->ferry_class)}}  </span>  </h5> --}}
                                
                            </td>
                            <td style="border: 1px solid #e5e5e5">{{$trip2_booking_id[0]->no_of_passenger}}</td>
                            <td style="border: 1px solid #e5e5e5">{{$trip2_booking_id[0]->amount}}</td>
                        </tr>
                        <tr style="border: 2px solid #e5e5e5;">
                            <td style="border: 1px solid #e5e5e5; width:80% ; text-align:left">Subtotal:</td>
                            <td style="border: 1px solid #e5e5e5;"></td>
                            <td style="border: 1px solid #e5e5e5">{{$trip2_booking_id[0]->amount}} </td>
                        </tr>

                        <tr>
                            <td colspan="3">
                                @if(ucfirst($trip2_booking_id[0]->ship_name) == 'Makruzz')
        <b>Download PNR: <a href="https://makruzz.com/OnlineUserSeatSelection/print_ticket/{{ $trip2_booking_id[0]->pnr_id }}">Click here</a></b>
        @endif
                            </td>
                        </tr>
                    @endif
                    {{-- *************end round 2 trip details --}}

                    {{-- ********* Round 3 Trip details --}}

                    @if(!empty($trip3_booking_id))
                    <?php
                        $trip3_booking_id = DB::table('booking as b')
                        ->leftJoin('booking_passenger_details as bpd', 'bpd.booking_id', '=', 'b.id')
                        ->leftJoin( 'pnr_status as ps', 'ps.booking_id', '=', 'b.id' )
                        ->where('b.id', $trip3_booking_id)
                        ->select('*', 'ps.pnr_id')
                        ->get();
                    ?>
                
                    <tr>
                        <td style="border: 1px solid #e5e5e5; width:70% ; text-align:left">
                            <h5 style="text-align: center">Round 3 Trip Details</h5>
                            <h5>Booking For: <span style="padding-left:15px "> {{ucfirst($trip3_booking_id[0]->type)}} </span>  </h5>
                            <h5>Vessel: <span style="padding-left:15px "> {{ucfirst($trip3_booking_id[0]->ship_name)}} </span>  </h5> 
                            <h5>From Location: <span style="padding-left:15px "> {{ucfirst($trip3_booking_id[0]->from_location)}} </span>  </h5> 
                            <h5>To Location: <span style="padding-left:15px "> {{ucfirst($trip3_booking_id[0]->to_location)}} </span>  </h5> 
                            <h5>Round 3 Date: <span style="padding-left:15px "> {{$trip3_booking_id[0]->date_of_jurney}}  </span>  </h5>
                            {{-- <h5>Class: <span style="padding-left:15px "> {{ucfirst($trip3_booking_id[0]->ferry_class)}}  </span>  </h5> --}}
                            
                        </td>
                        <td style="border: 1px solid #e5e5e5">{{$trip3_booking_id[0]->no_of_passenger}}</td>
                        <td style="border: 1px solid #e5e5e5">{{$trip3_booking_id[0]->amount}}</td>
                    </tr>
                    <tr style="border: 2px solid #e5e5e5;">
                        <td style="border: 1px solid #e5e5e5; width:80% ; text-align:left">Subtotal:</td>
                        <td style="border: 1px solid #e5e5e5;"></td>
                        <td style="border: 1px solid #e5e5e5">{{$trip3_booking_id[0]->amount}} </td>
                    </tr>
                    <td colspan="3">
                        @if(ucfirst($trip3_booking_id[0]->ship_name) == 'Makruzz')
<b>Download PNR: <a href="https://makruzz.com/OnlineUserSeatSelection/print_ticket/{{ $trip3_booking_id[0]->pnr_id }}">Click here</a></b>
@endif
                    </td>
                </tr>
                @endif

                    <tr>
                        <td style="border: 1px solid #e5e5e5 width:80%; text-align:left" >Payment method:</td>
                        <td style="border: 1px solid #e5e5e5;"></td>
                        <td style="border: 1px solid #e5e5e5">phonepe</td>
                    </tr>
                    <tr style="border: 2px solid #000; padding:10px">
                        <td style="border: 1px solid #e5e5e5 width:80%; text-align:center" >Total:</td>
                        <td style="border: 1px solid #e5e5e5;"></td>

                        <?php $single_price=($single_booking[0]->amount) ?? 0; ?>
                        <?php $round_2_price=($trip2_booking_id[0]->amount) ?? 0; ?>
                        <?php $round_3_price=($trip3_booking_id[0]->amount) ?? 0; ?>
                        <?php $total_price=($single_price+$round_2_price+$round_3_price) ?? 0; ?>

                        <td style="border: 1px solid #e5e5e5">{{$total_price}} </td>
                    </tr>
                </tbody>
            </table>

            <div>
                <h4 style="color:#636363"> Passenger Details</h4>
                <table style="border: 2px solid #e5e5e5; text-align: center; align-items: center;border-collapse: collapse; width:100%; margin: 0 auto;">
                    <thead>
                        <th style="border: 2px solid #e5e5e5; text-align: center;">SL</th>
                        <th style="border: 2px solid #e5e5e5; text-align: center;">Title</th>
                        <th style="border: 2px solid #e5e5e5; text-align: center;">Passenger Name</th>
                        <th style="border: 2px solid #e5e5e5; text-align: center;">Gender</th>
                        <th style="border: 2px solid #e5e5e5; text-align: center;">Age</th>
                        <th style="border: 2px solid #e5e5e5; text-align: center;">Trip Type</th>
                        <th style="border: 2px solid #e5e5e5; text-align: center;">Country</th>
                        <th style="border: 2px solid #e5e5e5; text-align: center;">Passport Id</th>
                        <th style="border: 2px solid #e5e5e5; text-align: center;">Expiry Date</th>
                    </thead>
                    <tbody>
                        @foreach ($single_booking as $key=> $row)
                            <tr style="border: 2px solid #e5e5e5; text-align: center;">
                                <td style="border: 2px solid #e5e5e5; text-align: center;"> {{$key+1}}</td>
                                <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->title}}</td>
                                <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->full_name}}</td>
                                <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->gender}}</td>
                                <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->dob}}</td>
                                <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->trip_type}}</td>
                                <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->country}}</td>
                                <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->passport_id}}</td>
                                <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->expiry_date}}</td>
                            </tr>
                        @endforeach

                        @if(!empty($trip2_booking_id))
                            <tr  style="border: 2px solid #e5e5e5;">
                                <td style="text-align: center">Round 2</td>
                            </tr>
                            @foreach ($trip2_booking_id as $key=> $row)
                                <tr style="border: 2px solid #e5e5e5; text-align: center;">
                                    <td style="border: 2px solid #e5e5e5; text-align: center;"> {{$key+1}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->title}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->full_name}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->gender}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->dob}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->trip_type}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->country}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->passport_id}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->expiry_date}}</td>
                                </tr>
                            @endforeach
                      @endif

                        @if(!empty($trip3_booking_id))
                            <tr  style="border: 2px solid #e5e5e5;">
                                <td style="text-align: center">Round 3</td>
                            </tr>
                            @foreach ($trip3_booking_id as $key=> $row)
                                <tr style="border: 2px solid #e5e5e5; text-align: center;">
                                    <td style="border: 2px solid #e5e5e5; text-align: center;"> {{$key+1}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->title}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->full_name}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->gender}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->dob}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->trip_type}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->country}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->passport_id}}</td>
                                    <td style="border: 2px solid #e5e5e5; text-align: center;">{{$row->expiry_date}}</td>
                                </tr>
                            @endforeach
                      @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h5 style="text-decoration: underline; margin-bottom:5px; font-size:18px"> Billing address </h5>
            <p style="margin:2px">{{$single_booking[0]->c_name}}</p>
            <p style="margin:2px"> {{$single_booking[0]->c_mobile}}</p>
            <p style="margin:2px"> {{$single_booking[0]->c_email}} </p>
        </div>
        <div>
            <h5 style="text-decoration: underline; margin-bottom:5px; font-size:18px"> Contact Details </h5>
            <p style="margin:2px">{{'andamanferrybookings@gmail.com'}}</p>
            <p style="margin:2px"> {{'9933752444'}}</p>
        </div>
        <div style="text-align: center">
            <h5>Thanks for using www.andamanferrybookings.com</h5>
        </div>
    </div>
  
</body>
</html>
