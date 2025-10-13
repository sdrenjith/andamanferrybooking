@extends('layouts.app')

@section('title', 'Boat Booking Success')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="booking-info-card">
                <div class="card-header bg-success text-white text-center">
                    <h4><i class="fas fa-check-circle"></i> Boat Booking Confirmed!</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5 class="text-success">Payment Successful</h5>
                        <p class="text-muted">Your boat booking has been confirmed. Please save this confirmation for your records.</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Booking Details</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Booking ID:</strong></td>
                                    <td>{{ $booking->order_id }}</td>
                                </tr>
                                @if(isset($booking->boat))
                                <tr>
                                    <td><strong>Boat:</strong></td>
                                    <td>{{ $booking->boat }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><strong>Travel Date:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($booking->travel_date)->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Passengers:</strong></td>
                                    <td>{{ $booking->no_of_passengers }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Infants:</strong></td>
                                    <td>{{ $booking->infants ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Amount:</strong></td>
                                    <td class="fw-bold text-success">₹{{ number_format($booking->total_amount, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Customer Details</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $booking->customer_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Age:</strong></td>
                                    <td>{{ $booking->age ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $booking->customer_email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $booking->customer_phone }}</td>
                                </tr>
                                @if(isset($payment_id))
                                <tr>
                                    <td><strong>Payment ID:</strong></td>
                                    <td class="small">{{ $payment_id }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4">
                        <h6><i class="fas fa-info-circle"></i> Important Information</h6>
                        <ul class="mb-0">
                            <li>Please carry a valid ID proof during travel</li>
                            <li>Reach the departure point at least 30 minutes before departure</li>
                            <li>Check weather conditions before travel</li>
                            <li>A confirmation email has been sent to your registered email address</li>
                        </ul>
                    </div>

                    <div class="text-center mt-4 no-print" id="print-buttons">
                        <a href="{{ route('home') }}" class="btn btn-primary me-2">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                        <button onclick="printBookingInfo()" class="btn btn-outline-secondary">
                            <i class="fas fa-print"></i> Print Confirmation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function printBookingInfo() {
    // Create a clean copy of the booking card content without buttons
    var bookingCard = document.getElementById('booking-info-card').cloneNode(true);
    
    // Remove all no-print elements (buttons)
    var noPrintElements = bookingCard.querySelectorAll('.no-print');
    noPrintElements.forEach(function(element) {
        element.remove();
    });
    
    // Also remove elements with print-hide class for backward compatibility
    var printHideElements = bookingCard.querySelectorAll('.print-hide');
    printHideElements.forEach(function(element) {
        element.remove();
    });
    
    // Remove any elements with id print-buttons
    var printButtonsElement = bookingCard.querySelector('#print-buttons');
    if (printButtonsElement) {
        printButtonsElement.remove();
    }
    
    // Create clean print content
    var printContents = bookingCard.innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload();
}
</script>

<style>
@media print {
    html, body {
        height: auto !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow: hidden !important;
    }
    body * {
        visibility: hidden !important;
    }
    #booking-info-card, #booking-info-card * {
        visibility: visible !important;
    }
    #booking-info-card {
        position: absolute !important;
        left: 0; top: 0; width: 100vw;
        margin: 0 !important;
        box-shadow: none !important;
        border: none !important;
        page-break-after: avoid !important;
        page-break-before: avoid !important;
        page-break-inside: avoid !important;
    }
    .no-print, .print-hide, #print-buttons {
        display: none !important;
    }
    @page {
        size: auto;
        margin: 10mm;
    }
}
</style>
@endsection