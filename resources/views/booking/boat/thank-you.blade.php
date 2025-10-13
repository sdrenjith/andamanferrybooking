@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 p-4 text-center">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                </div>
                <h2 class="fw-bold mb-3">Thank You for Your Booking!</h2>
                <p class="lead mb-4">Your boat booking has been received. We will contact you soon with further details.</p>
                <div class="mb-3">
                    <strong>Booking Details:</strong><br>
                    <span>Boat: {{ $booking->boat }}</span><br>
                    <span>Travel Date: {{ $booking->travel_date }}</span><br>
                    <span>Passengers: {{ $booking->no_of_passengers }}</span><br>
                    <span>Infants: {{ $booking->infants }}</span><br>
                    <span>Total Amount: ₹{{ number_format($booking->total_amount, 2) }}</span><br>
                </div>
                <a href="/" class="btn btn-primary mt-3">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection 