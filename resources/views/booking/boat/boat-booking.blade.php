@extends('layouts.app')

@section('title', 'Andaman Ferry Booking Online | Fast & Easy Boat Booking')
@section('meta_title', 'Andaman Ferry Booking Online | Fast & Easy Boat Booking')
@section('meta_description', 'Book your Andaman ferry online with ease. Fast, secure, and reliable boat booking for Havelock, Neil Island, and more. Reserve your seat today')

@section('content')
<!-- Modern Hero Banner for Boat Booking -->
<div class="modern-hero">
    <div class="hero-content">
        <h1>Book Your Boat Adventure</h1>
        <p>Seamless, secure, and simple boat booking for your Andaman journey</p>
    </div>
</div>

<div class="homepage-pattern-bg">
    <!-- Hero Section with Booking Form -->
    <section class="py-5" >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <!-- Header Text -->
                    <div class="text-center text-white mb-5">
                        <h1 class="display-5 fw-bold mb-3" style="color: rgba(0,172,193,0.92)">Book Your Perfect Boat Experience</h1>
                        <p class="lead mb-0 opacity-90 " style="color: rgba(0,172,193,0.92)" >Explore the pristine waters of Andaman with our premium boat services</p>
                    </div>
                    
                    <!-- Booking Card -->
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 56px; height: 56px;">
                                    <i class="bi bi-boat fs-2 text-primary"></i>
                                </div>
                                <div>
                                    <h2 class="fw-bold mb-1" style="color: #0097a7;">Book a Boat in Andaman</h2>
                                    <p class="text-muted mb-0">Private charters & speed boats for island hopping</p>
                                </div>
                            </div>
                            
                            <form id="boatBookingForm" action="{{ url('/booking-boat') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    <!-- Boat Selection -->
                                    <div class="col-12 col-md-6">
                                        <label for="boat" class="form-label fw-semibold text-dark mb-2">
                                            <i class="bi bi-boat me-2 text-primary"></i>Select Boat
                                        </label>
                                        <select name="boat_name" class="form-select form-select-lg border-0 shadow-sm rounded-3" id="boat" style="background-color: #f8f9fa;">
                                            @foreach ($boat_lists as $boat_list)
                                            <option value="{{ $boat_list->name }}" data-price="{{ $boat_list->price }}">
                                                {{ $boat_list->name }} - {{ number_format($boat_list->price, 0) }}/-
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <!-- Date Selection -->
                                    <div class="col-12 col-md-6">
                                        <label for="boat_date" class="form-label fw-semibold text-dark mb-2">
                                            <i class="bi bi-calendar-event me-2 text-primary"></i>Travel Date
                                        </label>
                                        <div class="input-group input-group-lg position-relative">
                                            <input type="date" class="form-control form-control-lg border-0 shadow-sm rounded-3" 
                                                   id="boat_date" name="date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                                   style="background-color: #f8f9fa;" required>
                                        </div>
                                        <small class="text-muted">Click to open calendar</small>
                                    </div>
                                    
                                    <!-- Passengers -->
                                    <div class="col-12 col-md-6">
                                        <label for="passengers" class="form-label fw-semibold text-dark mb-2">
                                            <i class="bi bi-people me-2 text-primary"></i>Passengers
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <button class="btn btn-outline-secondary rounded-start-3 border-0" type="button" 
                                                    onclick="changeValue('passengers', -1)" style="background-color: #f8f9fa;">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <input type="number" class="form-control text-center border-0 shadow-sm" 
                                                   id="passengers" name="passengers" value="1" min="1" max="20" readonly
                                                   style="background-color: #f8f9fa;">
                                            <button class="btn btn-outline-secondary rounded-end-3 border-0" type="button" 
                                                    onclick="changeValue('passengers', 1)" style="background-color: #f8f9fa;">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Infants -->
                                    <div class="col-12 col-md-6">
                                        <label for="infants" class="form-label fw-semibold text-dark mb-2">
                                            <i class="bi bi-heart me-2 text-primary"></i>Infants
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <button class="btn btn-outline-secondary rounded-start-3 border-0" type="button" 
                                                    onclick="changeValue('infants', -1)" style="background-color: #f8f9fa;">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <input type="number" class="form-control text-center border-0 shadow-sm" 
                                                   id="infants" name="infants" value="0" min="0" max="5" readonly
                                                   style="background-color: #f8f9fa;">
                                            <button class="btn btn-outline-secondary rounded-end-3 border-0" type="button" 
                                                    onclick="changeValue('infants', 1)" style="background-color: #f8f9fa;">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Customer Details -->
                                    <div class="row g-4">
                                        <div class="col-12 col-md-4">
                                            <label for="customer_name" class="form-label fw-semibold text-dark mb-2">
                                                <i class="bi bi-person me-2 text-primary"></i>Full Name
                                            </label>
                                            <input type="text" class="form-control form-control-lg border-0 shadow-sm rounded-3" id="customer_name" name="customer_name" required placeholder="Enter your name">
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="age" class="form-label fw-semibold text-dark mb-2">
                                                <i class="bi bi-calendar me-2 text-primary"></i>Age
                                            </label>
                                            <input type="number" class="form-control form-control-lg border-0 shadow-sm rounded-3" id="age" name="age" min="1" max="120" required placeholder="Age">
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="gender" class="form-label fw-semibold text-dark mb-2">
                                                <i class="bi bi-gender-ambiguous me-2 text-primary"></i>Gender
                                            </label>
                                            <select class="form-control form-control-lg border-0 shadow-sm rounded-3" id="gender" name="gender" required>
                                                <option value="">Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-4 mt-1">
                                        <div class="col-12 col-md-6">
                                            <label for="customer_email" class="form-label fw-semibold text-dark mb-2">
                                                <i class="bi bi-envelope me-2 text-primary"></i>Email
                                            </label>
                                            <input type="email" class="form-control form-control-lg border-0 shadow-sm rounded-3" id="customer_email" name="customer_email" required placeholder="Enter your email">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="customer_phone" class="form-label fw-semibold text-dark mb-2">
                                                <i class="bi bi-telephone me-2 text-primary"></i>Phone
                                            </label>
                                            <input type="tel" class="form-control form-control-lg border-0 shadow-sm rounded-3" id="customer_phone" name="customer_phone" required placeholder="Enter your phone number">
                                        </div>
                                    </div>
                                    
                                    <!-- Search Button -->
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-lg w-100 fw-bold text-white rounded-3 shadow-sm py-3" 
                                                style="background: linear-gradient(135deg, #00acc1 0%, #0097a7 100%); border: none; transition: all 0.3s ease;"
                                                id="bookNowBtn">
                                            <i class="bi bi-credit-card me-2"></i>Book Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Indicators -->
    <section class="py-4" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="row text-center g-4">
                        <div class="col-6 col-md-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span class="fw-semibold text-dark">Instant Confirmation</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-headset text-primary me-2"></i>
                                <span class="fw-semibold text-dark">24/7 Support</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-shield-check text-success me-2"></i>
                                <span class="fw-semibold text-dark">Best Price Guarantee</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-warning me-2">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="fw-semibold text-dark">4.9/5 Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3 Steps Process Section (replaced) -->
    <section class="py-5" style="background: linear-gradient(135deg, #00bcd4 0%, #0097a7 100%);">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-12 text-center">
                    <span class="badge bg-white bg-opacity-25 text-white px-4 py-2 rounded-pill fw-semibold mb-3" style="font-size: 1.1rem; letter-spacing: 1px;">
                        ✨ SIMPLE &amp; FAST
                    </span>
                    <h2 class="fw-bold text-white mb-2" style="font-size: 2.5rem;">The Simplest Process Ever.<br>Book Ferry in 3 Steps.</h2>
                    <p class="lead text-white-50 mb-0" style="max-width: 600px; margin: 0 auto;">Experience seamless ferry booking with our streamlined process designed for your convenience</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-4">
                    <div class="bg-white bg-opacity-10 rounded-4 p-4 h-100 text-center position-relative" style="backdrop-filter: blur(2px); border: 1px solid rgba(255,255,255,0.12);">
                        <div class="position-relative d-inline-block mb-3">
                            <span class="d-flex align-items-center justify-content-center bg-white rounded-circle mx-auto" style="width: 70px; height: 70px; font-size: 2.2rem; color: #0097a7;">
                                <i class="bi bi-search"></i>
                            </span>
                            <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-warning" style="font-size: 1rem;">1</span>
                        </div>
                        <h5 class="fw-bold text-white mb-2">Search</h5>
                        <p class="text-white-50 mb-0">We'll help you find the right timings and best rates to help you make the most of your trip. Compare options instantly.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="bg-white bg-opacity-10 rounded-4 p-4 h-100 text-center position-relative" style="backdrop-filter: blur(2px); border: 1px solid rgba(255,255,255,0.12);">
                        <div class="position-relative d-inline-block mb-3">
                            <span class="d-flex align-items-center justify-content-center bg-white rounded-circle mx-auto" style="width: 70px; height: 70px; font-size: 2.2rem; color: #0097a7;">
                                <i class="bi bi-check2-square"></i>
                            </span>
                            <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-warning" style="font-size: 1rem;">2</span>
                        </div>
                        <h5 class="fw-bold text-white mb-2">Book</h5>
                        <p class="text-white-50 mb-0">Book your favorite from the largest selection of ferries and avoid any sneaky processing fees. You pay what you see!</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="bg-white bg-opacity-10 rounded-4 p-4 h-100 text-center position-relative" style="backdrop-filter: blur(2px); border: 1px solid rgba(255,255,255,0.12);">
                        <div class="position-relative d-inline-block mb-3">
                            <span class="d-flex align-items-center justify-content-center bg-white rounded-circle mx-auto" style="width: 70px; height: 70px; font-size: 2.2rem; color: #0097a7;">
                                <i class="bi bi-emoji-smile"></i>
                            </span>
                            <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-warning" style="font-size: 1rem;">3</span>
                        </div>
                        <h5 class="fw-bold text-white mb-2">Sail</h5>
                        <p class="text-white-50 mb-0">You'll find that travelers love how we manage their bookings. We're reachable, available and here to help. Sail away without worry!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function changeValue(inputId, change) {
    const input = document.getElementById(inputId);
    const currentValue = parseInt(input.value);
    const newValue = currentValue + change;
    const min = parseInt(input.getAttribute('min'));
    const max = parseInt(input.getAttribute('max'));
    
    if (newValue >= min && newValue <= max) {
        input.value = newValue;
    }
}

