<script type="text/javascript">
    function printTicket() {
        window.print();
    }
</script>


<style>
    body {
        margin: 0px;
        padding: 0px;
    }

    .main-container {
        width: 950px;
        margin: 0px auto;
        border: #000000 1px solid;
        font-family: Arial, Helvetica, sans-serif;
        line-height: 20px;
        overflow: auto;
        page-break-after: always;
        font-size: 12px;
    }

    table tr td {
        font-size: 12px;
    }

    .ti-header {
        font-size: 16px;
    }

    .print-controls {
        text-align: center;
        width: 900px;
        padding: 15px;
        margin: 15px auto;
        border-top: 1px dotted #cccccc;
    }

    .main_caption {
        text-align: center;
        width: 600px;
        margin: 20px auto;
    }

    .main_caption h3 {
        color: navy;
        font-weight: 800;
        font-size: 14px;
        margin: 0;
    }

    .main-container small {
        color: navy;
        font-weight: 800;
        font-size: 11px;
    }

    .main_logo {
        width: 200px;
        float: left;
    }

    .upper_header {
        overflow: hidden;
    }
</style>


<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Andaman Ferry Booking</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.ico">
    <style>
        table tr td {
            border: none;
        }
        .main-container {
            border: none;
        }

        .ticket-main-form {
            border-top: 1px solid #000;
        }

        .ticket-photo-box {
            width: auto;
            height: auto;
            border: none;
            border-left: 1px solid #999;
        }

        .ticket-detail-box>table {
            border: none;
        }

        .ticket-header {
            position: relative;
        }

        .agent-details {
            /* width: 150px;
            height: auto; */
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
        }

        .agent-details .agent-logo {
            width: 150px;
            height: auto;
        }

        .agent-details .row {
            display: flex;
            flex-wrap: wrap;
        }

        .agent-details .img-container {
            flex: 0 0 auto;
            width: 25%;
            border-right: 1px dashed #18489a;
        }

        .agent-details .agent-info {
            flex: 0 0 auto;
            width: 40%;
            align-content: end;
        }

        .agent-details .agent-info h3,
        .agent-details .agent-info p {
            margin: 0;
            margin-left: 25px;
            text-align: left;
        }

        .agent-details .agent-info h3 {
            color: #18489a;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .title {
            border: none;
            border-top: 1px solid #000;
        }

        .title td {
            font-size: 14px;
            font-weight: 700;
        }

        .tc-main-box .tc-heading-main {}

        .tc-main-box .tc-content-main-box td {
            font-size: 11px;
        }

        .hightlight-text {
            font-size: 14px;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KT78RBJ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <center>
        <div style="margin-top: 20px; margin-buttom: 20px;">
            <button type="button" style="margin-bottom: 25px;" onclick="printDiv('ticket')">Print</button>
        </div>
    </center>

    <div id="ticket">
        <div class="main-container" id="ticket">
            <div class="ticket-header" align="center">
                <img src="{{ url('assets/images/logo.png') }}" alt="ticket-header" style="width:30%;">
                <br>
                


                <p><b>1st floor, Premnagar Muthoot Finance Building, Port Blair<br>Andaman and Nicobar Island, PIN - 744102</b></p>
                <p><b>andamanferrybookings@gmail.com<br>+91 9679061419 / 9933281206</b></p>
            </div>

            <div class="ticket-main-form" style="display: inline-block; width: 100%;">
                <div class="ticket-detail-box" style="float: left; width: 70%; padding-top:10px;">
                    <table width="100%" border="2" cellspacing="0" cellpadding="5">
                        <tr>
                            <td width="30%">Book For :</td>
                            <td style="font-weight:700; font-size:16px">{{ ucfirst($single_booking->type) }} </td>
                        </tr>

                        <tr>
                            <td>Mode of Payment :</td>
                            <td>
                                Online
                            </td>
                        </tr>
                        <tr>
                            <td>Payment receipt No: </td>
                            <td class="hightlight-text">{{ $single_booking->order_id ?? $single_booking->order_id }}
                            </td>
                        </tr>
                        <tr>
                            <td>Payment receipt Date: </td>
                            <td>{{ date('d-m-Y', strtotime($single_booking->created_at)) }}</td>
                        </tr>
                        @if($single_booking->type == 'boat')
                            <tr>
                                <td>Date Of Travel : </td>
                                <td class="hightlight-text">{{ date('d-m-Y', strtotime($single_booking->date_of_jurney)) }}</td>
                            </tr>
                        @endif
                    </table>
                </div>

                @if($single_booking->type == 'boat')
                <div style="width: 28%; float: right; text-align: right;" class="ticket-photo-box"><svg xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" baseProfile="full"
                    viewBox="-4 -4 29 29" width="120" height="120" id="LEGBLD">
                    <symbol id="tracker">
                        <path d="m 0 7 0 7 7 0 0 -7 -7 0 z m 1 1 5 0 0 5 -5 0 0 -5 z m 1 1 0 3 3 0 0 -3 -3 0 z"
                            style="fill:#000000;stroke:none"></path>
                    </symbol>
                    <use x="0" y="-7" xlink:href="#tracker"></use>
                    <use x="0" y="7" xlink:href="#tracker"></use>
                    <use x="14" y="-7" xlink:href="#tracker"></use>
                    <path
                        d="M9,0 h1v4h-1v-1h-1v-2h1v-1 M12,4 h1v4h-2v1h-2v-1h-1v-4h1v3h1v-1h1v1h1v-1h-1v-1h1v-1 M0,8 h2v1h1v1h1v3h-2v-1h1v-1h-2v1h-1v-2h1v-1h-1v-1 M14,8 h3v1h-2v1h-1v-2 M8,9 h1v2h-4v-2h1v1h2v-1 M5,12 h6v1h-2v2h-1v-2h-3v-1 M16,12 h2v1h-1v1h-1v1h1v2h-1v1h-1v-1h-1v-1h1v-3h1v-1 M13,14 h1v2h-2v2h-1v-2h-1v2h-2v-1h1v-2h1v-1h1v1h2v-1 M20,15 h1v5h-1v-2h-2v1h1v2h-3v-1h-3v-1h3v-1h1v-1h2v-1h1v-1 M8,19 h2v2h-2v-2 M12,2 v1h1v-1h-1 M11,3 v1h1v-1h-1 M3,8 v1h1v-1h-1 M20,9 v1h1v-1h-1 M11,11 v1h1v-1h-1 M12,12 v1h1v-1h-1 M14,12 v1h1v-1h-1 M11,13 v1h1v-1h-1 M17,14 v1h1v-1h-1 M18,15 v1h1v-1h-1 M12,18 v1h1v-1h-1 M6,8 h2v1h-2v-1 M18,8 h2v1h-2v-1 M12,10 h2v1h-2v-1 M19,13 h2v1h-2v-1 M11,20 h2v1h-2v-1 M11,0 h2v1h-1v1h-1z M17,10 h2v2h-1v-1h-1z"
                        style="fill:#000000;stroke:none"></path>
                </svg>
                </div> 
                <!-- <div class="ticket-photo-box"><img src=""  alt="QR Code"> </div> -->

                @endif
                
                @if ($single_booking->type == 'ferry')
                    <div class="detail-table-main-form">
                        <table class="title" width="100%" border="2" cellspacing="0" cellpadding="5">

                        </table>

                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                            <tr>
                                <td>From</td>
                                <td>To</td>
                                <td>Departure</td>
                                <td>Arrival</td>
                                <td>Vessel</td>
                                {{-- <td>Class</td> --}}
                                <td>Status</td>
                            </tr>
                            <tr>
                                <td class="hightlight-text">{{ $single_booking->from_location == 1 ? 'Port Blair' : ($single_booking->from_location == 2 ? 'Havlock' : 'Neil') }}</td>
                                <td class="hightlight-text">{{ $single_booking->to_location == 1 ? 'Port Blair' : ($single_booking->to_location == 2 ? 'Havlock' : 'Neil') }} </td>
                                <td>{{ $single_booking->departure_time }}</td>
                                <td>{{ $single_booking->arrival_time }}</td>
                                <td>{{ $single_booking->ship_name }}</td>
                                {{-- <td>
                                    @if($single_booking->ferry_class=='bClass')
                                    {{'Business'}}
                                    @elseif ($single_booking->ferry_class=='pClass')
                                        {{'Premium'}}
                                    @else
                                    {{ $single_booking->ferry_class }}
                                    @endif
                                </td> --}}
                                <td>OK</td>
                            </tr>
                        </table>
                    </div>
                @elseif($single_booking->type == 'boat')
                    <div class="detail-table-main-form">
                        <table class="title" width="100%" border="2" cellspacing="0" cellpadding="5">
                            <tr>
                                <td style="width: 20%">Boat Name :</td>
                                <td style="text-align: left">{{ $single_booking->ship_name }}</td>
                            </tr>
                        
                        </table>
                    </div>
                    

                     <div class="detail-table-main-form">
                    <table class="title" width="100%" border="2" cellspacing="0" cellpadding="5">
                        <tr>
                            <td>Guest Details :</td>
                        </tr>
                    </table>
                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                        <tr>
                            <td>No</td>
                            <td>Title</td>
                            <td>Name</td>
                            <td>Nationality</td>
                            <td>Country</td>
                            <td>RAP/Passport No.</td>
                            <td>Age</td>
                            <td>Gender</td>
                            <td>Status</td>
                        </tr>

                        @php
                        $number = 1;
                    @endphp
                    @foreach ($bookingPassengerDetails as $bookingId => $passengers)
                        @foreach ($passengers as $bookingPassengerDetail)
                        @php
                        // print_r($bookingPassengerDetail);
                        // die();

                        $fullName = $bookingPassengerDetail->full_name ;
                        @endphp
                            <tr style="font-weight: 700">
                                <td>{{ $number }}</td>
                                <td>{{ $bookingPassengerDetail->title }}</td>
                                <td>{{ $fullName }}</td>
                                <td>{{ ucfirst($bookingPassengerDetail->resident) }}</td>
                                <td>{{ ucfirst($bookingPassengerDetail->country ?? "INDIA") }}</td>
                                <td> {{$bookingPassengerDetail->passport_id ?? 'N/A'}}</td>
                                <td>{{$bookingPassengerDetail->dob}}</td>
                                <td>{{ ucfirst($bookingPassengerDetail->gender) }}</td>
                                <td>OK</td>
                            </tr>
                            @php
                                $number++;
                            @endphp
                        @endforeach
                    @endforeach

                    </table>
                </div> 
                @endif

            </div>

            <div class="tc-main-container pt-2">
                <div class="price-detail-main-box">
                    <div class="price-detail-heading" style="padding:5px;font-size: 14px; font-weight:700;">Price
                        Details:</div>

                    @if ($single_booking->type == 'ferry')
                        <div class="price-detail-table-box" style="display:inline-block; width:100%;">
                            <table width="100%;" border="0" cellspacing="0" cellpadding="0"
                                style="background: #008cbd1c; padding: 10px; float:left; border: 1px solid #5fb6d9; border-radius: 7px;">

                                @php
                                    $psf = $single_booking->psf ?? 50;
                                    $psfAmount = $single_booking->no_of_passenger * $psf;

                                    $basic_price = $single_booking->amount - $psfAmount;
                                @endphp
                                <tr>
                                    <td style="padding:5px;">Basic Fare : </td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">
                                        {{ number_format($basic_price, 2, '.', '') }}</td>
                                </tr>

                                <tr>
                                    <td style="padding:5px;">UTGST @ 0% :</td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;"> 0.00
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:5px;">CGST @ 0% :</td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">0.00</td>
                                </tr>

                                @php
                                    $psf = $single_booking->psf ?? 50;
                                    $psfAmount = $single_booking->no_of_passenger * $psf;
                                @endphp

                                <tr>
                                    <td style="padding:5px;"><strong>PSF :</strong> &nbsp;</td>
                                    <td align="right"style="padding:5px; font-weight: 600; font-size:12px;">
                                        {{ $psfAmount }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:5px;"><strong>Total :</strong> &nbsp;</td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">
                                        {{ number_format($single_booking->amount, 2, '.', '') }} </td>
                                </tr>

                            </table>
                            <!-- <div class="price-detail-table-box"> -->
                            {{-- <table width="49%;" border="0" cellspacing="0" cellpadding="5" style=" float:right;">
                                <tr>
                                    <td>Mode of Pament :</td>
                                    <td style="font-weight: 600;">Online</td>
                                </tr>
                                <tr>
                                    <td >Remarks:&nbsp;NULL</td>
                                </tr>
                            </table> --}}
                            <!-- </div> -->
                        </div>
                    @elseif($single_booking->type == 'boat')
                    
                        <div class="price-detail-table-box" style="display:inline-block; width:100%;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                style="background: #008cbd1c; padding: 10px; float:left; border: 1px solid #5fb6d9; border-radius: 7px;">
                                <tr>
                                    <td style="padding:5px;">Basic Fare : </td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">
                                        {{ number_format($single_booking->amount, 2, '.', '') }}</td>
                                </tr>

                                <tr>
                                    <td style="padding:5px;">UTGST @ 0% :</td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;"> 0.00
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:5px;">CGST @ 0% :</td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">0.00</td>
                                </tr>

                                <tr>
                                    <td style="padding:5px;"><strong>Total :</strong> &nbsp;</td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">
                                        {{ number_format($single_booking->amount, 2, '.', '') }} </td>
                                </tr>

                            </table>

                        </div>
                        <div class="tc-main-box" style="border-top: 5px solid #008cbd; padding-top: 10px;">
                            <div class="tc-heading-main">Terms & Conditions:</div>
                            <div class="tc-content-main-box">
                                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                    <tr>
                                        <td width="50%" valign="top">
                                            1. Correction of NAME is not permitted in ticket ONCE BOOKED. So please make
                                            sure
                                            for correct NAME.<br />

                                            2. Tickets are Non Transferable and Non Re-routable.<br />

                                            3. PSF (Passenger Service Fee) of Rs. 50/- per person per ticket is
                                            applicable for ferry booking.<br />

                                            4. Check-in counter closes-30 mins prior to departure.<br />
                                            5. Boarding closes 15 Mins prior to departure.<br />
                                            6. Passenger should carry a PHOTO IDENTITY CARD hard copy at the time of
                                            Check-In.<br />
                                            7. Reporting for Journey should be 2 hrs prior to departure.<br />
                                            8. Carriage of Security Removed Articles will not be permitted in hand
                                            baggage
                                            e.g.: Nail cutters, Knifes, explosives, Inflammable etc.<br />
                                        </td>
                                        <td width="50%" valign="top">

                                            9. LIQUOR & SMOKING IS NOT ALLOWED in the vessel by LAW.<br />
                                            10. Pets and Animals not allowed On Board the Ferry.<br />
                                            11. Passenger belongings carried in hand will be at their own risk carrier
                                            is no way
                                            liable in any loss or damage from what so ever it may cause.<br />
                                            12. The carrier reserves the right to cancel or change the published voyage
                                            for any
                                            official purpose and in any manner or to any extent. The carrier shall bear
                                            no
                                            liability for any loss that passenger may suffer, any consequences thereof
                                            or in
                                            respect of any changes in scheduled due to Bad weather or Technical reasons,
                                            in this
                                            case passenger can either claim full refund or can rescheduled His/her
                                            Journey on
                                            availability.<br />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endif

                    <br>
                    <br>
                </div>

            </div>
            {{-- <div class="watermark"
                style="position: absolute;z-index: 999;top: 70%;left: 50%;transform: translate(-50%, -50%);">
                <p style="font-size: 48px;color: #222;transform: rotate(-45deg);">This is a test example</p>
            </div> --}}
            {{-- <h5 style="margin: 0; text-align:center">
                "This is the provisional Payment Receipt ,asmitha tour and Travel will share the final confirmed ticket within
                2hrs"
            </h5> --}}

        </div>
    </div>


    @if (isset($trip2_booking_id))

        <hr>
        <h4 style="color: #18489a; font-size:18px; text-align:center; background:#c6e5f1; margin-bottom:5px">Round 2
            </h4>
        <center>
            <div style="margin-top:5px; margin-bottom: 20px;">
                <button type="button" style="margin-bottom: 25px; " onclick="printDiv('ticket_return')">Print
                    </button>
            </div>
        </center>
        <div id="ticket_return">
            <div class="main-container" id="ticket">
               
                <div class="ticket-header">
                    <img src="images/receipt_ferry.jpg" alt="ticket-header" style="width:100%;">
                </div>

                <div class="ticket-main-form" style="display: inline-block; width: 100%;">
                    <div class="ticket-detail-box" style="float: left; width: 70%; padding-top:10px;">
                        <table width="100%" border="2" cellspacing="0" cellpadding="5">
                            <tr>
                                <td width="30%">Book For :</td>
                                <td style="font-weight:700; font-size:16px">{{ ucfirst($trip2_booking_id->type) }} </td>

                            </tr>
                            {{-- <tr>
                                <td width="30%">Location :</td>
                                <td>
                                    Office </td>
                            </tr> --}}
                            <tr>
                                <td>Payment Mode :</td>
                                <td>
                                    Online </td>
                            </tr>

                            <tr>
                                <td>Payment receipt No: </td>
                                <td class="hightlight-text">{{ $trip2_booking_id->order_id ?? $trip2_booking_id->order_id }}
                                </td>
                            </tr>
                            <tr>
                                <td>Payment Receipt Date : </td>
                                <td>{{ date('d-m-Y', strtotime($trip2_booking_id->updated_at)) }}</td>

                            </tr>
                            {{-- <tr>
                                <td>Date Of Travel : </td>
                                <td class="hightlight-text">{{ date('d-m-Y', strtotime($return_booking->return_date)) }}</td>
                            </tr> --}}
                        </table>

                    </div>
                    {{-- <div style="width: 28%; float: right; text-align: right;" class="ticket-photo-box"><svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" baseProfile="full"
                        viewBox="-4 -4 29 29" width="120" height="120" id="LEGBLD">
                        <symbol id="tracker">
                            <path d="m 0 7 0 7 7 0 0 -7 -7 0 z m 1 1 5 0 0 5 -5 0 0 -5 z m 1 1 0 3 3 0 0 -3 -3 0 z"
                                style="fill:#000000;stroke:none"></path>
                        </symbol>
                        <use x="0" y="-7" xlink:href="#tracker"></use>
                        <use x="0" y="7" xlink:href="#tracker"></use>
                        <use x="14" y="-7" xlink:href="#tracker"></use>
                        <path
                            d="M9,0 h1v4h-1v-1h-1v-2h1v-1 M12,4 h1v4h-2v1h-2v-1h-1v-4h1v3h1v-1h1v1h1v-1h-1v-1h1v-1 M0,8 h2v1h1v1h1v3h-2v-1h1v-1h-2v1h-1v-2h1v-1h-1v-1 M14,8 h3v1h-2v1h-1v-2 M8,9 h1v2h-4v-2h1v1h2v-1 M5,12 h6v1h-2v2h-1v-2h-3v-1 M16,12 h2v1h-1v1h-1v1h1v2h-1v1h-1v-1h-1v-1h1v-3h1v-1 M13,14 h1v2h-2v2h-1v-2h-1v2h-2v-1h1v-2h1v-1h1v1h2v-1 M20,15 h1v5h-1v-2h-2v1h1v2h-3v-1h-3v-1h3v-1h1v-1h2v-1h1v-1 M8,19 h2v2h-2v-2 M12,2 v1h1v-1h-1 M11,3 v1h1v-1h-1 M3,8 v1h1v-1h-1 M20,9 v1h1v-1h-1 M11,11 v1h1v-1h-1 M12,12 v1h1v-1h-1 M14,12 v1h1v-1h-1 M11,13 v1h1v-1h-1 M17,14 v1h1v-1h-1 M18,15 v1h1v-1h-1 M12,18 v1h1v-1h-1 M6,8 h2v1h-2v-1 M18,8 h2v1h-2v-1 M12,10 h2v1h-2v-1 M19,13 h2v1h-2v-1 M11,20 h2v1h-2v-1 M11,0 h2v1h-1v1h-1z M17,10 h2v2h-1v-1h-1z"
                            style="fill:#000000;stroke:none"></path>
                    </svg></div> --}}
                    <!-- <div class="ticket-photo-box"><img src=""  alt="QR Code"> </div> -->
                    
                    <div class="detail-table-main-form">
                        <table class="title" width="100%" border="2" cellspacing="0" cellpadding="5">
                         
                        </table>

                        <table width="100%;" border="0" align="center" cellpadding="5" cellspacing="0">
                            <tr>
                                <td>From</td>
                                <td>To</td>
                                <td>Departure</td>
                                <td>Arrival</td>
                                <td>Vessel</td>
                                {{-- <td>Class</td> --}}
                                <td>Status</td>
                            </tr>
                            <tr>
                                <td class="hightlight-text">{{ $trip2_booking_id->from_location == 1 ? 'Port Blair' : ($trip2_booking_id->from_location == 2 ? 'Havlock' : 'Neil') }}</td>
                                <td class="hightlight-text">{{ $trip2_booking_id->to_location == 1 ? 'Port Blair' : ($trip2_booking_id->to_location == 2 ? 'Havlock' : 'Neil') }} </td>
                                
                                <td>{{ $trip2_booking_id->departure_time }}</td>
                                <td>{{ $trip2_booking_id->arrival_time }}</td>
                                <td>{{ $trip2_booking_id->ship_name }}</td>
                                {{-- <td>
                                    @if($trip2_booking_id->ferry_class=='bClass')
                                    {{'Business'}}
                                    @elseif ($trip2_booking_id->ferry_class=='pClass')
                                        {{'Premium'}}
                                    @else
                                    {{ $trip2_booking_id->ferry_class }}
                                    @endif
                                </td> --}}
                                <td>OK</td>
                            </tr>
                        </table>
                    </div>

                    {{-- <div class="detail-table-main-form">
                        <table class="title" width="100%" border="2" cellspacing="0" cellpadding="5">
                            <tr>
                                <td>Guest Details :</td>
                            </tr>
                        </table>
                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                            <tr>
                                <td>No</td>
                                <td>Name</td>
                                <td>Nationality</td>
                                <td>RAP/Passport No.</td>
                                <td>Age</td>
                                <td>Gender</td>
                                <td>Status</td>
                            </tr>

                            @php
                            $number = 1;
                        @endphp
                        @foreach ($bookingPassengerDetails as $bookingId => $passengers)
                            @foreach ($passengers as $bookingPassengerDetail)
                            @php
                            // print_r($bookingPassengerDetail);
                            // die();

                            $fullName = $bookingPassengerDetail->full_name ;
                            @endphp
                                <tr style="font-weight: 700">
                                    <td>{{ $number }}</td>
                                    <td>{{ $fullName }}</td>
                                    <td>{{ ucfirst($bookingPassengerDetail->resident) }}</td>
                                    <td> {{$bookingPassengerDetail->passport_id ?? 'N/A'}}</td>
                                    <td>{{$bookingPassengerDetail->dob}}</td>
                                    <td>{{ ucfirst($bookingPassengerDetail->gender) }}</td>
                                    <td>OK</td>
                                </tr>

                                @php
                                    $number++;
                                @endphp
                            @endforeach
                        @endforeach

                        </table>
                    </div> --}}

                </div>

                <div class="tc-main-container">
                    <div class="price-detail-main-box">
                        <div class="price-detail-heading" style="padding:5px;font-size: 14px; font-weight:700;">Price
                            Details:</div>
                        <div class="price-detail-table-box" style="display:inline-block; width:100%;">
                            <table width="100%;" border="0" cellspacing="0" cellpadding="0"
                                style="background: #008cbd1c; padding: 10px; float:left; border: 1px solid #5fb6d9; border-radius: 7px;">

                                @php
                                    $psf = $trip2_booking_id->psf ?? 50;
                                    $psfAmount = $trip2_booking_id->no_of_passenger * $psf;

                                    $basic_price = $trip2_booking_id->amount - $psfAmount;
                                @endphp

                                <tr>
                                    <td style="padding:5px;">Basic Fare : </td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">
                                        {{ number_format($basic_price, 2, '.', '') }}</td>
                                </tr>

                                <tr>
                                    <td style="padding:5px;">UTGST @ 0% :</td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;"> 0.00
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:5px;">CGST @ 0% :</td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">0.00
                                    </td>
                                </tr>

                                @php
                                    $psf = $trip2_booking_id->psf ?? 50;
                                    $psfAmount = $trip2_booking_id->no_of_passenger * $psf;
                                @endphp

                                <tr>
                                    <td style="padding:5px;"><strong>PSF :</strong> &nbsp;</td>
                                    <td align="right"style="padding:5px; font-weight: 600; font-size:12px;">
                                        {{ $psfAmount }}
                                    </td>
                                </tr>

                                {{-- @php
                                $total = $return_booking->no_of_passenger * $return_booking->amount + $psfAmount ;
                                @endphp --}}
                                <tr>
                                    <td style="padding:5px;"><strong>Total :</strong> &nbsp;</td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">
                                        {{ number_format($trip2_booking_id->amount, 2, '.', '') }} </td>
                                </tr>

                                {{-- <tr>
                                    <td style="padding:5px;"><strong>Refreshment Charge :</strong></td>
                                    <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">0.00</td>
                                </tr> --}}
                            </table>
                            <!-- <div class="price-detail-table-box"> -->
                            {{-- <table width="49%;" border="0" cellspacing="0" cellpadding="5" style=" float:right;">
                                    
                                    <tr>
                                        <td>Mode of Pament :</td>
                                        <td style="font-weight: 600;">Online</td>
                                    </tr>
                                    <tr>
                                        <td >Remarks:&nbsp;NULL</td>
                                    </tr>
                                </table>  --}}
                            <!-- </div> -->
                        </div>

                        <!-- <div class="price-detail-heading" style="padding:5px;">Remarks:&nbsp;Test</div> -->
                        <br>
                        <br>
                    </div>
                    {{-- <div class="tc-main-box" style="border-top: 5px solid #008cbd; padding-top: 10px;">
                    
                        <div class="tc-heading-main">Terms & Conditions:</div>
                        <div class="tc-content-main-box">
                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td width="50%" valign="top">
                                        1. Correction of NAME is not permitted in ticket ONCE BOOKED. So please make sure
                                        for correct NAME.<br />
                                        
                                        2. Tickets are Non Transferable and Non Re-routable.<br />
                                        
                                        3. PSF (Passenger Service Fee) of Rs. 50/- per person per ticket is
                                        applicable for ferry booking.<br />
                                        
                                        4. Check-in counter closes-30 mins prior to departure.<br />
                                        5. Boarding closes 15 Mins prior to departure.<br />
                                        6. Passenger should carry a PHOTO IDENTITY CARD hard copy at the time of
                                        Check-In.<br />
                                        7. Reporting for Journey should be 2 hrs prior to departure.<br />
                                        8. Carriage of Security Removed Articles will not be permitted in hand baggage
                                        e.g.: Nail cutters, Knifes, explosives, Inflammable etc.<br />
                                    </td>
                                    <td width="50%" valign="top">

                                        9. LIQUOR & SMOKING IS NOT ALLOWED in the vessel by LAW.<br />
                                        10. Pets and Animals not allowed On Board the Ferry.<br />
                                        11. Passenger belongings carried in hand will be at their own risk carrier is no way
                                        liable in any loss or damage from what so ever it may cause.<br />
                                        12. The carrier reserves the right to cancel or change the published voyage for any
                                        official purpose and in any manner or to any extent. The carrier shall bear no
                                        liability for any loss that passenger may suffer, any consequences thereof or in
                                        respect of any changes in scheduled due to Bad weather or Technical reasons, in this
                                        case passenger can either claim full refund or can rescheduled His/her Journey on
                                        availability.<br />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> --}}
                </div>
                {{-- <div class="watermark"
                    style="position: absolute;z-index: 999;left: 50%;transform: translate(-50%, -50%);">
                    <p style="font-size: 48px;color: #222;transform: rotate(-45deg);">This is a test example</p>
                </div> --}}
                <h5 style="margin: 0; text-align:center">
                    "This is the provisional Receipt ,asmitha tour and Travel will share the final confirmed ticket within
                    2hrs"
                </h5>

            </div>
        </div>
    @endif


    {{-- **************trip3 ticket --}}
    @if (isset($trip3_booking_id))

    <hr>
    <h4 style="color: #18489a; font-size:18px; text-align:center; background:#c6e5f1; margin-bottom:5px">Return
        </h4>
    <center>
        <div style="margin-top:5px; margin-bottom: 20px;">
            <button type="button" style="margin-bottom: 25px; " onclick="printDiv('ticket_return')">Print
                </button>
        </div>
    </center>
    <div id="ticket_return">
        <div class="main-container" id="ticket">
           
            <div class="ticket-header">
                <img src="images/receipt_ferry.jpg" alt="ticket-header" style="width:100%;">
            </div>

            <div class="ticket-main-form" style="display: inline-block; width: 100%;">
                <div class="ticket-detail-box" style="float: left; width: 70%; padding-top:10px;">
                    <table width="100%" border="2" cellspacing="0" cellpadding="5">
                        <tr>
                            <td width="30%">Book For :</td>
                            <td style="font-weight:700; font-size:16px">{{ ucfirst($trip3_booking_id->type) }} </td>

                        </tr>
                        {{-- <tr>
                            <td width="30%">Location :</td>
                            <td>
                                Office </td>
                        </tr> --}}
                        <tr>
                            <td>Payment Mode :</td>
                            <td>
                                Online </td>
                        </tr>
                        <tr>
                            <td>Payment receipt No: </td> : 
                            <td class="hightlight-text">
                                {{ $trip3_booking_id->order_id ?? $trip3_booking_id->order_id }}</td>
                        </tr>
                        
                        <tr>
                            <td>Payment Receipt Date : </td>
                            <td>{{ date('d-m-Y', strtotime($trip3_booking_id->updated_at)) }}</td>

                        </tr>
                        {{-- <tr>
                            <td>Date Of Travel : </td>
                            <td class="hightlight-text">{{ date('d-m-Y', strtotime($return_booking->return_date)) }}</td>
                        </tr> --}}
                    </table>

                </div>
                {{-- <div style="width: 28%; float: right; text-align: right;" class="ticket-photo-box"><svg xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" baseProfile="full"
                    viewBox="-4 -4 29 29" width="120" height="120" id="LEGBLD">
                    <symbol id="tracker">
                        <path d="m 0 7 0 7 7 0 0 -7 -7 0 z m 1 1 5 0 0 5 -5 0 0 -5 z m 1 1 0 3 3 0 0 -3 -3 0 z"
                            style="fill:#000000;stroke:none"></path>
                    </symbol>
                    <use x="0" y="-7" xlink:href="#tracker"></use>
                    <use x="0" y="7" xlink:href="#tracker"></use>
                    <use x="14" y="-7" xlink:href="#tracker"></use>
                    <path
                        d="M9,0 h1v4h-1v-1h-1v-2h1v-1 M12,4 h1v4h-2v1h-2v-1h-1v-4h1v3h1v-1h1v1h1v-1h-1v-1h1v-1 M0,8 h2v1h1v1h1v3h-2v-1h1v-1h-2v1h-1v-2h1v-1h-1v-1 M14,8 h3v1h-2v1h-1v-2 M8,9 h1v2h-4v-2h1v1h2v-1 M5,12 h6v1h-2v2h-1v-2h-3v-1 M16,12 h2v1h-1v1h-1v1h1v2h-1v1h-1v-1h-1v-1h1v-3h1v-1 M13,14 h1v2h-2v2h-1v-2h-1v2h-2v-1h1v-2h1v-1h1v1h2v-1 M20,15 h1v5h-1v-2h-2v1h1v2h-3v-1h-3v-1h3v-1h1v-1h2v-1h1v-1 M8,19 h2v2h-2v-2 M12,2 v1h1v-1h-1 M11,3 v1h1v-1h-1 M3,8 v1h1v-1h-1 M20,9 v1h1v-1h-1 M11,11 v1h1v-1h-1 M12,12 v1h1v-1h-1 M14,12 v1h1v-1h-1 M11,13 v1h1v-1h-1 M17,14 v1h1v-1h-1 M18,15 v1h1v-1h-1 M12,18 v1h1v-1h-1 M6,8 h2v1h-2v-1 M18,8 h2v1h-2v-1 M12,10 h2v1h-2v-1 M19,13 h2v1h-2v-1 M11,20 h2v1h-2v-1 M11,0 h2v1h-1v1h-1z M17,10 h2v2h-1v-1h-1z"
                        style="fill:#000000;stroke:none"></path>
                </svg></div> --}}
                <!-- <div class="ticket-photo-box"><img src=""  alt="QR Code"> </div> -->
                
                <div class="detail-table-main-form">
                    <table class="title" width="100%" border="2" cellspacing="0" cellpadding="5">
                     
                    </table>

                    <table width="100%;" border="0" align="center" cellpadding="5" cellspacing="0">
                        <tr>
                            <td>From</td>
                            <td>To</td>
                            <td>Departure</td>
                            <td>Arrival</td>
                            <td>Vessel</td>
                            {{-- <td>Class</td> --}}
                            <td>Status</td>
                        </tr>
                        <tr>
                            <td class="hightlight-text">{{ $trip3_booking_id->from_location == 1 ? 'Port Blair' : ($trip3_booking_id->from_location == 2 ? 'Havlock' : 'Neil') }}</td>
                            <td class="hightlight-text">{{ $trip3_booking_id->to_location == 1 ? 'Port Blair' : ($trip3_booking_id->to_location == 2 ? 'Havlock' : 'Neil') }} </td>
                                
                            <td>{{ $trip3_booking_id->departure_time }}</td>
                            <td>{{ $trip3_booking_id->arrival_time }}</td>
                            <td>{{ $trip3_booking_id->ship_name }}</td>
                            {{-- <td>
                                @if($trip3_booking_id->ferry_class=='bClass')
                                    {{'Business'}}
                                @elseif ($trip3_booking_id->ferry_class=='pClass')
                                    {{'Premium'}}
                                @else
                                    {{ $trip3_booking_id->ferry_class }}
                                @endif
                            </td> --}}
                            <td>OK</td>
                        </tr>
                    </table>
                </div>

                {{-- <div class="detail-table-main-form">
                    <table class="title" width="100%" border="2" cellspacing="0" cellpadding="5">
                        <tr>
                            <td>Guest Details :</td>
                        </tr>
                    </table>
                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                        <tr>
                            <td>No</td>
                            <td>Name</td>
                            <td>Nationality</td>
                            <td>RAP/Passport No.</td>
                            <td>Age</td>
                            <td>Gender</td>
                            <td>Status</td>
                        </tr>

                        @php
                        $number = 1;
                    @endphp
                    @foreach ($bookingPassengerDetails as $bookingId => $passengers)
                        @foreach ($passengers as $bookingPassengerDetail)
                        @php
                        // print_r($bookingPassengerDetail);
                        // die();

                        $fullName = $bookingPassengerDetail->full_name ;
                        @endphp
                            <tr style="font-weight: 700">
                                <td>{{ $number }}</td>
                                <td>{{ $fullName }}</td>
                                <td>{{ ucfirst($bookingPassengerDetail->resident) }}</td>
                                <td> {{$bookingPassengerDetail->passport_id ?? 'N/A'}}</td>
                                <td>{{$bookingPassengerDetail->dob}}</td>
                                <td>{{ ucfirst($bookingPassengerDetail->gender) }}</td>
                                <td>OK</td>
                            </tr>

                            @php
                                $number++;
                            @endphp
                        @endforeach
                    @endforeach

                    </table>
                </div> --}}

            </div>

            <div class="tc-main-container">
                <div class="price-detail-main-box">
                    <div class="price-detail-heading" style="padding:5px;font-size: 14px; font-weight:700;">Price
                        Details:</div>
                    <div class="price-detail-table-box" style="display:inline-block; width:100%;">
                        <table width="100%;" border="0" cellspacing="0" cellpadding="0"
                            style="background: #008cbd1c; padding: 10px; float:left; border: 1px solid #5fb6d9; border-radius: 7px;">

                            @php
                                $psf = $trip3_booking_id->psf ?? 50;
                                $psfAmount = $trip3_booking_id->no_of_passenger * $psf;

                                $basic_price = $trip3_booking_id->amount - $psfAmount;
                            @endphp

                            <tr>
                                <td style="padding:5px;">Basic Fare : </td>
                                <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">
                                    {{ number_format($basic_price, 2, '.', '') }}</td>
                            </tr>

                            <tr>
                                <td style="padding:5px;">UTGST @ 0% :</td>
                                <td align="right" style="padding:5px; font-weight: 600; font-size:12px;"> 0.00
                                </td>
                            </tr>

                            <tr>
                                <td style="padding:5px;">CGST @ 0% :</td>
                                <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">0.00
                                </td>
                            </tr>

                            @php
                                $psf = $trip3_booking_id->psf ?? 50;
                                $psfAmount = $trip3_booking_id->no_of_passenger * $psf;
                            @endphp

                            <tr>
                                <td style="padding:5px;"><strong>PSF :</strong> &nbsp;</td>
                                <td align="right"style="padding:5px; font-weight: 600; font-size:12px;">
                                    {{ $psfAmount }}
                                </td>
                            </tr>

                            {{-- @php
                            $total = $return_booking->no_of_passenger * $return_booking->amount + $psfAmount ;
                            @endphp --}}
                            <tr>
                                <td style="padding:5px;"><strong>Total :</strong> &nbsp;</td>
                                <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">
                                    {{ number_format($trip3_booking_id->amount, 2, '.', '') }} </td>
                            </tr>

                            {{-- <tr>
                                <td style="padding:5px;"><strong>Refreshment Charge :</strong></td>
                                <td align="right" style="padding:5px; font-weight: 600; font-size:12px;">0.00</td>
                            </tr> --}}
                        </table>
                        <!-- <div class="price-detail-table-box"> -->
                        {{-- <table width="49%;" border="0" cellspacing="0" cellpadding="5" style=" float:right;">
                                
                                <tr>
                                    <td>Mode of Pament :</td>
                                    <td style="font-weight: 600;">Online</td>
                                </tr>
                                <tr>
                                    <td >Remarks:&nbsp;NULL</td>
                                </tr>
                            </table>  --}}
                        <!-- </div> -->
                    </div>

                    <!-- <div class="price-detail-heading" style="padding:5px;">Remarks:&nbsp;Test</div> -->
                    <br>
                    <br>
                </div>
                {{-- <div class="tc-main-box" style="border-top: 5px solid #008cbd; padding-top: 10px;">
                
                    <div class="tc-heading-main">Terms & Conditions:</div>
                    <div class="tc-content-main-box">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td width="50%" valign="top">
                                    1. Correction of NAME is not permitted in ticket ONCE BOOKED. So please make sure
                                    for correct NAME.<br />
                                    
                                    2. Tickets are Non Transferable and Non Re-routable.<br />
                                    
                                    3. PSF (Passenger Service Fee) of Rs. 50/- per person per ticket is
                                    applicable for ferry booking.<br />
                                    
                                    4. Check-in counter closes-30 mins prior to departure.<br />
                                    5. Boarding closes 15 Mins prior to departure.<br />
                                    6. Passenger should carry a PHOTO IDENTITY CARD hard copy at the time of
                                    Check-In.<br />
                                    7. Reporting for Journey should be 2 hrs prior to departure.<br />
                                    8. Carriage of Security Removed Articles will not be permitted in hand baggage
                                    e.g.: Nail cutters, Knifes, explosives, Inflammable etc.<br />
                                </td>
                                <td width="50%" valign="top">

                                    9. LIQUOR & SMOKING IS NOT ALLOWED in the vessel by LAW.<br />
                                    10. Pets and Animals not allowed On Board the Ferry.<br />
                                    11. Passenger belongings carried in hand will be at their own risk carrier is no way
                                    liable in any loss or damage from what so ever it may cause.<br />
                                    12. The carrier reserves the right to cancel or change the published voyage for any
                                    official purpose and in any manner or to any extent. The carrier shall bear no
                                    liability for any loss that passenger may suffer, any consequences thereof or in
                                    respect of any changes in scheduled due to Bad weather or Technical reasons, in this
                                    case passenger can either claim full refund or can rescheduled His/her Journey on
                                    availability.<br />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div> --}}
            </div>
            {{-- <div class="watermark"
                style="position: absolute;z-index: 999;left: 50%;transform: translate(-50%, -50%);">
                <p style="font-size: 48px;color: #222;transform: rotate(-45deg);">This is a test example</p>
            </div> --}}
            <h5 style="margin: 0; text-align:center">
                "This is the provisional Receipt ,asmitha tour and Travel will share the final confirmed ticket within
                2hrs"
            </h5>

        </div>
    </div>
@endif


</body>

<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>


</html>
