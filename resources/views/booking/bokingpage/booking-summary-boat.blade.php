@extends('layouts.app')

@section('content')
<main>
    <section class="mt-5 pt-3">
        <div class="row secHead mb-5 w-100">
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
            <form action="{{ url('/booking_form_boat') }}" method="POST" id="boat_booking_form">
                @csrf
                <input type="hidden" name="type" value="boat">
                <input type="hidden" name="boatScheduleId" value="{{ $boatScheduleId }}">
                <input type="hidden" name="no_of_passenger" value="{{ $passengers }}">
                <input type="hidden" name="date_of_jurney" value="{{ $date }}">
                <input type="hidden" name="amount" value="{{ $multi_price }}">
                <input type="hidden" name="boat_name" value="{{ $boat_datas->name }}">


                <div class="row">
                    <div class="col-12 col-lg-8" id="passenger-forms-container">
                        @for ($i = 1; $i <= $passengers; $i++) <div class="travel-insurance-main-bg">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="add-insurance-heading" id="numofPassenger">PASSENGER {{ $i }}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 booking-journey-prevnext-btn">
                                    <label class="mb-0">Enter Name</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="order-input">
                                        <select id="p_title" class="form-control" name="passenger_title[{{ $i }}]">
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
                                <div class="col-md-4 form-group">
                                    <div class="booking-journey-prevnext-btn">
                                        <label class="mb-0">Age</label>
                                    </div>
                                    <div class="order-input">
                                        <input type="number" name="passenger_dob[{{ $i }}]" class="form-control" id="" placeholder="Age">
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
                    @endfor


                    @for ($j = 1; $j <= $infants; $j++) <div class="">
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
                                        <input type="text" name="passenger_name[{{ $i }}]" class="form-control" id="passenger_name[{{ $i }}]" placeholder="Full Name">
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
                                        <input type="number" name="passenger_dob[{{ $i }}]" class="form-control" id="" placeholder="Age"  value="1" readonly>
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
                                    <p class="col-12 mb-0"><span class="text-danger">*</span>Booking details will be shared to this ID</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 form-group">
                                    <div class="order-input">
                                        <input type="text" name="c_name" class="form-control" id="c_name" placeholder="Name">
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
                                        <input type="email" name="c_email" class="form-control" id="c_email" placeholder="Email address" style="text-transform: none;">
                                        <span class="text-danger"></span>
                                        @error('c_email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="error c_email"></label>
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <div class="order-input">
                                        <input type="text" name="c_mobile" class="form-control" id="c_mobile" placeholder="Mobile No">
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
                                        <input type="text" name="p_contact" class="form-control" id="p_contact" placeholder="Contact numbers (Optional)" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" >
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
        </form>

        <div class="col-12 col-lg-4 col-md-4">
            <div class="position-sticky top-0" id="payment">
                <div class="booking-summary-main-bg boat">
                    <button onclick="closePageView()" class="popup-close mb-visible mobile-close-btn"><i class="bi bi-x-lg"></i></button>
                    <div class="row py-2 p-0 m-0 w-100">
                        <div class="col-md-12">
                            <div class="booking-summary-heading">BOOKING SUMMARY</div>
                        </div>
                    </div>
                    <div class="bookingSummary">
                        <div class="row w-100 p-0 m-0 bg-white">
                            <div class="px-2 col-12 py-1 tripDirection">
                                <p class=" m-0 "><span class="departing-txt-date d-inline-block">{{ $formattedDate }}</span></p>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="departing-box-main">

                                    <div class="departing-txt">
                                        <span class="departing-txt-date"></span>
                                    </div>
                                    <div class="row w-100 p-0 m-0 departing-destination">
                                        <div class="col-sm-12 destination-time px-0">
                                            {{ $boat_datas->name }}
                                        </div>
                                    </div>
                                    <div class="row w-100 p-0 m-0 mt-2">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">Amount/Person</p>
                                        </div>
                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">₹{{ number_format($boat_price, 2) }}</p>
                                        </div>
                                    </div>
                                    <div class="row w-100 p-0 m-0 mt-2">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">No of Passenger</p>
                                        </div>
                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">{{ $passengers }}</p>
                                        </div>
                                    </div>
                                    <div class="row w-100 p-0 m-0 mt-2">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">Total Amount</p>
                                        </div>
                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">₹{{ number_format($boat_price * $passengers, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center p-4 pb-2 d-none d-md-block">
                                <input class="btn proceedBtn" style="background: #0076ae; color:#FFF; width:100%" type="submit" value="Proceed to Payment">
                            </div>
                            
                            <!-- Mobile Payment Button inside popup -->
                            <div class="text-center p-3 d-block d-md-none">
                                <button class="btn mobile-proceed-payment" style="background: #0076ae; color:#FFF; width:100%; padding: 15px 20px; border-radius: 8px; border: none; font-size: 16px; font-weight: 600; box-shadow: 0 4px 12px rgba(0, 118, 174, 0.3);">
                                    <i class="bi bi-credit-card me-2"></i>Proceed to Payment
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        </div>

    </section>

</main>

<!-- SIMPLE MOBILE BUTTON -->
<div class="d-block d-md-none" style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 1000; padding: 15px; background: #008495;">
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
                    <div style="font-weight: bold; font-size: 18px;">₹ <span id="set_total_fare">{{ number_format($total_single_price ?? 0, 2) }}</span></div>
                </div>
            </div>
            
            <div class="summary-details" style="background: white; padding: 15px; border-radius: 5px;">
                <!-- Trip Details -->
                <div style="padding: 10px; margin-bottom: 10px; border-bottom: 1px solid #e0e0e0;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495; font-weight: bold;">Onwards: {{ date('d-m-Y', strtotime($booking_data['date'])) }}</span>
                        <span style="color: #008495; font-weight: bold;">{{ $trip1['ship_name'] }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="color: #008495; font-weight: bold;">{{ $booking_data['form_location'] == 1 ? 'Port Blair' : ($booking_data['form_location'] == 2 ? 'Havelock' : 'Neil') }}</span>
                        <span style="color: #008495; font-weight: bold;">{{ $booking_data['to_location'] == 1 ? 'Port Blair' : ($booking_data['to_location'] == 2 ? 'Havelock' : 'Neil') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
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
                </div>
                
                <!-- Booking Details -->
                <div style="margin-bottom: 10px;">
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
                </div>
                
                <!-- Total Fare -->
                <div style="background: #0f55cc; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between; font-weight: bold;">
                        <span>Total fare</span>
                        <span>INR {{ number_format($total_single_price ?? 0, 2) }}</span>
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
@endsection

@push('css')
<style>
/* Additional mobile fixes for boat booking - minimal overrides only */
@media only screen and (max-width: 767px) {
    /* Hide mobile button when popup is open */
    #mobilePopup:not([style*="display: none"]) ~ .d-block.d-md-none #showSummaryBtn,
    #mobilePopup[style*="display: block"] ~ .d-block.d-md-none #showSummaryBtn {
        display: none !important;
    }
}
@media only screen and (max-width: 767px) {
    /* Ensure mobile payment button is always visible */
    .d-block.d-md-none {
        display: block !important;
        position: relative;
        z-index: 10002 !important;
    }
    
    /* Ensure mobile summary section is visible */
    .mobile-summary-section {
        display: block !important;
        position: relative;
        z-index: 1000;
        min-height: 80px !important;
        height: auto !important;
    }
    
    .summery-btn {
        position: relative !important;
        z-index: 1000 !important;
        padding: 0 10px !important;
        margin-bottom: 20px !important;
        display: block !important;
        height: 60px !important;
        min-height: 60px !important;
    }
    
    .billMobile {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: fixed !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        z-index: 100000 !important;
        background: #008495 !important;
        color: white !important;
        border: none !important;
        padding: 15px 20px !important;
        font-size: 16px !important;
        font-weight: 600 !important;
        border-radius: 0 !important;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.3) !important;
        width: 100% !important;
        height: auto !important;
        min-height: 50px !important;
    }
    
    /* Prevent body scroll when popup is open */
    body.mobile-popup-open {
        overflow: hidden;
        position: fixed;
        width: 100%;
    }
}
</style>
@endpush

@push('js')


<script>
    // Function to close the mobile popup
    function closePageView() {
        $(".bookingSumBg").removeClass("show");
        $("#payment").removeClass("show");
        $("body").removeClass("mobile-popup-open");
        
        // Show the mobile summary section when popup is closed
        $(".mobile-summary-section").show();
    }
    
      $("#billMobile").click(function() {
            $(".bookingSumBg").addClass("show");
            $("#payment").addClass("show");
            $("body").addClass("mobile-popup-open");
            
            // Hide the mobile summary section when popup is open
            $(".mobile-summary-section").hide();
        });
        
        // Close popup when clicking on background
        $(".bookingSumBg").click(function(e) {
            if (e.target === this) {
                closePageView();
            }
        });
        
        // Add escape key functionality to close popup
        $(document).keyup(function(e) {
            if (e.keyCode == 27) { // Escape key
                closePageView();
            }
        });
    $('#boat_booking_form').on('submit', function(event) {
    document.querySelectorAll('span.text-danger').forEach(function(span) {
        span.innerHTML = '';
    });

    // Initialize variables
    let isValid = true;

    // Validate passenger fields
    const passengers = {{ $passengers }};
    for (let i = 1; i <= passengers; i++) {
        const title = document.querySelector(`select[name="passenger_title[${i}]"]`);
        const name = document.querySelector(`input[name="passenger_name[${i}]"]`);
        const dob = document.querySelector(`input[name="passenger_dob[${i}]"]`);
        const gender = document.querySelector(`select[name="passenger_gender[${i}]"]`);
        const nationality = document.querySelector(`select[name="passenger_nationality[${i}]"]`);

        if (!title.value) {
            document.querySelector(`select[name="passenger_title[${i}]"] + span.text-danger`).innerHTML = 'Title is required.';
            isValid = false;
        }
        if (!name.value.trim()) {
            document.querySelector(`input[name="passenger_name[${i}]"] + span.text-danger`).innerHTML = 'Name is required.';
            isValid = false;
        }
        if (!dob.value) {
            document.querySelector(`input[name="passenger_dob[${i}]"] + span.text-danger`).innerHTML = 'Age is required.';
            isValid = false;
        }
        if (!gender.value) {
            document.querySelector(`select[name="passenger_gender[${i}]"] + span.text-danger`).innerHTML = 'Gender is required.';
            isValid = false;
        }
        if (!nationality.value) {
            document.querySelector(`select[name="passenger_nationality[${i}]"] + span.text-danger`).innerHTML = 'Nationality is required.';
            isValid = false;
        }
    }

    // Validate contact details
    const cName = document.querySelector('input[name="c_name"]');
    const cEmail = document.querySelector('input[name="c_email"]');
    const cMobile = document.querySelector('input[name="c_mobile"]');
    const pContact = document.querySelector('input[name="p_contact"]');

    if (!cName.value.trim()) {
        document.querySelector('input[name="c_name"] + span.text-danger').innerHTML = 'Contact name is required.';
        isValid = false;
    }
    if (!cEmail.value.trim()) {
        document.querySelector('input[name="c_email"] + span.text-danger').innerHTML = 'Contact email is required.';
        isValid = false;
    } else if (!/\S+@\S+\.\S+/.test(cEmail.value.trim())) {
        document.querySelector('input[name="c_email"] + span.text-danger').innerHTML = 'Invalid email format.';
        isValid = false;
    }

    // Mobile number regex validation
    const mobileRegex = /^[0-9]{10}$/;
    if (!cMobile.value.trim()) {
        document.querySelector('input[name="c_mobile"] + span.text-danger').innerHTML = 'Contact mobile is required.';
        isValid = false;
    } else if (!mobileRegex.test(cMobile.value.trim())) {
        document.querySelector('input[name="c_mobile"] + span.text-danger').innerHTML = 'Invalid mobile number format.';
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    }
});

// $(document).on('click', ".proceedBtn", function(e) {
//     e.preventDefault();
//     // console.log('Avijit'); 
//     // return false;
//     @if (Session::get('user_id'))
//         $('#boat_booking_form').submit();
//     @else
//         $("#phoneVerificationModal").modal('show');
//     @endif

// });


// // after clickig login model procced button
// $(document).on('click', "#procced_button", function(e) {
//     e.preventDefault();
//     $('#boat_booking_form').submit();
// });

// var user_id = '';
// var otp = '';
// document.addEventListener('DOMContentLoaded', function() {
//     document.getElementById('sendOTPButton').addEventListener('click', function() {
//         var mobileNumber = document.getElementById('mobileNumber').value;
//         // Simulate sending OTP
//         // You should replace this with your actual OTP sending logic
//         // For demonstration purposes, we're just logging the mobile number and a generated OTP

//         var car_id = $(this).val();

//         if (!/^\d{10}$/.test(mobileNumber)) {
//             alert('Please enter a valid 10-digit mobile number.');
//             return;
//         }

//         $.ajax({
//             url: "{{ route('user_register') }}",
//             type: 'GET',
//             dataType: 'json',
//             data: {
//                 mobile_no: mobileNumber,
//             },
//             cache: false,
//             success: function(data) {
//                 if (data) {
//                     user_id = data.user_id;
//                     otp = data.otp;
//                     $('#get_user_id').val(user_id);

//                 } else {
//                     alert('User ID not found in the response');
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error("AJAX request failed:", status, error);
//             }
//         });


//         // Show OTP input field
//         document.getElementById('otpInput').style.display = 'block';
//         // Hide Send OTP button
//         document.getElementById('sendOTPButton').style.display = 'none';
//         // Show Verify OTP button
//         document.getElementById('verifyOTPButton').style.display = 'block';
//     });

//     document.getElementById('verifyOTPButton').addEventListener('click', function() {
//         var mobile_no = document.getElementById('mobileNumber').value;
//         var enteredOTP = document.getElementById('otp').value;

//         $.ajax({
//             url: "{{ route('verify_otp') }}",
//             type: 'GET',
//             dataType: 'json',
//             data: {
//                 mobile_no: mobile_no,
//                 enteredOTP: enteredOTP,
//             },
//             cache: false,
//             success: function(data) {
//                 if (data.success) {
//                     console.log('OTP verified successfully.');
//                     document.getElementById('otpInput').style.display = 'none';
//                     document.getElementById('verifyOTPButton').style.display = 'none';
//                     document.getElementById('not_matched').style.display = 'none';
//                     document.getElementById('otp_matched').style.display = 'block';
//                     document.getElementById('procced_button').style.display = 'block';

//                 } else {
//                     // Handle errors returned from the server
//                     console.log('Error:', data.error);
//                     document.getElementById('not_matched').style.display = 'block';

//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error("AJAX request failed:", status, error);
//             }
//         });
//     });
// });

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