function getSelectedBoatPrice() {
    var selected = document.getElementById('boat').selectedOptions[0];
    return parseInt(selected.getAttribute('data-price')) || 0;
}

function getSelectedBoatName() {
    var selected = document.getElementById('boat').selectedOptions[0];
    return selected.value;
}

$(document).ready(function() {
    // Set default date to tomorrow
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowString = tomorrow.toISOString().split('T')[0];
    $('#boat_date').attr('min', tomorrowString);
    if (!$('#boat_date').val()) {
        $('#boat_date').val(tomorrowString);
    }

    $('#boatBookingForm').on('submit', function(e) {
        if (!$('#boat_date').val()) {
            alert('Please select a travel date.');
            $('#boat_date').focus();
            e.preventDefault();
        }
    });

    // Add click handler for debugging
    $('#boat_date').on('click', function() {
        console.log('Date input clicked');
        console.log('Current value:', $(this).val());
    });

    $('#bookNowBtn').on('click', function(e) {
        e.preventDefault();
        var price = getSelectedBoatPrice();
        var boatName = getSelectedBoatName();
        var date = $('#boat_date').val();
        var passengers = parseInt($('#passengers').val()) || 1;
        var total = price * passengers;
        $('#amount').val(total);
        $('#boat_name').val(boatName);
        $('#date_of_jurney').val(date);
        $('#no_of_passenger').val(passengers);
        $('#boatBookingForm').submit();
    });
});
</script>

