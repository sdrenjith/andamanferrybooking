@extends('layouts.app')

@section('content')
<main>
    <section class="mt-5 pt-3">
        <div class="row secHead mb-5 w-100 booking-details">
            <div class="col-12 text-center">
                <h2>Booking Details</h2>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="container">
            <form action="{{ url('/booking-form-ferry') }}" method="POST" id="booking_details_id">
                @csrf         
                <input type="hidden" name="type" value="ferry">
                <div class="row">
                    <div class="col-12 col-lg-8" id="passenger-forms-container">
                        @for ($i = 1; $i <= $booking_data['no_of_passenger']; $i++) <div class="travel-insurance-main-bg">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="add-insurance-heading" id="numofPassenger">PASSENGER
                                        {{ $i }}
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12 booking-journey-prevnext-btn">
                                    <label class="mb-0">Enter Name</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="order-input">
                                        <select id="p_title" class="form-control passenger_title " name="passenger_title[{{ $i }}]">
                                            <option value="Mr">MR</option>
                                            <option value="Mrs">MRS</option>
                                            <option value="Miss">MISS</option>
                                            <option value="Master">MASTER</option>
                                            <option value="Dr">DR</option>
                                        </select>
                                        <span class="text-danger"></span>
                                        @error('passenger_title.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-8 form-group">
                                    <div class="order-input">
                                        <input type="text" name="passenger_name[{{ $i }}]" class="form-control" id="passenger_name[{{ $i }}]" placeholder="Full Name">
                                        <span class="text-danger"></span>
                                        @error('passenger_name.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group mb-2">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Age</label>
                                    </div>
                                    <div class="order-input">
                                        <input type="number" name="passenger_dob[{{ $i }}]" class="form-control" id="" placeholder="Age" min="1" max="99" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2);" onkeyup="minagecheck(this)">
                                        
                                        <span class="text-danger"></span>
                                        @error('passenger_dob.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error p1_age"></label>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group mb-3 force-top">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Gender</label>
                                    </div>
                                    <div class="order-input">
                                        <select id="p_sex1" class="form-control" name="passenger_gender[{{ $i }}]">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <span class="text-danger"></span>
                                        @error('passenger_gender.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 form-group mb-2">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Resident</label>
                                    </div>
                                    <div class="order-input">
                                        <select id="residental" class="form-control" name="passenger_nationality[{{ $i }}]">
                                            <option value="indian">INDIAN</option>
                                            <option value="foreigner">FOREIGNER</option>
                                        </select>
                                        <span class="text-danger"></span>
                                        @error('passenger_nationality.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-4 form-group" id="country_name" style="display: none;">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Country Name</label>
                                    </div>
                                    <div class="order-input">
                                        <input type="text" name="country_name[{{ $i }}]" class="form-control" id="country_name" placeholder="Country Name">
                                        <span class="text-danger"></span>
                                        @error('country_name.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error p1_age"></label>
                                    </div>
                                </div>

                                <div class="col-md-4 form-group" style="display: none" id="passport_id">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Passport Id</label>
                                    </div>
                                    <div class="order-input">
                                        <input type="text" name="passport_id[{{ $i }}]" class="form-control" id="passport_id" placeholder="Passport Id">
                                        <span class="text-danger"></span>
                                        @error('passport_id.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error p1_age"></label>
                                    </div>
                                </div>

                                <div class="col-md-4 form-group" style="display: none" id="expiry_date">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Passport Expiry Date</label>
                                    </div>
                                    <div class="order-input">
                                        <input type="date" name="expiry_date[{{ $i }}]" class="form-control" id="expiry_date" placeholder="Passport Expiry Date">
                                        <span class="text-danger"></span>
                                        @error('expiry_date.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error p1_age"></label>
                                    </div>
                                </div>

                            </div>
                            <div class="row" id="foreign_fields1"></div>
                    </div>
                    @endfor


                    @for ($j = 1; $j <= $booking_data['no_of_infant']; $j++) <div class="">
                        <div class="travel-insurance-main-bg">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="add-insurance-heading" id="infant">INFANTS
                                        {{ $j }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 booking-journey-prevnext-btn">
                                    <label class="mb-0">Enter Name</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="order-input">
                                        <select id="p_title" class="form-control passenger_title " name="passenger_title[{{ $i }}]">
                                            <option value="INFANT">INFANT (Up to 1year)</option>
                                        </select>
                                        <span class="text-danger"></span>
                                        @error('passenger_title.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-8 form-group">
                                    <div class="order-input">
                                        <input type="text" name="passenger_name[{{ $i }}]" class="form-control" id="passenger_name[{{ $i }}]" placeholder="Infant Full Name" required>
                                        <span class="text-danger"></span>
                                        @error('passenger_name.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Age</label>
                                    </div>
                                    <div class="order-input">
                                        <input type="number" name="passenger_dob[{{ $i }}]" class="form-control" id="" placeholder="Age" value="1" readonly>
                                        <span class="text-danger"></span>
                                        @error('passenger_dob.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error p1_age"></label>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Gender</label>
                                    </div>
                                    <div class="order-input">
                                        <select id="p_sex1" class="form-control" name="passenger_gender[{{ $i }}]">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <span class="text-danger"></span>
                                        @error('passenger_gender.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Resident</label>
                                    </div>
                                    <div class="order-input">
                                        <select id="residental" class="form-control" name="passenger_nationality[{{ $i }}]">
                                            <option value="indian">INDIAN</option>
                                            <option value="foreigner">FOREIGNER</option>
                                        </select>
                                        <span class="text-danger"></span>
                                        @error('passenger_nationality.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-4 form-group" id="country_name" style="display: none;">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Country Name</label>
                                    </div>
                                    <div class="order-input">
                                        <input type="text" name="country_name[{{ $i }}]" class="form-control" id="country_name" placeholder="Country Name">
                                        <span class="text-danger"></span>
                                        @error('country_name.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error p1_age"></label>
                                    </div>
                                </div>

                                <div class="col-md-4 form-group" style="display: none" id="passport_id">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Passport Id</label>
                                    </div>
                                    <div class="order-input">
                                        <input type="text" name="passport_id[{{ $i }}]" class="form-control" id="passport_id" placeholder="Passport Id">
                                        <span class="text-danger"></span>
                                        @error('passport_id.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error p1_age"></label>
                                    </div>
                                </div>

                                <div class="col-md-4 form-group" style="display: none" id="expiry_date">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Passport Expiry Date</label>
                                    </div>
                                    <div class="order-input">
                                        <input type="date" name="expiry_date[{{ $i }}]" class="form-control" id="expiry_date" placeholder="Passport Expiry Date">
                                        <span class="text-danger"></span>
                                        @error('expiry_date.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error p1_age"></label>
                                    </div>
                                </div>

                            </div>
                            <div class="row" id="foreign_fields1"></div>
                        </div>


                </div>

                @php
                $i++;
                @endphp
                @endfor


                <div class="">
                    <div class="">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="home-heading-top">Contact Details</h3>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="travel-insurance-main-bg">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="add-insurance-heading">CONTACT PERSON</div>
                                </div>
                                <div class="booking-journey-prevnext-btn row">
                                    <p class="col-12 mb-0"><span class="text-danger">*</span>Booking details
                                        will be shared to this ID</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 form-group">
                                    <div class="order-input">
                                        <input type="text" name="c_name" class="form-control" id="c_name" placeholder="Name" required>
                                        <span class="text-danger"></span>
                                        @error('c_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error c_name"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="order-input">
                                        <input type="email" name="c_email" class="form-control" id="c_email" placeholder="Email address" style="text-transform: none;" oninput="this.value = this.value.toLowerCase();" required>
                                        <span class="text-danger"></span>
                                        @error('c_email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error c_email"></label>
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <div class="order-input">
                                        <input type="text" name="c_mobile" class="form-control" id="c_mobile" placeholder="Mobile No" required>
                                        <span class="text-danger"></span>
                                        @error('c_mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error c_mobile"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <div class="order-input">
                                        <input type="text" name="p_contact" class="form-control" id="p_contact" placeholder="Altarnet Contact numbers" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                                        <span class="text-danger"></span>
                                        @error('p_contact')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error p_contact"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
      


        <div class="col-4">
            <div class="position-sticky top-0" id="payment">
                <div class="booking-summary-main-bg">
                    <button onclick="closePageView()" class="popup-close mb-visible mobile-close-btn"><i class="bi bi-x-lg"></i></button>
                    <div class="row py-2 p-0 m-0 w-100">
                        <div class="col-md-12 d-flex align-items-center justify-content-between">
                            <div class="booking-summary-heading w-auto float-none">BOOKING SUMMARY</div>
                            <p class="fw-semibold text-white mb-0">₹ <span id="set_total_fare"></span></p>
                        </div>
                    </div>
                    <div class="bookingSummary">
                        <div class="row w-100 p-0 m-0 bg-white">
                            <div class="px-2 col-12 py-1 tripDirection d-flex  align-items-center" style="justify-content: space-between;">
                                <p class=" m-0 "> Onwards : <span class="departing-txt-date d-inline-block">{{ date('d-m-Y', strtotime($booking_data['date'])) }}</span>
                                </p>
                                <p class="m-0"> {{ $trip1['ship_name'] }}</p>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="departing-box-main">

                                    <div class="departing-txt">
                                        <span class="departing-txt-date"></span>
                                    </div>
                                    <div class="row w-100 p-0 m-0 departing-destination">
                                        <div class="col-sm-6 destination-time px-0">{{ $from_location_title ?? 'Unknown' }}
                                        </div>
                                        <div class="col-sm-6 destination-time px-0">{{ $to_location_title ?? 'Unknown' }}
                                        </div>
                                    </div>

                                    <div class="row w-100 p-0 m-0 mt-2">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">Total Duration</p>
                                        </div>
                                        @php
                                        $dTime = $booking_data['date'] . ' ' . $trip1['departure_time'];
                                        $aTime = $booking_data['date'] . ' ' . $trip1['arrival_time'];

                                        $departureTime = Carbon\Carbon::parse($dTime);
                                        $arrivalTime = Carbon\Carbon::parse($aTime);
                                        $totalDuration = $arrivalTime->diff($departureTime);
                                        $totalHours = $totalDuration->h + $totalDuration->days * 24;
                                        @endphp

                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0"> {{ $totalHours }}
                                                Hr
                                                {{ $totalDuration->i }} m Non-stop
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row w-100 p-0 m-0 mt-2">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">Class Type</p>
                                        </div>

                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">
                                                @if(($trip1['class_title'] ?? '')=='bClass')
                                                    {{'Business'}}
                                                @elseif (($trip1['class_title'] ?? '')=='pClass')
                                                    {{'Premium'}}
                                                @else
                                                {{ $trip1['class_title'] ?? 'Standard' }}
                                                @endif
                                            </p>
                                        </div>

                                    </div>
                                    <div class="row w-100 p-0 m-0 mt-2">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">No of Passenger</p>
                                        </div>
                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">{{ $booking_data['no_of_passenger'] }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row w-100 p-0 m-0 mt-2 ">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">
                                                @if ($trip1['ship_name'] == 'Nautika' || $trip1['ship_name'] == 'Makruzz' || str_contains($trip1['ship_name'], 'Green Ocean'))
                                                    Advance Booking Price
                                                @else
                                                    Per Passenger Price
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">INR
                                                <?php 
                                                if ($trip1['ship_name'] == 'Nautika' || $trip1['ship_name'] == 'Makruzz' || str_contains($trip1['ship_name'], 'Green Ocean')) {
                                                    $price = 200;
                                                } else {
                                                    $price = $trip1['fare'];
                                                }
                                                ?>
                                                <span>{{ number_format($price, 2) }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <?php 
                                    $infant = $booking_data['no_of_infant'] ?? 0;
                                    $infant_price = (($trip1['infantFare'] ?? 200) + $trip1['psf']) * $infant;
                                    ?>
                                    @if ($booking_data['schedule'][1]['ship'] == 'Nautika' || $booking_data['schedule'][1]['ship'] == 'Makruzz' || str_contains($booking_data['schedule'][1]['ship'], 'Green Ocean'))
                                    <div class="row w-100 p-0 m-0 mt-2 ">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">No Of Infant</p>
                                        </div>
                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">
                                                <span>{{ $infant }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <div class="row w-100 p-0 m-0 mt-2 pb-2">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">PSF {{'(Per Pax/Infant)'}}</p>
                                        </div>
                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">INR
                                                <span>{{ $trip1['psf'] }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <?php $discount=0; ?>
                                    <?php $trip2_discount=0; ?>
                                    <?php $trip3_discount=0; ?>

                                    {{-- if check for single booking total price (for nautike only add rs 100 per infant) --}}
                                    @php

                                    if ($trip1['ship_name'] == 'Nautika' || $trip1['ship_name'] == 'Makruzz' || str_contains($trip1['ship_name'], 'Green Ocean')) {
                                        $total_single_price = (200 + $trip1['psf']) * $booking_data['no_of_passenger'] + $infant_price;
                                    } else {
                                        $total_single_price = (($price + $trip1['psf']) * $booking_data['no_of_passenger']) - $discount;
                                    }
  
                                    $total_trip2_price = 0;
                                    $trip_infant_price=0;
                                    @endphp

                                </div>
                            </div>

                            @if (isset($trip2))

                            <div class="row w-100 p-0 m-0 bg-white">
                                <div class="px-2 col-12 py-1 tripDirection d-flex align-items-center" style="justify-content: space-between;">
                                    <p class=" mb-0 ">Trip 2 : <span class="departing-txt-date d-inline-block">{{ $booking_data['departure_date'] }}</span>
                                    </p>
                                    <p class="mb-0"> {{ $trip2['ship_name'] }}</p>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="departing-box-main">
                                        <div class="departing-txt">
                                            <span class="departing-txt-date"></span>
                                        </div>
                                        <div class="row w-100 p-0 m-0 departing-destination">
                                            <?php $form_location = $booking_data['departure_from_location']; ?>
                                            <?php $to_location = $booking_data['departure_to_location']; ?>
                                            <div class="col-sm-6 destination-time px-0">{{ $return_from_location_title ?? 'Unknown' }}
                                            </div>
                                            <div class="col-sm-6 destination-time px-0">{{ $return_to_location_title ?? 'Unknown' }}
                                            </div>
                                        </div>

                                        @php
                                        $dTime = $trip2['departure_time'];
                                        $aTime = $trip2['arrival_time'];

                                        $departureTime = Carbon\Carbon::parse($dTime);
                                        $arrivalTime = Carbon\Carbon::parse($aTime);
                                        $totalDuration = $arrivalTime->diff($departureTime);
                                        $totalHours = $totalDuration->h + $totalDuration->days * 24;
                                        @endphp

                                        <div class="row w-100 p-0 m-0 mt-2">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">Total Duration</p>
                                            </div>

                                            <div class="col-6 p-0 departing-txt">
                                                <p class="departing-txt-date d-inline-block m-0">
                                                    {{ $totalHours }}
                                                    Hr {{ $totalDuration->i }} m Non-stop
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row w-100 p-0 m-0 mt-2">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">Class Type</p>
                                            </div>

                                            <div class="col-6 p-0 departing-txt">
                                                <?php $ferry_class_title = $trip2['class_title'] ?? 'Standard'; ?>
                                                <p class="departing-txt-date d-inline-block m-0">
                                                    @if(($trip2['class_title'] ?? '')=='bClass')
                                                    {{'Business'}}
                                                    @elseif (($trip2['class_title'] ?? '')=='pClass')
                                                        {{'Premium'}}
                                                    @else
                                                    {{ $trip2['class_title'] ?? 'Standard' }}
                                                    @endif
                                                </p>
                                            </div>

                                        </div>
                                        <div class="row w-100 p-0 m-0 mt-2">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">No of Passenger</p>
                                            </div>
                                            <div class="col-6 p-0 departing-txt">
                                                <?php $trip2_passenger = $booking_data['no_of_passenger']; ?>
                                                <p class="departing-txt-date d-inline-block m-0">
                                                    {{ $trip2_passenger }}
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <?php 
                                        $trip2_infants = $booking_data['no_of_infant'] ?? 0;
                                        $trip2_infant_price = (($trip2['infantFare'] ?? 200) + $trip2['psf']) * $trip2_infants;
                                        ?>
                                        
                                        @if ($trip2['ship_name'] == 'Nautika' || $trip2['ship_name'] == 'Makruzz' || str_contains($trip2['ship_name'], 'Green Ocean'))
                                        <div class="row w-100 p-0 m-0 mt-2">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">No of Infant</p>
                                            </div>
                                            <div class="col-6 p-0 departing-txt">
                                                <p class="departing-txt-date d-inline-block m-0">
                                                    {{ $trip2_infants }}
                                                </p>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="row w-100 p-0 m-0 mt-2 ">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">
                                                    @if ($trip2['ship_name'] == 'Nautika' || $trip2['ship_name'] == 'Makruzz' || str_contains($trip2['ship_name'], 'Green Ocean'))
                                                        Advance Booking Price
                                                    @else
                                                        Per Passenger Price
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-6 p-0 departing-txt">
                                                <p class="departing-txt-date d-inline-block m-0">INR
                                                    <?php 
                                                    if ($trip2['ship_name'] == 'Nautika' || $trip2['ship_name'] == 'Makruzz' || str_contains($trip2['ship_name'], 'Green Ocean')) {
                                                        $trip2_price = 200;
                                                    } else {
                                                        $trip2_price = $trip2['fare'];
                                                    }
                                                    ?>
                                                    <span>{{ number_format($trip2_price, 2) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row w-100 p-0 m-0 mt-2  pb-2">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">PSF {{'(Per Pax/Infant)'}}</p>
                                            </div>
                                            <div class="col-6 p-0 departing-txt">
                                                <p class="departing-txt-date d-inline-block m-0">INR
                                                    <?php $trip2_psf = $trip2['psf']; ?>
                                                    <span>{{ $trip2_psf }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        

                                        @php
                                        if ($trip2['ship_name'] == 'Nautika' || $trip2['ship_name'] == 'Makruzz' || str_contains($trip2['ship_name'], 'Green Ocean')) {
                                            $total_trip2_price = ((200 + $trip2_psf) * $trip2_passenger +
                                            $trip2_infant_price);

                                        } else { 
                                            $total_trip2_price = (($trip2_price + $trip2_psf) * $trip2_passenger) - $trip2_discount ;
                                        }

                                        @endphp

                                    </div>
                                </div>
                            </div>
                            @endif

                            @if (isset($trip3))
                            <div class="row w-100 p-0 m-0 bg-white">
                                <div class="px-2 col-12 py-1 tripDirection d-flex align-items-center" style="justify-content: space-between;">
                                    <p class=" mb-0 ">Trip 3 : <span class="departing-txt-date d-inline-block">{{ $booking_data['round2_date'] }}</span>
                                    </p>
                                    <p class="mb-0"> {{ $trip3['ship_name'] }}</p>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="departing-box-main">
                                        <div class="departing-txt">
                                            <span class="departing-txt-date"></span>
                                        </div>
                                        <div class="row w-100 p-0 m-0 departing-destination">
                                            <?php $form_location = $booking_data['round2_from_location']; ?>
                                            <?php $to_location = $booking_data['round2_to_location']; ?>
                                            <div class="col-sm-6 destination-time px-0">{{ $round2_from_location_title ?? 'Unknown' }}
                                            </div>
                                            <div class="col-sm-6 destination-time px-0">{{ $round2_to_location_title ?? 'Unknown' }}
                                            </div>
                                        </div>

                                        @php
                                        $dTime = $trip3['departure_time'];
                                        $aTime = $trip3['arrival_time'];

                                        $departureTime = Carbon\Carbon::parse($dTime);
                                        $arrivalTime = Carbon\Carbon::parse($aTime);
                                        $totalDuration = $arrivalTime->diff($departureTime);
                                        $totalHours = $totalDuration->h + $totalDuration->days * 24;
                                        @endphp

                                        <div class="row w-100 p-0 m-0 mt-2">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">Total Duration</p>
                                            </div>

                                            <div class="col-6 p-0 departing-txt">
                                                <p class="departing-txt-date d-inline-block m-0">
                                                    {{ $totalHours }}
                                                    Hr {{ $totalDuration->i }} m Non-stop
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row w-100 p-0 m-0 mt-2">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">Class Type</p>
                                            </div>

                                            <div class="col-6 p-0 departing-txt">
                                                <?php $ferry_class_title = $trip3['class_title'] ?? 'Standard'; ?>
                                                <p class="departing-txt-date d-inline-block m-0">
                                                    @if(($trip3['class_title'] ?? '')=='bClass')
                                                    {{'Business'}}
                                                    @elseif (($trip3['class_title'] ?? '')=='pClass')
                                                        {{'Premium'}}
                                                    @else
                                                    {{ $trip3['class_title'] ?? 'Standard' }}
                                                    @endif
                                                </p>
                                            </div>

                                        </div>
                                        <div class="row w-100 p-0 m-0 mt-2">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">No of Passenger</p>
                                            </div>
                                            <div class="col-6 p-0 departing-txt">
                                                <?php $trip3_passenger = $booking_data['no_of_passenger']; ?>
                                                <p class="departing-txt-date d-inline-block m-0">
                                                    {{ $trip3_passenger }}
                                                </p>
                                            </div>
                                        </div>
                                        @if ($trip3['ship_name'] == 'Nautika')
                                        <div class="row w-100 p-0 m-0 mt-2">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">No of Infant</p>
                                            </div>
                                            <div class="col-6 p-0 departing-txt">
                                                <?php $trip3_infants = $booking_data['no_of_infant']; ?>
                                                <?php $trip3_infant_price = (($trip3['infantFare'] ?? 200) + $trip3['psf']) * $trip3_infants; ?>
                                                <p class="departing-txt-date d-inline-block m-0">
                                                    {{ $trip3_infants }}
                                                </p>

                                            </div>
                                        </div>
                                        @endif

                                        <div class="row w-100 p-0 m-0 mt-2 ">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">
                                                    @if ($trip3['ship_name'] == 'Nautika' || $trip3['ship_name'] == 'Makruzz' || str_contains($trip3['ship_name'], 'Green Ocean'))
                                                        Advance Booking Price
                                                    @else
                                                        Per Passenger Price
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-6 p-0 departing-txt">
                                                <p class="departing-txt-date d-inline-block m-0">INR
                                                    <?php 
                                                    if ($trip3['ship_name'] == 'Nautika' || $trip3['ship_name'] == 'Makruzz' || str_contains($trip3['ship_name'], 'Green Ocean')) {
                                                        $trip3_price = 200;
                                                    } else {
                                                        $trip3_price = $trip3['fare'];
                                                    }
                                                    ?>
                                                    <span>{{ number_format($trip3_price, 2) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row w-100 p-0 m-0 mt-2  pb-2">
                                            <div class="departing-txt m-0 col-6 p-0">
                                                <p class="departing-txt-date m-0">PSF {{'(Per Pax/Infant)'}}</p>
                                            </div>
                                            <div class="col-6 p-0 departing-txt">
                                                <p class="departing-txt-date d-inline-block m-0">INR
                                                    <?php $trip3_psf = $trip3['psf']; ?>
                                                    <span>{{ $trip3_psf }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        

                                        @php
                                        if ($trip3['ship_name'] == 'Nautika' || $trip3['ship_name'] == 'Makruzz' || str_contains($trip3['ship_name'], 'Green Ocean')) {
                                            $total_trip3_price = ((200 + $trip3_psf) * $trip3_passenger +
                                            $trip3_infant_price);

                                        } else { 
                                            $total_trip3_price = (($trip3_price + $trip3_psf) * $trip3_passenger) - $trip3_discount ;
                                        }

                                        @endphp

                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-12 p-0 mt-2">
                                <div class="departing-box-main totalFare">
                                    <div class="row w-100 p-0 m-0 py-2 px-3 align-items-center">
                                        <div class="col-6 p-0">
                                            <div class="departing-txt">
                                                <p class="departing-txt-date m-0 text-white">Total fare
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-6 destination-time p-0 text-white">
                                        
                                            INR <span id="total_fare">{{ number_format(($total_single_price ?? 0) + ($total_trip2_price ?? 0) +  ($total_trip3_price ?? 0)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Payment Button inside popup -->
                    <div class="text-center p-3 d-block d-md-none">
                        <button class="btn mobile-proceed-payment" style="background: #0076ae; color:#FFF; width:100%; padding: 15px 20px; border-radius: 8px; border: none; font-size: 16px; font-weight: 600; box-shadow: 0 4px 12px rgba(0, 118, 174, 0.3);">
                            <i class="bi bi-credit-card me-2"></i>Proceed to Payment
                        </button>
                    </div>
                </div>
                <!-- Desktop Payment Button -->
                <div class="text-center p-4 pb-2 d-none d-md-block">
                    <input class="btn proceedBtn" style="background: #0076ae; color:#FFF; width:100%" type="submit" value="Proceed to Payment">
                </div>
            </div>
        </div>

        </div>
        </div>
        </div>
    </section>


  <?php Session:: put('total_trip1_amount',  $total_single_price ?? NULL); ?>
  <?php Session:: put('total_trip2_amount',  $total_trip2_price ?? NULL); ?>
  <?php Session:: put('total_trip3_amount',  $total_trip3_price ?? NULL); ?>
  <?php Session:: put('total_amount',  (($total_single_price ?? 0) + ($total_trip2_price ?? 0) + ($total_trip3_price?? 0))); ?>

</form>

<!-- SIMPLE MOBILE BUTTON -->
<div class="d-block d-md-none" style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 1000 !important; padding: 15px; background: #008495;">
    <button id="showSummaryBtn" class="btn btn-primary w-100" style="background: #008495; border: none; color: white; padding: 15px; font-size: 16px; font-weight: 600;">
        <i class="bi bi-receipt me-2"></i>Show Summary
    </button>
</div>

<!-- MOBILE POPUP -->
<div id="mobilePopup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 10000;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; border-radius: 10px; padding: 20px; width: 90%; max-height: 80vh; overflow-y: auto;">
        <button id="closePopup" style="position: absolute; top: 10px; right: 15px; background: none; border: none; font-size: 24px; cursor: pointer;">&times;</button>
        
        <!-- SUMMARY CONTENT -->
        <div class="booking-summary-content">
            <div class="row py-2 p-0 m-0 w-100" style="background: #008495; color: white; margin: -20px -20px 20px -20px; padding: 15px 20px; border-radius: 10px 10px 0 0;">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div style="font-weight: bold; font-size: 18px;">BOOKING SUMMARY</div>
                    <div style="font-weight: bold; font-size: 18px;">₹ <span id="set_total_fare">{{ number_format(($total_single_price ?? 0) + ($total_trip2_price ?? 0) + ($total_trip3_price ?? 0), 2) }}</span></div>
                </div>
            </div>
            
            <div class="summary-details" style="background: white; padding: 15px; border-radius: 5px;">
                <!-- Trip 1 (Onwards) -->
                <div style="padding: 10px; margin-bottom: 15px; border: 1px solid #e0e0e0; border-radius: 5px;">
                    <div style="background: #f8f9fa; padding: 8px; margin: -10px -10px 10px -10px; border-radius: 5px 5px 0 0;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="color: #008495; font-weight: bold;">Onwards: {{ date('d-m-Y', strtotime($booking_data['date'])) }}</span>
                            <span style="color: #008495; font-weight: bold;">{{ $trip1['ship_name'] }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="color: #008495; font-weight: bold;">{{ $from_location_title ?? 'Unknown' }}</span>
                            <span style="color: #008495; font-weight: bold;">{{ $to_location_title ?? 'Unknown' }}</span>
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">Total Duration</span>
                        <span style="color: #008495;">
                            @php
                            $dTime = $booking_data['date'] . ' ' . $trip1['departure_time'];
                            $aTime = $booking_data['date'] . ' ' . $trip1['arrival_time'];
                            $departureTime = Carbon\Carbon::parse($dTime);
                            $arrivalTime = Carbon\Carbon::parse($aTime);
                            $totalDuration = $arrivalTime->diff($departureTime);
                            $totalHours = $totalDuration->h + $totalDuration->days * 24;
                            @endphp
                            {{ $totalHours }} Hr {{ $totalDuration->i }} m Non-stop
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">Class Type</span>
                        <span style="color: #008495;">
                            @if(($trip1['class_title'] ?? '')=='bClass')
                                Business
                            @elseif (($trip1['class_title'] ?? '')=='pClass')
                                Premium
                            @else
                                {{ $trip1['class_title'] ?? 'Standard' }}
                            @endif
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">No of Passenger</span>
                        <span style="color: #008495;">{{ $booking_data['no_of_passenger'] }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">
                            @if ($trip1['ship_name'] == 'Nautika' || $trip1['ship_name'] == 'Makruzz' || str_contains($trip1['ship_name'], 'Green Ocean'))
                                Advance Booking Price
                            @else
                                Per Passenger Price
                            @endif
                        </span>
                        <span style="color: #008495;">INR 
                            @php 
                            if ($trip1['ship_name'] == 'Nautika' || $trip1['ship_name'] == 'Makruzz' || str_contains($trip1['ship_name'], 'Green Ocean')) {
                                $price = 200;
                            } else {
                                $price = $trip1['fare'];
                            }
                            @endphp
                            {{ number_format($price, 2) }}
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">PSF (Per Pax/Infant)</span>
                        <span style="color: #008495;">INR {{ $trip1['psf'] }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px; padding-top: 8px; border-top: 1px solid #e0e0e0; font-weight: bold;">
                        <span style="color: #008495;">Trip 1 Total</span>
                        <span style="color: #008495;">INR {{ number_format($total_single_price ?? 0, 2) }}</span>
                    </div>
                </div>

                @if (isset($trip2))
                <!-- Trip 2 (Return) -->
                <div style="padding: 10px; margin-bottom: 15px; border: 1px solid #e0e0e0; border-radius: 5px;">
                    <div style="background: #f8f9fa; padding: 8px; margin: -10px -10px 10px -10px; border-radius: 5px 5px 0 0;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="color: #008495; font-weight: bold;">Trip 2: {{ $booking_data['departure_date'] }}</span>
                            <span style="color: #008495; font-weight: bold;">{{ $trip2['ship_name'] }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="color: #008495; font-weight: bold;">{{ $return_from_location_title ?? 'Unknown' }}</span>
                            <span style="color: #008495; font-weight: bold;">{{ $return_to_location_title ?? 'Unknown' }}</span>
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">Total Duration</span>
                        <span style="color: #008495;">
                            @php
                            $dTime = $trip2['departure_time'];
                            $aTime = $trip2['arrival_time'];
                            $departureTime = Carbon\Carbon::parse($dTime);
                            $arrivalTime = Carbon\Carbon::parse($aTime);
                            $totalDuration = $arrivalTime->diff($departureTime);
                            $totalHours = $totalDuration->h + $totalDuration->days * 24;
                            @endphp
                            {{ $totalHours }} Hr {{ $totalDuration->i }} m Non-stop
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">Class Type</span>
                        <span style="color: #008495;">
                            @if(($trip2['class_title'] ?? '')=='bClass')
                                Business
                            @elseif (($trip2['class_title'] ?? '')=='pClass')
                                Premium
                            @else
                                {{ $trip2['class_title'] ?? 'Standard' }}
                            @endif
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">No of Passenger</span>
                        <span style="color: #008495;">{{ $booking_data['no_of_passenger'] }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">
                            @if ($trip2['ship_name'] == 'Nautika' || $trip2['ship_name'] == 'Makruzz' || str_contains($trip2['ship_name'], 'Green Ocean'))
                                Advance Booking Price
                            @else
                                Per Passenger Price
                            @endif
                        </span>
                        <span style="color: #008495;">INR 
                            @php 
                            if ($trip2['ship_name'] == 'Nautika' || $trip2['ship_name'] == 'Makruzz' || str_contains($trip2['ship_name'], 'Green Ocean')) {
                                $trip2_price = 200;
                            } else {
                                $trip2_price = $trip2['fare'];
                            }
                            @endphp
                            {{ number_format($trip2_price, 2) }}
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">PSF (Per Pax/Infant)</span>
                        <span style="color: #008495;">INR {{ $trip2['psf'] }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px; padding-top: 8px; border-top: 1px solid #e0e0e0; font-weight: bold;">
                        <span style="color: #008495;">Trip 2 Total</span>
                        <span style="color: #008495;">INR {{ number_format($total_trip2_price ?? 0, 2) }}</span>
                    </div>
                </div>
                @endif

                @if (isset($trip3))
                <!-- Trip 3 (Additional) -->
                <div style="padding: 10px; margin-bottom: 15px; border: 1px solid #e0e0e0; border-radius: 5px;">
                    <div style="background: #f8f9fa; padding: 8px; margin: -10px -10px 10px -10px; border-radius: 5px 5px 0 0;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="color: #008495; font-weight: bold;">Trip 3: {{ $booking_data['round2_date'] }}</span>
                            <span style="color: #008495; font-weight: bold;">{{ $trip3['ship_name'] }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="color: #008495; font-weight: bold;">{{ $round2_from_location_title ?? 'Unknown' }}</span>
                            <span style="color: #008495; font-weight: bold;">{{ $round2_to_location_title ?? 'Unknown' }}</span>
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">Total Duration</span>
                        <span style="color: #008495;">
                            @php
                            $dTime = $trip3['departure_time'];
                            $aTime = $trip3['arrival_time'];
                            $departureTime = Carbon\Carbon::parse($dTime);
                            $arrivalTime = Carbon\Carbon::parse($aTime);
                            $totalDuration = $arrivalTime->diff($departureTime);
                            $totalHours = $totalDuration->h + $totalDuration->days * 24;
                            @endphp
                            {{ $totalHours }} Hr {{ $totalDuration->i }} m Non-stop
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">Class Type</span>
                        <span style="color: #008495;">
                            @if(($trip3['class_title'] ?? '')=='bClass')
                                Business
                            @elseif (($trip3['class_title'] ?? '')=='pClass')
                                Premium
                            @else
                                {{ $trip3['class_title'] ?? 'Standard' }}
                            @endif
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">No of Passenger</span>
                        <span style="color: #008495;">{{ $booking_data['no_of_passenger'] }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">
                            @if ($trip3['ship_name'] == 'Nautika' || $trip3['ship_name'] == 'Makruzz' || str_contains($trip3['ship_name'], 'Green Ocean'))
                                Advance Booking Price
                            @else
                                Per Passenger Price
                            @endif
                        </span>
                        <span style="color: #008495;">INR 
                            @php 
                            if ($trip3['ship_name'] == 'Nautika' || $trip3['ship_name'] == 'Makruzz' || str_contains($trip3['ship_name'], 'Green Ocean')) {
                                $trip3_price = 200;
                            } else {
                                $trip3_price = $trip3['fare'];
                            }
                            @endphp
                            {{ number_format($trip3_price, 2) }}
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495;">PSF (Per Pax/Infant)</span>
                        <span style="color: #008495;">INR {{ $trip3['psf'] }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px; padding-top: 8px; border-top: 1px solid #e0e0e0; font-weight: bold;">
                        <span style="color: #008495;">Trip 3 Total</span>
                        <span style="color: #008495;">INR {{ number_format($total_trip3_price ?? 0, 2) }}</span>
                    </div>
                </div>
                @endif
                
                <!-- Grand Total -->
                <div style="background: #0f55cc; color: white; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 16px;">
                        <span>Total fare</span>
                        <span>INR {{ number_format(($total_single_price ?? 0) + ($total_trip2_price ?? 0) + ($total_trip3_price ?? 0), 2) }}</span>
                    </div>
                </div>
            </div>
            
            <!-- PROCEED TO PAYMENT BUTTON -->
            <div class="text-center mt-3">
                <button id="proceedPayment" class="btn" type="button" style="background: #0076ae; color:#FFF; width:100%; padding: 15px 20px; border-radius: 8px; border: none; font-size: 16px; font-weight: 600; box-shadow: 0 4px 12px rgba(0, 118, 174, 0.3);">
                    Proceed to Payment
                </button>
            </div>
        </div>
    </div>
</div>

</main>
@endsection

@push('css')
<style>
/* Simple mobile styles */
@media only screen and (max-width: 767px) {
    /* Hide desktop elements on mobile */
    .d-none.d-md-block {
        display: none !important;
    }
    
    /* Show mobile elements */
    .d-block.d-md-none {
        display: block !important;
    }
    
    /* Hide mobile button when popup is open */
    #mobilePopup:not([style*="display: none"]) ~ .d-block.d-md-none #showSummaryBtn,
    #mobilePopup[style*="display: block"] ~ .d-block.d-md-none #showSummaryBtn {
        display: none !important;
    }
}
</style>
@endpush

@push('js')
{{-- <script src="js/script.js"></script> --}}


<script>
    function minagecheck(element){
      
        if (element.value<2) {
            $(element).val('');
        }
    }
    
    // Function to close the mobile popup
    function closePageView() {
        $(".bookingSumBg").removeClass("show");
        $("#payment").removeClass("show");
        $("body").removeClass("mobile-popup-open");
        
        // Show the mobile summary section when popup is closed
        $(".mobile-summary-section").show();
    }
    
    $(document).ready(function() {
        // Simple mobile popup functionality
        $("#showSummaryBtn").click(function() {
            $("#mobilePopup").show();
            $("#showSummaryBtn").hide(); // Hide the button when popup opens
            $("body").css("overflow", "hidden");
        });
        
        $("#closePopup").click(function() {
            $("#mobilePopup").hide();
            $("#showSummaryBtn").show(); // Show the button when popup closes
            $("body").css("overflow", "auto");
        });
        
        // Close popup when clicking outside
        $("#mobilePopup").click(function(e) {
            if (e.target === this) {
                $("#mobilePopup").hide();
                $("#showSummaryBtn").show(); // Show the button when popup closes
                $("body").css("overflow", "auto");
            }
        });
        
        $("#proceedPayment").click(function() {
            // Close the popup first
            $("#mobilePopup").hide();
            $("#showSummaryBtn").show();
            $("body").css("overflow", "auto");
            
            // Submit the form
            $("#booking_details_id").submit();
        });
        
        // Close popup when clicking on background
        $(".bookingSumBg").click(function(e) {
            if (e.target === this) {
                closePageView();
            }
        });
        
        // Add mobile payment button functionality
        $(document).on('click', '.mobile-proceed-payment', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Close mobile popup first
            closePageView();
            
            // Small delay to ensure popup closes before form submission
            setTimeout(function() {
                // Trigger form submission
                $('#booking_details_id').submit();
            }, 300);
        });
        
        // Add escape key functionality to close popup
        $(document).keyup(function(e) {
            if (e.keyCode == 27) { // Escape key
                closePageView();
            }
        });
        
        // Add touch event support for mobile
        $(document).on('touchstart', '.mobile-proceed-payment', function(e) {
            e.preventDefault();
        });
        
        $(document).on('touchend', '.mobile-proceed-payment', function(e) {
            e.preventDefault();
            $(this).trigger('click');
        });
    });

    $('#booking_details_id').on('submit', function(event) {
        document.querySelectorAll('span.text-danger').forEach(function(span) {
            span.innerHTML = '';
        });

        // Initialize variables
        let isValid = true;

        // Validate passenger fields
        const passengers = {{ $booking_data['no_of_passenger'] }};
            for (let i = 1; i <= passengers; i++) {
                const title = document.querySelector(`select[name="passenger_title[${i}]"]`);
                const name = document.querySelector(`input[name="passenger_name[${i}]"]`);
                const dob = document.querySelector(`input[name="passenger_dob[${i}]"]`);
                const gender = document.querySelector(`select[name="passenger_gender[${i}]"]`);
                const nationality = document.querySelector(`select[name="passenger_nationality[${i}]"]`);

                if (!title.value) {
                    document.querySelector(`select[name="passenger_title[${i}]"] + span.text-danger`).innerHTML =
                        'Title is required.';
                    isValid = false;
                }
                if (!name.value.trim()) {
                    document.querySelector(`input[name="passenger_name[${i}]"] + span.text-danger`).innerHTML =
                        'Name is required.';
                    isValid = false;
                }
                if (!dob.value) {
                    document.querySelector(`input[name="passenger_dob[${i}]"] + span.text-danger`).innerHTML =
                        'Age is required.';
                    isValid = false;
                }
                if (!gender.value) {
                    document.querySelector(`select[name="passenger_gender[${i}]"] + span.text-danger`).innerHTML =
                        'Gender is required.';
                    isValid = false;
                }
                if (!nationality.value) {
                    document.querySelector(`select[name="passenger_nationality[${i}]"] + span.text-danger`)
                        .innerHTML = 'Nationality is required.';
                    isValid = false;
                }
            }


        // Validate contact details
        const cName = document.querySelector('input[name="c_name"]');
        const cEmail = document.querySelector('input[name="c_email"]');
        const cMobile = document.querySelector('input[name="c_mobile"]');
        const pContact = document.querySelector('input[name="p_contact"]');

        if (!cName.value.trim()) {
            document.querySelector('input[name="c_name"] + span.text-danger').innerHTML =
                'Contact name is required.';
            isValid = false;
        }
        if (!cEmail.value.trim()) {
            document.querySelector('input[name="c_email"] + span.text-danger').innerHTML =
                'Contact email is required.';
            isValid = false;
        } else if (!/\S+@\S+\.\S+/.test(cEmail.value.trim())) {
            document.querySelector('input[name="c_email"] + span.text-danger').innerHTML =
                'Invalid email format.';
            isValid = false;
        }

        // Mobile number regex validation
        const mobileRegex = /^[0-9]{10}$/;
        if (!cMobile.value.trim()) {
            document.querySelector('input[name="c_mobile"] + span.text-danger').innerHTML =
                'Contact mobile is required.';
            isValid = false;
        } else if (!mobileRegex.test(cMobile.value.trim())) {
            document.querySelector('input[name="c_mobile"] + span.text-danger').innerHTML =
                'Invalid mobile number format.';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });


    $(document).ready(function() {
        var total_fare = $('#total_fare').text();
        $('#set_total_fare').text(total_fare);

        $(document).on('change', "#residental", function(e) {
            
            var resident_type = $(this).val(); // Use $(this) to refer to the changed element
            var parentRow = $(this).parents(".travel-insurance-main-bg");
            if (resident_type == 'foreigner') {
                parentRow.find('#passport_id').css('display', 'block');
                parentRow.find('#country_name').css('display', 'block');
                parentRow.find('#expiry_date').css('display', 'block');
            } else {
                parentRow.find('#passport_id').css('display', 'none');
                parentRow.find('#country_name').css('display', 'none');
                parentRow.find('#expiry_date').css('display', 'none');
            }
        });

    });
</script>

@endpush

