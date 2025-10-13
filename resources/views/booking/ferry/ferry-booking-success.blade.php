{{-- resources/views/booking/ferry/ferry-booking-success.blade.php --}}
@extends('layouts.app')

@section('title', 'Ferry Booking Success')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header mt-5 bg-success text-white text-center">
                    <h4><i class="fas fa-check-circle"></i> Ferry Booking Confirmed!</h4>
                </div>
                <div class="card-body" id="ticket-area">
                    <div class="text-center mb-4">
                        <h5 class="text-success">Payment Successful</h5>
                        <p class="text-muted">Your ferry booking has been confirmed. Please save this confirmation for your records.</p>
                    </div>

                    {{-- First Page Content --}}
                    <div id="first-page-content">
                        {{-- Main Trip Details --}}
                        <div class="mb-4">
                            <h6 class="fw-bold border-bottom pb-2">Trip 1 Details</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Booking ID:</strong></td>
                                            <td>{{ $booking->order_id ?? $booking->id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ship:</strong></td>
                                            <td>{{ $booking->ship_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>From:</strong></td>
                                            <td>{{ $booking->from_location }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>To:</strong></td>
                                            <td>{{ $booking->to_location }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Travel Date:</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($booking->date_of_jurney)->format('d M, Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Departure:</strong></td>
                                            <td>{{ $booking->departure_time }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Arrival:</strong></td>
                                            <td>{{ $booking->arrival_time }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Class:</strong></td>
                                            <td>{{ $booking->ferry_class }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Passengers:</strong></td>
                                            <td>{{ $booking->no_of_passenger }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Amount:</strong></td>
                                            <td class="fw-bold text-success">₹{{ number_format($booking->amount, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Customer Details --}}
                        <div class="mb-4">
                            <h6 class="fw-bold border-bottom pb-2">Customer Details</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Name:</strong></td>
                                            <td>{{ $booking->c_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td>{{ $booking->c_email }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone:</strong></td>
                                            <td>{{ $booking->c_mobile }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    @if(isset($payment_id))
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Payment ID:</strong></td>
                                            <td class="small">{{ $payment_id }}</td>
                                        </tr>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Passenger Details --}}
                        @if(isset($passengers) && $passengers->count() > 0)
                        <div class="mb-4">
                            <h6 class="fw-bold border-bottom pb-2">Passenger Details</h6>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Name</th>
                                            <th>DOB</th>
                                            <th>Gender</th>
                                            <th>Nationality</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($passengers as $passenger)
                                        <tr>
                                            <td>{{ $passenger->title }}</td>
                                            <td>{{ $passenger->full_name }}</td>
                                            <td>{{ $passenger->dob }}</td>
                                            <td>{{ $passenger->gender }}</td>
                                            <td>{{ $passenger->resident }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        <div class="alert alert-info mt-4">
                            <h6><i class="fas fa-info-circle"></i> Important Information</h6>
                            <ul class="mb-0">
                                <li>Please carry a valid ID proof during travel</li>
                                <li>Reach the departure point at least 45 minutes before departure</li>
                                <li>Check weather conditions before travel</li>
                                <li>A confirmation email with your ticket has been sent to your registered email address</li>
                                <li>Please check-in online or at the counter before boarding</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Additional Trips Content --}}
                    <div id="additional-trips-content">
                        {{-- Trip 2 Details if exists --}}
                        @if(isset($trip2_booking) && $trip2_booking)
                        <div class="mb-4">
                            <h6 class="fw-bold border-bottom pb-2">Trip 2 Details (Return)</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Booking ID:</strong></td>
                                            <td>{{ $trip2_booking->order_id ?? $trip2_booking->id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ship:</strong></td>
                                            <td>{{ $trip2_booking->ship_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>From:</strong></td>
                                            <td>{{ $trip2_booking->from_location }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>To:</strong></td>
                                            <td>{{ $trip2_booking->to_location }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Travel Date:</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($trip2_booking->date_of_jurney)->format('d M, Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Departure:</strong></td>
                                            <td>{{ $trip2_booking->departure_time }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Arrival:</strong></td>
                                            <td>{{ $trip2_booking->arrival_time }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Class:</strong></td>
                                            <td>{{ $trip2_booking->ferry_class }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Amount:</strong></td>
                                            <td class="fw-bold text-success">₹{{ number_format($trip2_booking->amount, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Trip 3 Details if exists --}}
                        @if(isset($trip3_booking) && $trip3_booking)
                        <div class="mb-4">
                            <h6 class="fw-bold border-bottom pb-2">Trip 3 Details</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Booking ID:</strong></td>
                                            <td>{{ $trip3_booking->order_id ?? $trip3_booking->id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ship:</strong></td>
                                            <td>{{ $trip3_booking->ship_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>From:</strong></td>
                                            <td>{{ $trip3_booking->from_location }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>To:</strong></td>
                                            <td>{{ $trip3_booking->to_location }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Travel Date:</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($trip3_booking->date_of_jurney)->format('d M, Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Departure:</strong></td>
                                            <td>{{ $trip3_booking->departure_time }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Arrival:</strong></td>
                                            <td>{{ $trip3_booking->arrival_time }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Class:</strong></td>
                                            <td>{{ $trip3_booking->ferry_class }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Amount:</strong></td>
                                            <td class="fw-bold text-success">₹{{ number_format($trip3_booking->amount, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="text-center mt-4 no-print">
                        <a href="{{ route('home') }}" class="btn btn-primary me-2">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                        <button class="btn btn-success me-2" onclick="printFirstPage()">
                            <i class="fas fa-ticket-alt"></i> Download Ticket 
                        </button>
                        @if((isset($trip2_booking) && $trip2_booking) || (isset($trip3_booking) && $trip3_booking))
                        <button class="btn btn-outline-success" onclick="printAllPages()">
                            <i class="fas fa-download"></i> Download All Pages
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
.lds-spinner div:nth-child(1) { transform: rotate(0deg); animation-delay: -1.1s; }
.lds-spinner div:nth-child(2) { transform: rotate(30deg); animation-delay: -1s; }
.lds-spinner div:nth-child(3) { transform: rotate(60deg); animation-delay: -0.9s; }
.lds-spinner div:nth-child(4) { transform: rotate(90deg); animation-delay: -0.8s; }
.lds-spinner div:nth-child(5) { transform: rotate(120deg); animation-delay: -0.7s; }
.lds-spinner div:nth-child(6) { transform: rotate(150deg); animation-delay: -0.6s; }
.lds-spinner div:nth-child(7) { transform: rotate(180deg); animation-delay: -0.5s; }
.lds-spinner div:nth-child(8) { transform: rotate(210deg); animation-delay: -0.4s; }
.lds-spinner div:nth-child(9) { transform: rotate(240deg); animation-delay: -0.3s; }
.lds-spinner div:nth-child(10) { transform: rotate(270deg); animation-delay: -0.2s; }
.lds-spinner div:nth-child(11) { transform: rotate(300deg); animation-delay: -0.1s; }
.lds-spinner div:nth-child(12) { transform: rotate(330deg); animation-delay: 0s; }
@keyframes lds-spinner {
    0% { opacity: 1; }
    100% { opacity: 0; }
}

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
    #ticket-area, #ticket-area * {
        visibility: visible !important;
    }
    #ticket-area {
        position: absolute !important;
        left: 0; top: 0; width: 100vw;
        page-break-after: avoid !important;
        page-break-before: avoid !important;
        page-break-inside: avoid !important;
        max-height: 98vh;
        overflow: hidden !important;
    }
    .no-print {
        display: none !important;
    }
    /* Hide additional trips when printing first page only */
    .print-first-page-only #additional-trips-content {
        display: none !important;
    }
    @page {
        size: auto;
        margin: 10mm;
    }
}
</style>

<script>
function printFirstPage() {
    // Create a clean version of ticket content without buttons
    var ticketArea = document.getElementById('ticket-area').cloneNode(true);
    
    // Remove all no-print elements (buttons)
    var noPrintElements = ticketArea.querySelectorAll('.no-print');
    noPrintElements.forEach(function(element) {
        element.remove();
    });
    
    // Remove additional trips content
    var additionalTrips = ticketArea.querySelector('#additional-trips-content');
    if (additionalTrips) {
        additionalTrips.remove();
    }
    
    // Create print content
    var printContents = ticketArea.innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // reload to restore event handlers
}

function printAllPages() {
    // Create a clean version of ticket content without buttons
    var ticketArea = document.getElementById('ticket-area').cloneNode(true);
    
    // Remove all no-print elements (buttons)
    var noPrintElements = ticketArea.querySelectorAll('.no-print');
    noPrintElements.forEach(function(element) {
        element.remove();
    });
    
    // Create print content
    var printContents = ticketArea.innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // reload to restore event handlers
}

// For backward compatibility, keep the original function but make it print first page by default
function printTicketArea() {
    printFirstPage();
}
</script>
@endsection