<style>
.step-number {
    transition: all 0.3s ease;
}

.step-number:hover {
    transform: scale(1.1);
}

.form-control:focus, .form-select:focus {
    border-color: #0097a7;
    box-shadow: 0 0 0 0.2rem rgba(0, 151, 167, 0.25);
}

.btn:hover {
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .display-5 {
        font-size: 2rem;
    }
    
    .display-6 {
        font-size: 1.5rem;
    }
}

.modern-hero {
    position: relative;
    background: linear-gradient(135deg, rgba(0,172,193,0.92), rgba(0,151,167,0.85)), url('/assets/images/boat-hero-bg.jpg') center/cover;
    min-height: 45vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.modern-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.03) 50%, transparent 70%);
    animation: shimmer 3s infinite;
}
@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
.hero-content {
    text-align: center;
    z-index: 2;
    position: relative;
}
.hero-content h1 {
    font-size: 3rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 1rem;
    text-shadow: 0 4px 20px rgba(0,0,0,0.2);
    animation: slideInUp 0.8s ease-out;
}
.hero-content p {
    font-size: 1.25rem;
    color: rgba(255,255,255,0.92);
    max-width: 600px;
    margin: 0 auto;
    animation: slideInUp 0.8s ease-out 0.2s both;
}
@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
@media (max-width: 768px) {
    .hero-content h1 { font-size: 2rem; }
    .hero-content p { font-size: 1rem; }
    .modern-hero { min-height: 30vh; }
}

.btn-outline-secondary:hover, .btn-outline-secondary:focus {
    background-color: #00acc1 !important;
    color: #fff !important;
    border-color: #00acc1 !important;
}
.btn-outline-secondary:hover i, .btn-outline-secondary:focus i {
    color: #fff !important;
}

/* Flatpickr calendar positioning and z-index fixes */
.flatpickr-calendar {
    z-index: 9999 !important;
    position: absolute !important;
}

.flatpickr-calendar.open {
    display: inline-block !important;
    z-index: 9999 !important;
}

/* Ensure the date input is clickable */
#boat_date {
    cursor: pointer !important;
    position: relative !important;
    z-index: 1 !important;
}

/* Fix for any potential overlay issues */
.input-group {
    position: relative !important;
}

.input-group .input-group-text {
    pointer-events: none !important;
}
</style>
@endsection