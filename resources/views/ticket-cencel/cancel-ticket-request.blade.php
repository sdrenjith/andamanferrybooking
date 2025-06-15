@extends('layouts.app')

@section('content')
    <div class="row secHead my-5 w-100">
        <div class="col-12 text-center subPage">
            <h2>Cancel Ticket</h2>
        </div>
    </div>
    
    @if (session('msg'))
        <div class="alert alert-danger text-center">
            {{ session('msg') }}
        </div>
    @endif

    <form action="{{ url('/ticket-cancellation-preview') }}" method="post">
        @csrf
        <div class="container ">
            <div class="row justify-content-center mt-5">

                    <div class="col-12 col-md-8 col-lg-2 text-center">
                        
                        <div id="pnr_id">
                            <input type="tel" name="pnr_id" class="form-control" placeholder="Enter PNR Id/Booking Id" value="{{ old('pnr_id') }}">
                            <span id="bookingError" class="error-message"></span>
                        </div>
                    </div>
                    
                    
              
            </div>
         
            <div class="row justify-content-center mt-3">
                <div class="col-12 col-md-8 col-lg-4 bannerBtns text-center d-block">
                    <button class="btn m-auto " style="width: 110px; height: 40px; background:#0076ae; color:#FFF">SUBMIT</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="js/script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var bookingIdInput = document.getElementById('booking_id');
            var phoneNumberInput = document.getElementById('phone_number');
            var bookingErrorSpan = document.getElementById('bookingError');
            var phoneNumberErrorSpan = document.getElementById('phoneNumberError');

            function empty(input) {
                return input.value.trim() === "";
            }

            function isValidBookingId(input, errorSpan) {
                var isValid = /^[A-Z]{6,}$/.test(input.value);
                if (!isValid) {
                    errorSpan.textContent = 'Please enter a valid PNR ID.';
                } else {
                    errorSpan.textContent = '';
                }
                return isValid;
            }

            function isValidPhoneNumber(input, errorSpan) {
                var isValid = /^[0-9]{10}$/.test(input.value);
                if (!isValid) {
                    errorSpan.textContent = 'Please enter a valid Phone Number.';
                } else {
                    errorSpan.textContent = '';
                }
                return isValid;
            }

            bookingIdInput.addEventListener('input', function(event) {
                if (empty(this)) {
                    bookingErrorSpan.textContent = 'Please enter PNR ID.';
                } else {
                    isValidBookingId(this, bookingErrorSpan);
                }
            });

            phoneNumberInput.addEventListener('input', function(event) {
                if (empty(this)) {
                    phoneNumberErrorSpan.textContent = 'Please enter Phone Number.';
                } else {
                    isValidPhoneNumber(this, phoneNumberErrorSpan);
                }
            });
            document.querySelector('form').addEventListener('submit', function(event) {
                var isFormValid = true;

                if (empty(bookingIdInput)) {
                    bookingErrorSpan.textContent = 'Please enter PNR ID.';
                    isFormValid = false;
                } else if (!isValidBookingId(bookingIdInput, bookingErrorSpan)) {
                    isFormValid = false;
                }

                if (empty(phoneNumberInput)) {
                    phoneNumberErrorSpan.textContent = 'Please enter Phone Number.';
                    isFormValid = false;
                } else if (!isValidPhoneNumber(phoneNumberInput, phoneNumberErrorSpan)) {
                    isFormValid = false;
                }

                if (!isFormValid) {
                    event.preventDefault();
                }
            });
        });

        $(document).ready(function() {
            $(document).on('change', "#cancel_for_ferry", function(e) {
                if ($(this).is(':checked')) {
                    $('#booking_id').hide();
                    $('#booking_id input').val('');  // Clear the input field inside #booking_id
                    $('#pnr_id').show();
                }
            });
            
            $(document).on('change', "#cancel_for_boat", function(e) {
                if ($(this).is(':checked')) {
                    $('#pnr_id').hide();
                    $('#pnr_id input').val('');  // Clear the input field inside #pnr_id
                    $('#booking_id').show();
                }
            });
        });


    </script>
@endpush
