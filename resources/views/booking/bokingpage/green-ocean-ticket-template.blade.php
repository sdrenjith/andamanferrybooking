<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Ocean Ticket</title>

    <style>
        .font-14 {
            font-size: 12px;
        }
        .font-12 {
            font-size: 11px;
        }

        .logo {
            width: 120px;
            height: auto;
        }
        .confirm-txt-imd {
            width: 120px;
            height: auto;
        }
    </style>
</head>
<body>
        <div>
        <table style="width:80%; text-align: start; white-space: nowrap;">
            <tr>
                <td colp="2" style="width: 70%;"><img style="logo" src="http://uat.bookmyferry.in/assets/images/Capture.PNG" alt=""></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style="width: 30%;">
                    <img class="confirm-txt-imd" src="http://uat.bookmyferry.in/assets/images/Capture2.PNG" alt="">
                    <div>
                        <p class="font-14"><b>Booking Date: {{ date("d M Y IST: H:i", strtotime($ticket_data->ticked_created)) }}</b></p>
                        <p class="font-14"><b>Booked at : {{ $ticket_data->location }}</b></p>
                        <p class="font-14">Booked By: {{ $ticket_data->issued_by }}</p>
                    </div>
                </td>
            </tr>
        </table>

        <table style="width:80%; text-align: start; white-space: nowrap;">
            <tr>
                <td>
                    <p class="font-14">Your Green Ocean Ferry ticket for <b>{{ $ticket_data->from .' - '. $ticket_data->destination }}</b> is confirmed
                        Your booking ID / PNR - <b>{{ $ticket_data->pnr_number }}</b></p>
                </td>
            </tr>
        </table>

        <table style="width: 100%;white-space: nowrap;">
            <tr>
                <td>
                    <h3 class="font-14" style="margin-bottom:0px; ">{{ $ticket_data->ship_name }}</h3>
                    <p class="font-14"><b>Class: {{ $ticket_data->class }}</b></p>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    <span class="font-14"><b>{{ $ticket_data->from .' '. date("h:i A", strtotime($ticket_data->departure)) }}</b></span>
                    <p class="font-14">{{ date("D-d M Y", strtotime($ticket_data->travel_date)) }}</p>
                    <p class="font-14">{{ $ticket_data->destination }}</p>
                </td>
                <td style="width: 33%;">
                    <img src="http://uat.bookmyferry.in/assets/images/arrow.PNG" alt="">
                    @php
                        $start  = new Carbon\Carbon("$ticket_data->travel_date $ticket_data->departure");
                        $end    = new Carbon\Carbon("$ticket_data->travel_date $ticket_data->arrival");
                    @endphp
                    <p class="font-14">{{ $start->diff($end)->format('%H  Hrs %I Minutes') }}</p>
                </td>
                <td>
                    <span class="font-14"><b>{{ $ticket_data->destination .' '. date("H:i", strtotime($ticket_data->arrival)) }}</b></span>
                    <p class="font-14">{{ date("D-d M Y", strtotime($ticket_data->travel_date)) }}</p>
                    <p class="font-14">{{ $ticket_data->destination }}</p>
                </td>
            </tr>
        </table>
        <table style="width: 100%; padding-top:0px; white-space: nowrap;">
            <tr>
                <th class="font-14" style="text-align: start; ">S.No.</th>
                <th class="font-14" style="text-align: start; ">Title</th>
                <th class="font-14" style="text-align: start; ">Name</th>
                <th class="font-14" style="text-align: start; ">Gender</th>
                <th class="font-14" style="text-align: start; ">Nationality</th>
                
                <th class="font-14" style="text-align: start; ">Seat No</th>
                <th class="font-14" style="text-align: start; ">Fare</th>
            </tr>
            
            @forelse($ticket_data->passenger_details as $key => $passenger)
            <tr>
                <td class="font-14" style="text-align: start; padding-top:0px; ">{{ $key + 1 }}</td>
                <td class="font-14" style="text-align: start; padding-top:0px; ">{{$passenger->passenger_title}}</td>
                <td class="font-14" style="text-align: start; padding-top:0px; ">{{$passenger->name}}</td>
                <td class="font-14" style="text-align: start; padding-top:0px; ">{{$passenger->gender}}</td>
                <td class="font-14" style="text-align: start; padding-top:0px; ">{{$passenger->nationality}}</td>
                
                <td class="font-14" style="text-align: start; padding-top:0px; ">{{$passenger->seat_number}}</td>
                <td class="font-14" style="text-align: start; margin-top:8px; ">₹{{$passenger->ticket_price}}</td>
            </tr>
            @empty
            <tr>
                <td class="font-14" colspan="7" style="text-align: start; padding-top:0px; ">No Passenger</td>
            </tr>
            @endforelse
            <tr>
                <td class="font-14" style="text-align: start; padding-top:0px; "> &nbsp;</td>
                <td class="font-14" style="text-align: start; padding-top:0px; "> &nbsp;</td>
                <td class="font-14" style="text-align: start; padding-top:0px; "> &nbsp;</td>
                <td class="font-14" style="text-align: start; padding-top:0px; "> &nbsp;</td>
                <td class="font-14" style="text-align: start; padding-top:0px; "> &nbsp;</td>
                <td class="font-14" style="text-align: start; padding-top:0px; ">Fare Total</td>
                <td class="font-14" style="text-align: start; margin-top:8px; ">₹{{ $ticket_data->fare_total }}</td>
            </tr>

            <tr>
                <td class="font-14" style="text-align: start; padding-top:0px; "> &nbsp;</td>
                <td class="font-14" style="text-align: start; padding-top:0px; "> &nbsp;</td>
                <td class="font-14" style="text-align: start; padding-top:0px; "> Mode of payment: {{ $ticket_data->payment_method }}</td>
                <td class="font-14" style="text-align: start; padding-top:0px; "> &nbsp;</td>
                <td class="font-14" style="text-align: start; padding-top:0px; "> &nbsp;</td>
                <td class="font-14" style="text-align: start; padding-top:0px; ">PMB Charges</td>
                <td class="font-14" style="text-align: start; margin-top:8px; ">₹{{ $ticket_data->port_fee_total }}</td>
            </tr>

        </table>
        <table style="width: 100%; white-space: nowrap;">
            <tr>
                <th style="text-align: center;">
                    <h3><u>Mode of payment: {{ $ticket_data->payment_method }}</u></h3>
                </th>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="text-align: start; width: 50%;">
                    <ol>
                        <li class="font-12" style=""><b>Reporting time should be 01 hours prior to Departure.</b></li>
                        <li class="font-12" style=""><b>Check in closes - 20 mins prior to Departure & Boarding closes 10 mins
                                prior to departure.</b></li>
                        <li class="font-12" style="">Passengers must carry valid ID proof .Tickets stands invalid after departure of
                            the vessel.</li>
                        <li class="font-12" style="">Reschedule of ticket is only applicable on the basis of seat availability.</li>
                        <li class="font-12" style="">Reschedule / Cancellation of tickets before 48 hours of departure will be
                            charged Rs.100 (Documentation charges per ticket); above 24>48 hours will be
                            50% and within 24 hours of sailing – No Refund.</li>
                        <li class="font-12" style="">Correction of NAME is not permitted in ticket ONCE BOOKED. Transferring or
                            re-routing of ticket by your own is strictly prohibited.</li>
                        <li class="font-12" style="">Green Ocean is not responsible for any theft, loss and damage of personal
                            belongings of passengers on board.</li>
                        <li class="font-12" style="">Personal baggage is allowed up to 25 Kg per person</li>
                        <li class="font-12" style="">Consumption of alcohol,narcotics, smoking, chewing of tobacco and spitting
                            inside the vessel is strictly prohibited.</li>
                        <li class="font-12" style="">In case of any Cancellation of sailing due to bad weather, any technical
                            reasons or any other reasons Green Ocean management will have no liability for
                            any loss that passengers may suffer.</li>
                    </ol>
                </td>
                <td style="text-align: start; width: 50%;">

                    <p class="font-12" style="margin-bottom: 0px; margin-top: 0px; ">11.Green Ocean reserves the right to cancel or
                        change the sailing schedule for
                        any official reason.</p>
                    <p class="font-12" style="margin-bottom: 0px; margin-top: 0px; ">12. Any loss or damage to Green Ocean property by
                        any passenger, the
                        management retains the right to recover the losses so incurred from the
                        passenger.</p>
                    <p class="font-12" style="margin-bottom: 0px; margin-top: 0px; ">13. The passenger hereby warrants and declares
                        he/she including any
                        accompanying children and / or babies in arms does not suffer from any form of
                        major illness or ailments. The Carrier shall not be responsible for any
                        consequences of whatsoever nature resulting from pre-carriage illness/ailments
                        that may manifest during the course of carriage. The passenger undertakes to
                        indemnify and hold the carrier harmless from any and all such consequences.</p>
                    <p class="font-12" style="margin-bottom: 0px; margin-top: 0px; ">14. This Ticket and the carriage of passenger here
                        under shall be governed by
                        Indian law, and all disputes and claims (including but not limited to claims arising
                        out of personal injury) and the carriage of passengers shall be referred to the
                        exclusive jurisdiction of the competent court in Port Blair, Andaman & Nicobar
                        Islands, India.</p>
                    <p class="font-12" style="margin-bottom: 0px; margin-top: 0px; ">15. Items such as knives, nail cutters, explosive,
                        fire arms and ammunition etc are
                        strictly prohibited onboard. Pets and animals allowed as per the conditions of
                        carriage.</p>

                    </ol>
                </td>
            </tr>

        </table>
        <table>
            <tr>
                <td>
                    <p class="font-14">Mode of payment: <b>From Agent Account</b></p>
                    <p class="font-14">For any further queries contact : <b>Green Ocean Seaways Private Limited</b></p>
                    <p class="font-14">2nd Floor, Island Arcade Building, Junglighat, Port Blair - 744102, Andaman & Nicobar Islands, INDIA</p>
                    <p class="font-14"><b>Ph : 03192230777 / 9932080959</b>&nbsp;&nbsp;&nbsp;<b>info@greenoceancruise.com</b>&nbsp;&nbsp;&nbsp;<b>www.greenoceanseaways.com</b></p>
                </td>
            </tr>
        </table>
        <table style="width: 100%;"><tr><td style="text-align: center; white-space: nowrap;"><img src="http://uat.bookmyferry.in/assets/images/Capture3.PNG" alt=""></td></tr></table>
    </div>
    
</body>
</html>