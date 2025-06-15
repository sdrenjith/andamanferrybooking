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
                <input type="hidden" name="boat_name" value="{{ $boat_datas->title }}">


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
                                            {{ $boat_datas->title }}
                                        </div>
                                    </div>
                                    <div class="row w-100 p-0 m-0 mt-2">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">Amount/Prerson</p>
                                        </div>
                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">{{ $boat_price }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row w-100 p-0 m-0 mt-2">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">No of Passenger</p>
                                        </div>
                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">{{ $passengers }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row w-100 p-0 m-0 mt-2">
                                        <div class="departing-txt m-0 col-6 p-0">
                                            <p class="departing-txt-date m-0">Total Amount</p>
                                        </div>
                                        <div class="col-6 p-0 departing-txt">
                                            <p class="departing-txt-date d-inline-block m-0">
                                                {{ $boat_price * $passengers }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center p-4 pb-2">
                                <input class="btn proceedBtn" style="background: #0076ae; color:#FFF; width:100%" type="submit" value="Proceed to Payment">
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        </div>

    </section>

</main>

<div class="bookingSumBg"></div>
<button class="btn btn-primary billMobile" id="billMobile">
        Show Summary
</button>
@endsection

@push('js')


<script>
      $("#billMobile").click(function() {
            $(".bookingSumBg").toggleClass("show");
            $("#payment").toggleClass("show");
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