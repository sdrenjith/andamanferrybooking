@extends('layouts.app')
@section('content')
<style>
    body {
      text-align: center;
      padding: 20px 0;
      background: #EBF0F5;
    }
    h1 {
      color: #88B04B;
      font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
      font-weight: 900;
      font-size: 40px;
      margin-bottom: 10px;
    }
    p {
      color: #404F5E;
      font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
      font-size: 20px;
      margin: 0;
    }
    .checkmark {
      color: #9ABC66;
      font-size: 100px;
      line-height: 200px;
      margin-left: -15px;
    }
    .card {
      background: white;
      padding: 40px;
      border-radius: 4px;
      box-shadow: 0 2px 3px #C8D0D8;
      display: inline-block;
      margin: 120px 0px 65px 0px;
    }
    .error-msg {
      color: #d9534f;
      font-size: 14px;
      margin-top: 10px;
    }
</style>

<div class="card">
    <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
    </div>
    <h1>Payment Successful!</h1>
    
    <p>We received your payment successfully. Thank You!</p>
    
    @if(isset($transaction_id))
        <p class="mt-2"><strong>Transaction ID:</strong> {{ $transaction_id }}</p>
    @endif
    
    @if(isset($booking) && $booking)
        <p class="mt-2"><strong>Booking Reference:</strong> #{{ $booking->id }}</p>
        <p><strong>Amount Paid:</strong> ₹{{ number_format($booking->amount, 2) }}</p>
        <p><strong>Journey Date:</strong> {{ date('d M Y', strtotime($booking->date_of_jurney)) }}</p>
        
        @if($booking->type == 'ferry')
            <p><strong>Ship:</strong> {{ $booking->ship_name ?? 'N/A' }}</p>
            <p><strong>Route:</strong> 
                @php
                    $from = '';
                    $to = '';
                    if($booking->from_location == 1) $from = 'Port Blair';
                    elseif($booking->from_location == 2) $from = 'Swaraj Dweep';
                    elseif($booking->from_location == 3) $from = 'Shaheed Dweep';
                    
                    if($booking->to_location == 1) $to = 'Port Blair';
                    elseif($booking->to_location == 2) $to = 'Swaraj Dweep';
                    elseif($booking->to_location == 3) $to = 'Shaheed Dweep';
                @endphp
                {{ $from }} to {{ $to }}
            </p>
        @endif
    @endif
    
    <div class="mt-5">
        @if(isset($booking_id) && $booking_id)
            <form action="{{ url('/ticket_generate') }}" method="post" target="_blank" style="display: inline-block;">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking_id }}">
                <input type="hidden" name="trip2_booking_id" value="{{ $trip2_booking_id ?? '' }}">
                <input type="hidden" name="trip3_booking_id" value="{{ $trip3_booking_id ?? '' }}">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-download"></i> Download Ticket
                </button>
            </form>
        @else
            <div class="error-msg">
                <p>Ticket information is being processed. Please check your email for booking confirmation.</p>
                <p>If you don't receive an email within 10 minutes, please contact support with your transaction ID.</p>
            </div>
        @endif
        
        <a href="{{ route('home') }}" class="btn btn-primary ml-2">
            <i class="fas fa-home"></i> Go to Home
        </a>
        
        @if(Auth::check())
            <a href="{{ url('/my-bookings') }}" class="btn btn-info ml-2">
                <i class="fas fa-list"></i> My Bookings
            </a>
        @endif
    </div>
    
    <div class="mt-4" style="font-size: 14px; color: #666;">
        <p><i class="fas fa-info-circle"></i> A confirmation email has been sent to your registered email address.</p>
        <p>For any queries, please contact our support team.</p>
    </div>
</div>

<script>
    // Auto-submit ticket download after 2 seconds if booking_id exists
    document.addEventListener('DOMContentLoaded', function() {
        @if(isset($booking_id) && $booking_id)
            setTimeout(function() {
                var ticketForm = document.querySelector('form[action*="ticket_generate"]');
                if (ticketForm) {
                    // Uncomment the line below to enable auto-download
                    // ticketForm.submit();
                }
            }, 2000);
        @endif
    });
</script>

@endsection