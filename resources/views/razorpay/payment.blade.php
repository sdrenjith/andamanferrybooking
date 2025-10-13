{{-- resources/views/razorpay/payment.blade.php --}}
@extends('layouts.app')
@section('content')
<input type="hidden" name="order_id" id="order_id" value="{{$order_id}}">

<div class="text-center my-5 pt-5" style="margin-top: 80px; margin-bottom: 80px;">
    <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    <p class="mt-3">Processing payment...</p>
</div>

@php
    $type = request('type', 'boat');
    if ($type === 'boat') {
        $orderIdSession = $order_id ?? '';
        $amount = $amount ?? '';
        $userName = $customer_name ?? '';
        $userEmail = $customer_email ?? '';
        $userPhone = $customer_phone ?? '';
    } else {
        $orderIdSession = Session::get('order_id');
        $amount = Session::get('total_amount') ?? Session::get('amount');
        $userName = Session::get('user_name');
        $userEmail = Session::get('user_email');
        $userPhone = Session::get('user_phone');
    }
@endphp

@if(($type === 'boat' && $orderIdSession && $amount) || ($type === 'ferry' && (Session::has('total_amount') || Session::has('amount'))))
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var orderIdSession = "{{ $orderIdSession ?? '' }}";
        var amount = "{{ $amount ?? '' }}";
        var key = "{{env('RAZOR_KEY_ID')}}";
        var type = "{{ $type }}";
        if (amount && parseFloat(amount) > 0) {
            amount = Math.round(parseFloat(amount) * 100);
        }
        if (!key || !orderIdSession || !amount || amount <= 0) {
            alert('Payment session expired or invalid. Please try booking again.');
            if (type === 'boat') {
                window.location.href = '/boat-booking';
            } else {
                window.location.href = '/ferry-booking';
            }
        } else {
            var options = {
                "key": key,
                "amount": amount,
                "currency": "INR",
                "name": "Andaman Ferry Booking",
                "description": type === 'boat' ? "Boat Booking" : "Ferry Booking",
                "image": "{{ url('assets/images/logo.png') }}",
                "order_id": orderIdSession,
                "callback_url": "{{ url('/payment-response') }}/" + orderIdSession + "?type=" + type,
                "prefill": {
                    "name": "{{ $userName ?? '' }}",
                    "email": "{{ $userEmail ?? '' }}",
                    "contact": "{{ $userPhone ?? '' }}"
                },
                "notes": {
                    "address": "Andaman Ferry Booking",
                    "booking_type": type
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            options.modal = {
                ondismiss: function() {
                    if (type === 'boat') {
                        window.location.href = '/boat-booking';
                    } else {
                        window.location.href = '/ferry-booking';
                    }
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function(response) {
                var errorMsg = response.error && response.error.description ? response.error.description : 'Your payment could not be completed.';
                // Notify backend to mark booking as failed
                $.ajax({
                    url: '/payment-failed/' + orderIdSession,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    complete: function() {
                        // Hide spinner
                        $('.lds-spinner').hide();
                        // Set error message
                        $('#paymentFailedMsg').text(errorMsg);
                        // Show modal
                        var modal = new bootstrap.Modal(document.getElementById('paymentFailedModal'));
                        modal.show();
                        // Retry button
                        $('#retryPaymentBtn').off('click').on('click', function() {
                            location.reload();
                        });
                        // Return to booking button
                        $('#returnBookingBtn').off('click').on('click', function() {
                            if (type === 'boat') {
                                window.location.href = '/boat-booking';
                            } else {
                                window.location.href = '/ferry-booking';
                            }
                        });
                    }
                });
            });
            $(document).ready(function() {
                rzp1.open();
            });
        }
    </script>
    
    <style>
    .razorpay-container #razorpay-modal-close {
        display: none !important;
    }
    
    .lds-spinner {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }
    .lds-spinner div {
        transform-origin: 40px 40px;
        animation: lds-spinner 1.2s linear infinite;
    }
    .lds-spinner div:after {
        content: " ";
        display: block;
        position: absolute;
        top: 3px;
        left: 37px;
        width: 6px;
        height: 18px;
        border-radius: 20%;
        background: #3399cc;
    }
    .lds-spinner div:nth-child(1) {
        transform: rotate(0deg);
        animation-delay: -1.1s;
    }
    .lds-spinner div:nth-child(2) {
        transform: rotate(30deg);
        animation-delay: -1s;
    }
    .lds-spinner div:nth-child(3) {
        transform: rotate(60deg);
        animation-delay: -0.9s;
    }
    .lds-spinner div:nth-child(4) {
        transform: rotate(90deg);
        animation-delay: -0.8s;
    }
    .lds-spinner div:nth-child(5) {
        transform: rotate(120deg);
        animation-delay: -0.7s;
    }
    .lds-spinner div:nth-child(6) {
        transform: rotate(150deg);
        animation-delay: -0.6s;
    }
    .lds-spinner div:nth-child(7) {
        transform: rotate(180deg);
        animation-delay: -0.5s;
    }
    .lds-spinner div:nth-child(8) {
        transform: rotate(210deg);
        animation-delay: -0.4s;
    }
    .lds-spinner div:nth-child(9) {
        transform: rotate(240deg);
        animation-delay: -0.3s;
    }
    .lds-spinner div:nth-child(10) {
        transform: rotate(270deg);
        animation-delay: -0.2s;
    }
    .lds-spinner div:nth-child(11) {
        transform: rotate(300deg);
        animation-delay: -0.1s;
    }
    .lds-spinner div:nth-child(12) {
        transform: rotate(330deg);
        animation-delay: 0s;
    }
    @keyframes lds-spinner {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    </style>
    <!-- Payment Failure Modal -->
    <div class="modal fade" id="paymentFailedModal" tabindex="-1" aria-labelledby="paymentFailedModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="paymentFailedModalLabel">Payment could not be completed</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
              <p class="mt-3 mb-0" id="paymentFailedMsg">Your payment was not successful. Please try again or contact support if the issue persists.</p>
            </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-primary" id="retryPaymentBtn">Retry Payment</button>
            <button type="button" class="btn btn-secondary" id="returnBookingBtn">Return to Booking</button>
          </div>
        </div>
      </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@else
    <div class="text-center" style="margin-top: 80px; margin-bottom: 80px;">
        <div class="alert alert-danger mx-auto" style="max-width: 500px;">
            <h5>Session Expired</h5>
            <p>Your booking session has expired. Please start a new booking.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
        </div>
    </div>
@endif
@endsection