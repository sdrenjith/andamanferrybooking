@extends('layouts.app')

@section('content')
@php
    // Debug output to see what is in $data
    // Remove or comment this after debugging
    // dd($data);
    $boatName = $data['boat_name'] ?? '-';
    $boatPrice = $data['boat_price'] ?? 0;
    $passengers = $data['passengers'] ?? 1;
    $infants = $data['infants'] ?? 0;
    $totalAmount = $boatPrice * $passengers;
@endphp
<div class="container " style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12">
            <div class="card shadow-lg border-0 rounded-4 p-4 mt-5 mb-5" style="max-width: 100%; margin-left: auto; margin-right: auto;">
                <h2 class="fw-bold mb-4 text-center">Booking Details</h2>
                <div class="row mb-4">
                    <div class="col-md-7 mb-3 mb-md-0">
                        <div class="border rounded-3 p-3 h-100">
                            <h5 class="fw-semibold mb-3">Passenger & Booking Info</h5>
                            <div><strong>Boat:</strong> {{ $boatName }}</div>
                            <div><strong>Travel Date:</strong> {{ $data['date_of_jurney'] ?? ($data['date'] ?? '-') }}</div>
                            <div><strong>Passengers:</strong> {{ $passengers }}</div>
                            <div><strong>Infants:</strong> {{ $infants }}</div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <h5 class="fw-bold mb-3 text-center">BOOKING SUMMARY</h5>
                            <div class="mb-2"><strong>Boat:</strong> {{ $boatName }}</div>
                            <div class="mb-2"><strong>Date:</strong> {{ $data['date_of_jurney'] ?? ($data['date'] ?? '-') }}</div>
                            <div class="mb-2"><strong>No. of Passengers:</strong> {{ $passengers }}</div>
                            <div class="mb-2"><strong>Infants:</strong> {{ $infants }}</div>
                            <div class="mb-2"><strong>Per Passenger Price:</strong> ₹{{ number_format($boatPrice, 2) }}</div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Total fare</span>
                                <span class="fw-bold text-primary">₹{{ number_format($totalAmount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Contact Details: always full width below -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="border rounded-3 p-3 h-100">
                            <h5 class="fw-semibold mb-3">Contact Details</h5>
                            <div><strong>Name:</strong> {{ $data['customer_name'] }}</div>
                            <div><strong>Email:</strong> {{ $data['customer_email'] }}</div>
                            <div><strong>Phone:</strong> {{ $data['customer_phone'] }}</div>
                            <div><strong>Age:</strong> {{ $data['age'] ?? '-' }}</div>
                            <div><strong>Gender:</strong> {{ $data['gender'] ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                <form id="ajaxBoatBookingForm">
                    @csrf
                    <input type="hidden" name="boat_name" value="{{ $boatName }}">
                    <input type="hidden" name="date_of_jurney" value="{{ $data['date_of_jurney'] ?? $data['date'] }}">
                    <input type="hidden" name="no_of_passenger" value="{{ $passengers }}">
                    <input type="hidden" name="infants" value="{{ $infants }}">
                    <input type="hidden" name="amount" value="{{ $totalAmount }}">
                    <input type="hidden" name="customer_name" value="{{ $data['customer_name'] }}">
                    <input type="hidden" name="customer_email" value="{{ $data['customer_email'] }}">
                    <input type="hidden" name="customer_phone" value="{{ $data['customer_phone'] }}">
                    <input type="hidden" name="age" value="{{ $data['age'] ?? '' }}">
                    <input type="hidden" name="gender" value="{{ $data['gender'] ?? '' }}">
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold mt-4" id="ajaxProceedToPayment">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    $('#ajaxBoatBookingForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/ajax/boat-booking',
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val() || $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success && response.order_id) {
                    window.location.href = '/boat-payment/' + response.order_id;
                } else {
                    alert('Booking could not be completed. Please try again.');
                }
            },
            error: function(xhr) {
                alert('Booking could not be completed. Please check your details and try again.');
            }
        });
    });
});
</script>
@endsection 