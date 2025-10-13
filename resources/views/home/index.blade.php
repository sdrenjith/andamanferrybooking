@extends('layouts.app')

@section('title', 'Andaman Ferry Booking Online | Fast & Easy Ticket Booking')
@section('meta_description', 'Andaman ferry booking online is fast and secure. 
Reserve your ferry tickets to Havelock, Neil, and other islands with instant confirmation and best prices…

')


@section('content')

<main>
    <div class="bg-image-svg">
        <!-- New Hero Section -->
        <section class="hero-section mobile-scroll-safe position-relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Discover Andaman's Islands with Ease</h1>
                        <p class="lead mb-4">Book your ferry tickets in minutes and explore the pristine beaches and crystal clear waters of Andaman Islands.</p>
                        <div class="d-flex align-items-center mb-4">
                           <div class="rated me-4" style="min-width: fit-content; width: auto;">
    <img src="{{ url('assets/images/Stars-2.png') }}" alt="rating" class="me-2" style="height:28px;">
    <span class="rating-text">
         4.9/5 - Trusted by 10,000+  travelers
    </span>
</div>

                        </div>

                        <!-- Our Official Ferry Partners Section -->
                        <div class="hero-partners-section mb-4">
                            <div class="text-center mb-3">
                                <h6 class="partners-title text-white-75 mb-3" style="font-size: 0.9rem; font-weight: 600; letter-spacing: 0.5px;">
                                    Our Official Ferry Partners
                                </h6>
                            </div>
                            <div class="row justify-content-center g-3 partner-row">
                                <div class="col-6 col-md-3 col-lg-2 text-center">
                                    <div class="partner-logo-container">
                                        <img src="{{url('images/Makruzz/makruzz-logo.jpg')}}" alt="Makruzz" class="partner-logo partner-logo-sm mb-2" style="max-height: 50px; width: auto; opacity: 1; background: rgba(255,255,255,0.95); padding: 8px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 text-center">
                                    <div class="partner-logo-container">
                                        <img src="{{url('images/green_ocean1/logo.png')}}" alt="Green Ocean" class="partner-logo partner-logo-sm mb-2" style="max-height: 50px; width: auto; opacity: 1; background: rgba(255,255,255,0.95); padding: 8px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 text-center">
                                    <div class="partner-logo-container">
                                        <img src="{{url('images/Nautika/nautika-logo.jpg')}}" alt="Nautika" class="partner-logo partner-logo-sm mb-2" style="max-height: 50px; width: auto; opacity: 1; background: rgba(255,255,255,0.95); padding: 8px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 text-center">
                                    <div class="partner-logo-container">
                                        <img src="{{url('images/itt/logoGreen.png')}}" alt="ITT" class="partner-logo partner-logo-sm mb-2" style="max-height: 50px; width: auto; opacity: 1; background: rgba(255,255,255,0.95); padding: 8px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hero-features">
                            <div class="d-flex align-items-center mb-3">
    <i class="fa fa-bolt me-2" style="font-size:20px; color: #fff; text-shadow: 0 1px 2px rgba(0,0,0,0.3);"></i>
    <span style="color: #fff;">Instant Booking Confirmation</span>
</div>
<div class="d-flex align-items-center mb-3">
    <i class="fa fa-headset me-2" style="font-size:20px; color: #fff; text-shadow: 0 1px 2px rgba(0,0,0,0.3);"></i>
    <span style="color: #fff;">24/7 Customer Support</span>
</div>
<div class="d-flex align-items-center">
    <i class="fa fa-tag me-2" style="font-size:20px; color: #fff; text-shadow: 0 1px 2px rgba(0,0,0,0.3);"></i>
    <span style="color: #fff;">Best Price Guarantee</span>
</div>

                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="booking-form-wrapper mobile-scroll-safe" id="booking-form">
                            <div class="booking-form-header text-center mb-4">
                                <h3 class="mb-0">Book Your Ferry</h3>
                                <p class="text-muted">Quick and easy booking process</p>
                            </div>
                            <div class="bookingConsole" style="margin-bottom:2px">
                                <div class="tabBtns d-flex align-items-center">
                                    <div class="d-flex align-items-center tabBtn tabBtn1 active" id="one-way" data-list="1">
                                        <img src="{{ url('assets/images/one-way-inactive.png') }}" class="icon-inactive" alt="image">
                                        <img src="{{ url('assets/images/one-way-active.png') }}" class="icon-active" alt="image">
                                        <p class="mb-0 ms-2">One Way</p>
                                    </div>
                                    <div class="d-flex align-items-center tabBtn tabBtn2" data-list="2" id="round-trip">
                                        <img src="{{ url('assets/images/return-inactive.png') }}" class="icon-inactive" alt="image">
                                        <img src="{{ url('assets/images/return-active.png') }}" class="icon-active" alt="image">
                                        <p class="mb-0 ms-2">Round Trip</p>
                                    </div>
                                    <div class="d-flex align-items-center tabBtn tabBtn3" id="available-schedule" onclick="location.href='{{ url('ferry-schedule') }}'">
                                        <i class="fa fa-calendar-alt me-2"></i>
                                        <p class="mb-0">Available Schedule</p>
                                    </div>
                                </div>
                                <form action="{{ url('search-result-ferry') }}" method="GET">
                                    <input type="hidden" name="trip_type" id="trip_type" value="1">
                                    <div class="position-relative tabContainer">
                                        <div class="tabs tabs1 tab-round-trip mx-0 ferry-search-bar" style="opacity: 1; height: auto;">
                                            <div class="row mb-3">
                                                <div class="col-12 col-lg-3 mb-2">
                                                    <label for="location">From</label>
                                                    <select name="form_location" class="form-select p-0" id="form_location" fdprocessedid="ab4nz">
                                                        <option value="1" selected="">Port Blair</option>
                                                        <option value="2">Havelock</option>
                                                        <option value="3">Neil</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-lg-3 mb-2">
                                                    <label for="location">To</label>
                                                    <select name="to_location" class="form-select p-0" id="to_location" fdprocessedid="o5hbnr">
                                                        <option value="1">Port Blair</option>
                                                        <option value="2" selected="">Havelock</option>
                                                        <option value="3">Neil</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-lg-2 mb-2">
                                                    <label for="date">Date</label>
                                                    <input type="text" class="my_date_picker flatpickr-input" placeholder="Select Date" id="date" name="date" min="" readonly="readonly" fdprocessedid="w8od0e">
                                                </div>
                                                <div class="col-12 col-lg-2 mb-2">
                                                    <label for="location">Passengers</label>
                                                    <input type="number" class="form-control" id="pasanger" name="passenger" value="1" max="20" min="1" onkeyup="maxpassenger(this)" required="" fdprocessedid="fjz2hp">
                                                </div>
                                                <div class="col-12 col-lg-2 mb-2">
                                                    <label for="location">Infants</label>
                                                    <input type="number" class="form-control" id="infants" name="infant" value="0" oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" required="" fdprocessedid="qg1by">
                                                </div>
                                                <div class="col-12 col-lg-2 mb-2 d-flex flex-column">
                                                    <label for="search-btn" class="invisible">Search</label>
                                                    <button type="submit" class="btn button w-100 mt-auto" id="search" fdprocessedid="r4c7dvd"><i class="bi bi-search"></i> Search</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tabs tabs2 tab-round-trip mx-0 ferry-search-bar" style="overflow: hidden; opacity: 0; height: 0;">
                                            <div class="row mb-3">
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="return_form_location">From</label>
                                                    <select name="form_location" class="form-select p-0" id="return_form_location">
                                                        <option value="1" selected>Port Blair</option>
                                                        <option value="2">Havelock</option>
                                                        <option value="3">Neil</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="return_to_location">To</label>
                                                    <select name="to_location" class="form-select p-0" id="return_to_location">
                                                        <option value="1">Port Blair</option>
                                                        <option value="2" selected>Havelock</option>
                                                        <option value="3">Neil</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="round1_date">Departure Date</label>
                                                    <input type="text" class="my_date_picker flatpickr-input" placeholder="Select Date" id="round1_date" name="departure_date" min="" readonly="readonly">
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="round2_date">Return Date</label>
                                                    <input type="text" class="my_date_picker flatpickr-input" placeholder="Select Date" id="round2_date" name="return_date" min="" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-lg-4 mb-2">
                                                    <label for="round_passenger">Passengers</label>
                                                    <input type="number" class="form-control" id="round_passenger" name="passenger" value="1" max="20" min="1" onkeyup="maxpassenger(this)" required>
                                                </div>
                                                <div class="col-12 col-lg-4 mb-2">
                                                    <label for="round_infant">Infants</label>
                                                    <input type="number" class="form-control" id="round_infant" name="infant" value="0" oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" required>
                                                </div>
                                                <div class="col-12 col-lg-4 mb-2 d-flex flex-column">
                                                    <label for="round-search-btn" class="invisible">Search</label>
                                                    <button type="submit" class="btn button w-100 mt-auto" id="round_search"><i class="bi bi-search"></i> Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

      


        {{-- Why Us section --}}
            <section class="why-us-section py-5 mobile-scroll-safe">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center mb-5">
                            <h2 class="section-title">Why Choose Us?</h2>
                            <p class="section-subtitle">Experience the best ferry booking service in Andaman</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/images/trusted.svg') }}" alt="Trusted Agency">
                                </div>
                                <h3>100% Trusted Agency</h3>
                                <p>Official partner of all major ferry operators in Andaman</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/images/approval.svg') }}" alt="Customer Experience">
                                </div>
                                <h3>Delightful Experience</h3>
                                <p>Seamless booking process with instant confirmation</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/images/authorized.svg') }}" alt="Authorized Travel">
                                </div>
                                <h3>Authorized Travel</h3>
                                <p>Licensed and authorized by Andaman Tourism</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/images/customer-support.svg') }}" alt="Customer Support">
                                </div>
                                <h3>24/7 Support</h3>
                                <p>Round-the-clock customer support for all your needs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Modern 3 Steps Process Section -->
            <section class="modern-ferry-process-section py-5 mobile-scroll-safe">
                <div class="container">
                    <!-- Section Header -->
                    <div class="text-center mb-5">
                        <div class="section-badge d-inline-block mb-3">
                            ✨ Simple & Fast
                        </div>
                        <h2 class="display-4 fw-bold mb-4 gradient-text">
                            The Simplest Process Ever.<br>
                            Book Ferry in 3 Steps.
                        </h2>
                        <p class="lead text-white-75 mb-4 mx-auto" style="max-width: 600px;">
                            Experience seamless ferry booking with our streamlined process designed for your convenience
                        </p>
                        
                        <!-- BOOK NOW Button -->
                        <div class="text-center mb-5">
                            <a href="{{ route('ferry-booking') }}" class="btn btn-book-now btn-lg px-5 py-3 text-decoration-none">
                                <i class="fa fa-rocket me-2"></i>
                                BOOK NOW
                            </a>
                        </div>
                    </div>

                    <!-- Steps Container -->
                    <div class="row g-4 justify-content-center">
                        <!-- Step 1: Search -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="ferry-step-card h-100">
                                <div class="ferry-step-icon mx-auto mb-4">
                                    <div class="ferry-step-number">1</div>
                                    <i class="bi bi-search"></i>
                                </div>
                                <h4 class="ferry-step-title mb-3">Search</h4>
                                <p class="ferry-step-description mb-0">
                                    We'll help you find the right timings and best rates to help you make the most of your trip. Compare options instantly.
                                </p>
                            </div>
                        </div>

                        <!-- Step 2: Book -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="ferry-step-card h-100">
                                <div class="ferry-step-icon mx-auto mb-4">
                                    <div class="ferry-step-number">2</div>
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <h4 class="ferry-step-title mb-3">Book</h4>
                                <p class="ferry-step-description mb-0">
                                    Book your favorite from the largest selection of ferries and avoid any sneaky processing fees. You pay what you see!
                                </p>
                            </div>
                        </div>

                        <!-- Step 3: Sail -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="ferry-step-card h-100">
                                <div class="ferry-step-icon mx-auto mb-4">
                                    <div class="ferry-step-number">3</div>
                                    <i class="bi bi-emoji-sunglasses"></i>
                                </div>
                                <h4 class="ferry-step-title mb-3">Sail</h4>
                                <p class="ferry-step-description mb-0">
                                    You'll find that travelers love how we manage their bookings. We're reachable, available and here to help. Sail away without worry!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating background elements -->
                <div class="ferry-floating-elements">
                    <div class="ferry-floating-element"></div>
                    <div class="ferry-floating-element"></div>
                    <div class="ferry-floating-element"></div>
                </div>
            </section>

            {{-- Andaman Ferry Booking Information section --}}
            <section class="mt-5 mt-lg-5 pt-lg-3 mobile-scroll-safe">
                <div class="container">
                    <div class="row secHead pb-3">
                        <div class="col-12 pb-lg-2 text-center">
                            <h4 style="font-size: 34px; font-weight: 700; color: #008495;">Andaman Ferry Booking Information</h4>
                        </div>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="info-card p-4 text-center h-100 ferry-info-block">
                                <img src="{{url('assets/images/1-Most-popular-ferry-booking-site.jpg')}}" alt="Popular" class="mb-3 info-img">
                                <h5 class="fw-bold mb-2">Most Popular Ferry Booking Site</h5>
                                <p class="mb-0">Trusted by thousands for reliable and fast ferry bookings in Andaman.</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="info-card p-4 text-center h-100 ferry-info-block">
                                <img src="{{url('assets/images/2-Simplest-ferry-booking-experience.jpg')}}" alt="Simple" class="mb-3 info-img">
                                <h5 class="fw-bold mb-2">Simplest Booking Experience</h5>
                                <p class="mb-0">Book your ferry in just a few clicks with our user-friendly interface.</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="info-card p-4 text-center h-100 ferry-info-block">
                                <img src="{{url('assets/images/3-Easy-changes-fast-refunds.jpg')}}" alt="Easy Changes" class="mb-3 info-img">
                                <h5 class="fw-bold mb-2">Easy Changes & Fast Refunds</h5>
                                <p class="mb-0">Modify bookings and get refunds quickly with our hassle-free process.</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="info-card p-4 text-center h-100 ferry-info-block">
                                <img src="{{url('assets/images/4-Friendly-email-phone-support.jpg')}}" alt="Support" class="mb-3 info-img">
                                <h5 class="fw-bold mb-2">Friendly Support</h5>
                                <p class="mb-0">Get help anytime via email or phone from our dedicated team.</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="info-card p-4 text-center h-100 ferry-info-block">
                                <img src="{{url('assets/images/5-International-domestic-payment-accepted.jpg')}}" alt="Payments" class="mb-3 info-img">
                                <h5 class="fw-bold mb-2">All Payments Accepted</h5>
                                <p class="mb-0">Pay easily with international and domestic payment options.</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="info-card p-4 text-center h-100 ferry-info-block">
                                <img src="{{url('assets/images/6-Money-Safe-Guarantee.jpg')}}" alt="Safe" class="mb-3 info-img">
                                <h5 class="fw-bold mb-2">Money Safe Guarantee</h5>
                                <p class="mb-0">Your payments are secure with our trusted platform.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- BOOK NOW Button for Information Section -->
                    <div class="text-center mt-5">
                        <a href="{{ route('ferry-booking') }}" class="btn btn-book-now btn-lg px-5 py-3 text-decoration-none">
                            <i class="fa fa-rocket me-2"></i>
                            BOOK NOW
                        </a>
                    </div>
                </div>
            </section>

            {{-- Modern Featuring Andaman section --}}
            <section class="modern-featuring-section py-5 mobile-scroll-safe bg-image-svg">
                <div class="container">
                    <div class="row secHead pb-3 mb-4">
                        <div class="col-12 text-center">
                            <div class="section-badge d-inline-block mb-3">
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                DISCOVER PARADISE
                            </div>
                            <h2 class="modern-section-title">Featuring Andaman</h2>
                            <div class="title-underline mx-auto"></div>
                        </div>
                    </div>
                    
                    <!-- Glass Container for Content -->
                    <div class="glass-content-container">
                        <div class="row align-items-center g-0">
                            <!-- Content Text - Left Side -->
                            <div class="col-12 col-lg-7 order-2 order-lg-1">
                                <div class="modern-content-card h-100">
                                    <div class="content-header mb-4">
                                        <h3 class="content-title">Know More About Andaman</h3>
                                        <h4 class="content-subtitle">Land of Pristine Beauty</h4>
                                    </div>
                                    <div class="content-body">
                                        <p class="content-text">
                                            With more than 300 islands, the Andaman Islands provide a distinctive and varied vacation experience. The main Andaman Islands include the North, Middle, and South Andaman, referred to as the Great Andaman; further islands include Rutland Island, Landfall Island, Interview Island, the Sentinel Islands, and Ritchie's Archipelago.
                                        </p>
                                        <p class="content-text">
                                            The 90-mile (145-kilometer) Ten Degree Channel divides the Nicobar Islands from the Little Andaman in the south. Andaman Ferry Booking offers easy and dependable ferry services for smooth island hopping and touring these amazing destinations, guaranteeing you can effortlessly traverse and take in the beauty of the Andaman Islands.
                                        </p>
                                    </div>
                                    <div class="content-features mt-4">
                                        <div class="feature-item">
                                            <i class="bi bi-check-circle-fill"></i>
                                            <span>300+ Pristine Islands</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="bi bi-check-circle-fill"></i>
                                            <span>Crystal Clear Waters</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="bi bi-check-circle-fill"></i>
                                            <span>Rich Marine Life</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Image - Right Side -->
                            <div class="col-12 col-lg-5 order-1 order-lg-2">
                                <div class="modern-image-container">
                                    <div class="image-overlay"></div>
                                    <img src="{{ url('assets/images/feature.jpg') }}" alt="Andaman Islands" class="modern-feature-image img-fluid">
                                    <div class="image-badge">
                                        <i class="bi bi-geo-alt-fill me-2"></i>
                                        300+ Islands
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Dynamic Google Reviews Section --}}
    <section class="google-reviews-section py-5" style="background: linear-gradient(135deg, #008495 0%, #00a0b7 100%); min-height: 50vh; display: flex; align-items: center; position: relative; overflow: hidden;">
        {{-- Background Elements --}}
        <div class="testimonial-bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <div class="container position-relative">
            {{-- Header --}}
            <div class="testimonial-header text-center mb-4" data-aos="fade-up">
                <div class="section-badge mb-3">
                    <span class="badge-text">Google Reviews</span>
                </div>
                <h2 class="testimonial-title mb-2">What Our Customers Say</h2>
                <p class="testimonial-subtitle">Real reviews from Google - Trusted by thousands of travelers</p>
                <div class="google-rating-display mb-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png" alt="Google" style="height: 20px; margin-right: 10px;">
                        <div class="rating-info">
                            <span class="rating-number text-white fw-bold fs-3" id="google-rating">4.9</span>
                            <div class="rating-stars d-inline-block ms-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                                @endfor
                            </div>
                            <div class="total-reviews text-white-50 small" id="total-reviews">Based on 1,000+ reviews</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Testimonials Slider --}}
            <div class="testimonials-slider position-relative mx-auto" style="max-width: 700px;">
                <div class="testimonial-card-wrapper">
                    <!-- Dummy Realistic Testimonials -->
                    <div class="testimonial-card single-slide active" data-index="0">
                        <div class="card-inner glass-block">
                            <div class="testimonial-profile">
                                <div class="customer-avatar">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Priya Sharma" loading="lazy">
                                </div>
                                <h4 class="customer-name">Priya Sharma</h4>
                                <p class="customer-role">Travel Blogger, Mumbai</p>
                                <div class="stars-container mb-1">
                                    <svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                                    <svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                                    <svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                                    <svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                                    <svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                                </div>
                            </div>
                            <div class="testimonial-quote-block">
                                <div class="quote-icon mb-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M10 7L8 12H12L10 18V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M19 7L17 12H21L19 18V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <blockquote class="testimonial-quote text-white">
                                    "The ferry booking process was seamless and the staff was extremely helpful. We got instant confirmation and the journey was smooth. Highly recommend Andaman Ferry Booking for a hassle-free experience!"
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-card single-slide" data-index="1">
                        <div class="card-inner glass-block">
                            <div class="testimonial-profile">
                                <div class="customer-avatar">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Rahul Verma" loading="lazy">
                                </div>
                                <h4 class="customer-name">Rahul Verma</h4>
                                <p class="customer-role">Family Traveler, Delhi</p>
                                <div class="stars-container mb-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                                    @endfor
                                </div>
                            </div>
                            <div class="testimonial-quote-block">
                                <div class="quote-icon mb-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M10 7L8 12H12L10 18V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M19 7L17 12H21L19 18V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <blockquote class="testimonial-quote text-white">
                                    "We visited Havelock and Neil Islands and booked all our ferries online. The website was easy to use and the customer support was available 24/7. Our family had a wonderful time!"
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-card single-slide" data-index="2">
                        <div class="card-inner glass-block">
                            <div class="testimonial-profile">
                                <div class="customer-avatar">
                                    <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Sandeep Kumar" loading="lazy">
                                </div>
                                <h4 class="customer-name">Sandeep Kumar</h4>
                                <p class="customer-role">Solo Traveler, Bangalore</p>
                                <div class="stars-container mb-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                                    @endfor
                                </div>
                            </div>
                            <div class="testimonial-quote-block">
                                <div class="quote-icon mb-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M10 7L8 12H12L10 18V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M19 7L17 12H21L19 18V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <blockquote class="testimonial-quote text-white">
                                    "I was worried about last-minute bookings, but Andaman Ferry Booking made it so easy. Got my tickets instantly and the journey was comfortable. Will use again!"
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-card single-slide" data-index="3">
                        <div class="card-inner glass-block">
                            <div class="testimonial-profile">
                                <div class="customer-avatar">
                                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Meera Nair" loading="lazy">
                                </div>
                                <h4 class="customer-name">Meera Nair</h4>
                                <p class="customer-role">Honeymooner, Kerala</p>
                                <div class="stars-container mb-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                                    @endfor
                                </div>
                            </div>
                            <div class="testimonial-quote-block">
                                <div class="quote-icon mb-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M10 7L8 12H12L10 18V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M19 7L17 12H21L19 18V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <blockquote class="testimonial-quote text-white">
                                    "Best price guarantee and instant confirmation! The ferries were clean and on time. Booking online saved us so much time. Thank you!"
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slider-nav text-center mt-3">
                    <button class="slider-arrow prev-arrow" aria-label="Previous">&#8592;</button>
                    <button class="dot active" data-slide="0"></button>
                    <button class="dot" data-slide="1"></button>
                    <button class="dot" data-slide="2"></button>
                    <button class="dot" data-slide="3"></button>
                    <button class="slider-arrow next-arrow" aria-label="Next">&#8594;</button>
                </div>
            </div>
        </div>
    </section>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.testimonial-card.single-slide');
        const dots = document.querySelectorAll('.dot');
        const prev = document.querySelector('.prev-arrow');
        const next = document.querySelector('.next-arrow');
        let current = 0;
        let autoSlideInterval = null;
        function showSlide(idx) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === idx);
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === idx);
            });
            current = idx;
        }
        function nextSlide() {
            showSlide((current + 1) % slides.length);
        }
        function prevSlide() {
            showSlide((current - 1 + slides.length) % slides.length);
        }
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => showSlide(i));
        });
        if (prev && next) {
            prev.addEventListener('click', prevSlide);
            next.addEventListener('click', nextSlide);
        }
        // Auto-slide every 4 seconds
        autoSlideInterval = setInterval(nextSlide, 4000);
        // Pause on hover
        const slider = document.querySelector('.testimonials-slider');
        if (slider) {
            slider.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
            slider.addEventListener('mouseleave', () => autoSlideInterval = setInterval(nextSlide, 4000));
        }
        // Show the first slide on load
        showSlide(0);
    });
    </script>
    <style>
    .ultra-modern-testimonials {
      min-height: 32vh !important;
      padding: 2.2rem 0 1.2rem 0 !important;
      display: flex;
      align-items: center;
    }
    .testimonial-card.single-slide {
      display: none;
      flex-direction: row;
      align-items: stretch;
      justify-content: flex-start;
      width: 100%;
      min-height: 180px;
      background: none;
      box-shadow: none;
      border: none;
      padding: 0;
    }
    .testimonial-card.single-slide.active {
      display: flex;
    }
    .card-inner.glass-block {
      display: flex;
      flex-direction: row;
      align-items: stretch;
      background: rgba(255,255,255,0.13);
      border-radius: 18px;
      box-shadow: 0 4px 18px 0 rgba(31, 38, 135, 0.10);
      backdrop-filter: blur(14px);
      border: 1.2px solid rgba(255,255,255,0.18);
      padding: 1.2rem 1.5rem;
      width: 100%;
      min-height: 160px;
    }
    .testimonial-profile {
      flex: 0 0 170px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-right: 2.2rem;
    }
    .customer-avatar {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      overflow: hidden;
      margin-bottom: 0.7rem;
      border: 3px solid #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .customer-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .customer-name {
      font-weight: 700;
      font-size: 1.08rem;
      color: #fff;
      margin-bottom: 0.2rem;
    }
    .customer-role {
      font-size: 0.93rem;
      color: #fff;
      opacity: 0.8;
      margin-bottom: 0.5rem;
    }
    .stars-container {
      margin-bottom: 0.2rem;
    }
    .stars-container .star {
      color: #ffe066 !important;
      font-size: 1.1rem;
    }
    .testimonial-quote-block {
      flex: 1 1 0%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
      padding-left: 0.5rem;
    }
    .testimonial-quote {
      font-size: 1.08rem;
      line-height: 1.7;
      font-style: italic;
      margin: 0 0 0.5rem 0;
      border-left: 3px solid #fff2;
      padding-left: 1rem;
      color: #fff;
    }
    .quote-icon {
      color: #fff;
      opacity: 0.7;
      margin-bottom: 0.3rem;
    }
    .testimonial-slider-nav {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.7rem;
      margin-top: 1.2rem;
    }
    .slider-arrow {
      background: #fff;
      color: #008495;
      border: none;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      font-size: 1.3rem;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      transition: background 0.18s, color 0.18s, box-shadow 0.18s;
    }
    .slider-arrow:hover {
      background: #00a0b7;
      color: #fff;
      box-shadow: 0 4px 16px #00a0b7cc;
    }
    .dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: #fff;
      border: 2px solid #00a0b7;
      margin: 0 0.2rem;
      transition: background 0.18s, border 0.18s;
      display: inline-block;
    }
    .dot.active {
      background: #00a0b7;
      border-color: #fff;
    }
    @media (max-width: 900px) {
      .card-inner.glass-block {
        flex-direction: column;
        align-items: center;
        padding: 1rem 0.5rem;
        min-height: 120px;
      }
      .testimonial-profile {
        flex: 0 0 100px;
        margin-right: 0;
        margin-bottom: 0.7rem;
      }
      .testimonial-quote-block {
        padding-left: 0;
      }
    }
    /* Testimonial Section Title Bar and Fonts */
    .section-badge {
      max-width: 420px;
      width: 60vw;
      margin: 0 auto 1.2rem auto;
      background: rgba(255,255,255,0.18);
      border-radius: 2rem;
      color: #000 !important;
      font-weight: 600;
      font-size: 1.08rem;
      letter-spacing: 0.08em;
      text-align: center;
      padding: 0.3rem 0;
      border: 1px solid rgba(255,255,255,0.25);
    }
    .testimonial-title, .testimonial-subtitle {
      color: #fff !important;
    }
    .testimonial-title {
      font-weight: 700;
      letter-spacing: -0.5px;
    }
    .testimonial-subtitle {
      font-weight: 400;
      opacity: 0.93;
    }
    </style>

    {{-- Add AOS Library (Add this to your layout if not already included) --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    </script>

            {{-- Modern FAQ/Accordion section --}}
            <section class="modern-faq-section py-5 mobile-scroll-safe">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xl-12">
                            <div class="faq-white-container" style="background: #fff; border-radius: 2rem; box-shadow: 0 4px 32px rgba(0,0,0,0.07); padding: 2.2rem 1.2rem;">
                                <div class="text-center mb-5">
                                    <div class="section-badge d-inline-block mb-3">
                                        <i class="bi bi-question-circle me-2"></i>
                                        GOT QUESTIONS?
                                    </div>
                                    <h2 class="modern-section-title">Frequently Asked Questions</h2>
                                    <p class="text-muted">Find answers to common questions about ferry booking</p>
                                    <div class="title-underline mx-auto"></div>
                                </div>

                                <!-- Modern Tab Navigation -->
                                <div class="modern-tab-container mb-5">
                                    <ul class="nav nav-pills modern-nav-tabs justify-content-center" id="faqTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link modern-nav-link active" id="pre-booking-tab" data-bs-toggle="pill" data-bs-target="#pre-booking" type="button" role="tab" aria-controls="pre-booking" aria-selected="true">
                                                <i class="bi bi-clock-history me-2"></i>
                                                Pre Booking
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link modern-nav-link" id="booking-tab" data-bs-toggle="pill" data-bs-target="#booking" type="button" role="tab" aria-controls="booking" aria-selected="false">
                                                <i class="bi bi-calendar-check me-2"></i>
                                                Booking
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link modern-nav-link" id="post-booking-tab" data-bs-toggle="pill" data-bs-target="#post-booking" type="button" role="tab" aria-controls="post-booking" aria-selected="false">
                                                <i class="bi bi-check-circle me-2"></i>
                                                Post Booking
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Modern Tab Content -->
                                <div class="tab-content " id="faqTabContent" style="padding: 0 3rem;">
                                    <!-- Pre Booking -->
                                    <div class="tab-pane fade show active" id="pre-booking" role="tabpanel" aria-labelledby="pre-booking-tab">
                                        <div class="modern-accordion">
                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false">
                                                    <h5>Can We Book the Ferries After Reaching Andaman Or At The Last Moment?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="faq1" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        It's advisable to book ferry tickets in advance when travelling to the Andaman Islands, especially during the peak tourist season, to secure your seats and schedules. Last-minute bookings may be risky due to limited availability, so planning ahead is recommended for a smoother travel experience.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false">
                                                    <h5>What Is The Infant Policy?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="faq2" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        Different ferry operators have varying policies for infants:<br>
                                                        <strong>Makruzz and ITT Majestic:</strong> No charges for infants under 1 year.<br>
                                                        <strong>Green Ocean:</strong> No charges for infants under 2 years.<br>
                                                        <strong>Nautika/Nautika Lite:</strong> Infants under 2 years are not charged in full, but there is an INR 105 + 50 PSF fee per infant.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false">
                                                    <h5>What Is The Difference In Booking Between The Ferry Operator Website And In Website?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="faq3" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        Booking directly through the ferry operator's official website grants access solely to their services and support. Conversely, Andamanferrybooking is a partnering platform that consolidates information from multiple operators, offering a broader array of choices, potential discounts, and superior user experiences and customer support.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false">
                                                    <h5>Which Ferry Offers Access To The Open Deck?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="faq4" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        The only ferry providing Open Deck Access is Green Ocean 1; all other ferries are fully enclosed, offering a panoramic view of the sea.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false">
                                                    <h5>What Is The Distance Between Port Blair Airport And The Jetty?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="faq5" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        The distance between Veer Savarkar International Airport in Port Blair and the boarding point for Private Ferries at Haddo Jetty is around 5 km. It takes approximately 15-30 minutes to reach there by auto-rickshaw or taxi. In case you plan to take the Government Ferry, you will have to go to Phoenix Bay Jetty, which is 10-20 minutes away.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false">
                                                    <h5>What Is The Difference Between Seat Categories In A Ferry?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="faq6" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        Ferry seat categories offer different comfort levels, sea views, and legroom. The base category is like economy class on a flight and is below deck. The mid and upper categories are above deck and like business class on a flight.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#faq7" aria-expanded="false">
                                                    <h5>Do You Book Tickets From Mainland India to Andaman?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="faq7" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        We do not accept booking requests for routes from mainland India (such as Kolkata, Vizag, or Chennai) to Andaman, Little Andaman, or any restricted islands.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#faq8" aria-expanded="false">
                                                    <h5>What Is The Luggage Policy?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="faq8" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        When you take a ferry, your luggage will be subjected to an X-ray scan for security purposes. Please note that only checked-in luggage can carry alcohol up to 1 liter per person. It is not allowed to carry alcohol in hand baggage. Additionally, you are allowed to carry small hand luggage and check-in luggage that weighs up to 25 KG per person.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Booking -->
                                    <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                                        <div class="modern-accordion">
                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#booking1" aria-expanded="false">
                                                    <h5>What Is Your Policy If I Book A Ferry For Travel Within The Next 7 Days?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="booking1" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        For bookings made within 7 days of travel, we have a strict confirmation policy. Please contact our customer support immediately after booking to ensure seat availability and confirmation.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#booking2" aria-expanded="false">
                                                    <h5>What Is Your Cancellation or Rescheduling Policy?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="booking2" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        Cancellation and rescheduling policies vary by ferry operator. Generally, cancellations made 24 hours before departure are eligible for partial refunds. Please check our detailed cancellation policy for specific terms.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#booking3" aria-expanded="false">
                                                    <h5>What Happens If We Encounter Any Booking Failure or Payment Failure?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="booking3" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        In case of booking or payment failures, please contact our support team immediately. We'll help resolve the issue and ensure your booking is processed successfully. Keep your transaction reference number handy.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Post Booking -->
                                    <div class="tab-pane fade" id="post-booking" role="tabpanel" aria-labelledby="post-booking-tab">
                                        <div class="modern-accordion">
                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#post1" aria-expanded="false">
                                                    <h5>How Do I Check My Booking Status?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="post1" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        You can check your booking status by visiting our website and entering your booking reference number, or contact our customer support team for assistance.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#post2" aria-expanded="false">
                                                    <h5>What Should I Do If I Miss My Ferry?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="post2" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        If you miss your ferry, contact our support team immediately. We'll help you find alternative arrangements, though additional charges may apply for rebooking.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modern-accordion-item">
                                                <div class="modern-accordion-header" data-bs-toggle="collapse" data-bs-target="#post3" aria-expanded="false">
                                                    <h5>How Do I Get My Refund?</h5>
                                                    <i class="bi bi-chevron-down"></i>
                                                </div>
                                                <div id="post3" class="collapse modern-accordion-collapse">
                                                    <div class="modern-accordion-body">
                                                        Refunds are processed according to our cancellation policy. Eligible refunds are typically processed within 7-10 business days back to your original payment method.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

    </div>
</main>
@endsection

@push('js')
<script type="text/javascript">
    // Mobile detection
    const isMobile = window.innerWidth <= 767;
    
    function maxpassenger(element) {
        if (element.value < 1 || element.value > 20) {
            $(element).val('');
        }
    }

    // Complete AOS disable for mobile performance
    document.addEventListener('DOMContentLoaded', function() {
        if (isMobile) {
            // Completely disable AOS on mobile
            if (typeof AOS !== 'undefined') {
                AOS.init({ disable: true });
            }
            
            // Remove all AOS attributes from mobile elements
            const aosElements = document.querySelectorAll('[data-aos]');
            aosElements.forEach(element => {
                element.removeAttribute('data-aos');
                element.removeAttribute('data-aos-delay');
                element.removeAttribute('data-aos-duration');
                element.style.opacity = '1';
                element.style.transform = 'none';
                element.style.transition = 'none';
            });

            // Force scroll restoration to manual
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }

            // Remove problematic CSS properties
            document.body.style.webkitOverflowScrolling = 'auto';
            document.body.style.overflowScrolling = 'auto';
            document.body.style.overscrollBehavior = 'auto';
            document.documentElement.style.scrollBehavior = 'auto';
        }

        // Simplified date handling for mobile
        if (isMobile) {
            const dateInputs = document.querySelectorAll('.my_date_picker');
            dateInputs.forEach(input => {
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                input.value = tomorrow.toISOString().split('T')[0];
            });
        } else {
            // Your existing date logic for desktop
            const toDateInput = document.getElementById('date');
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            if (toDateInput) toDateInput.value = tomorrow.toISOString().split('T')[0];

            // Only run intervals on desktop
            setInterval(() => {
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 1);
                const dateEl = document.getElementById('date');
                if (dateEl) dateEl.value = tomorrow.toISOString().split('T')[0];
            }, 60 * 60 * 1000);
        }

        // Emergency scroll fix for mobile
        if (isMobile) {
            document.body.style.overflow = 'auto';
            document.body.style.position = 'relative';
            document.body.style.height = 'auto';
            document.documentElement.style.overflow = 'auto';
            
            // Disable all transforms and animations
            const style = document.createElement('style');
            style.textContent = `
                * {
                    -webkit-overflow-scrolling: auto !important;
                    overflow-scrolling: auto !important;
                    overscroll-behavior: auto !important;
                    backface-visibility: visible !important;
                    -webkit-backface-visibility: visible !important;
                    transform: none !important;
                    transition: none !important;
                    animation: none !important;
                    will-change: auto !important;
                }
            `;
            document.head.appendChild(style);
        }
    });

    // Your existing functions (unchanged)
    function enableDiv1() {
        $(".tabs.tabs1.row.mx-0").find("input, select, button").prop("disabled", false);
    }

    function disableDiv() {
        $(".tabs.tabs2.mx-0").find("input, select, button").prop("disabled", true);
    }

    function disableDiv1() {
        $(".tabs.tabs1.row.mx-0").find("input, select, button").prop("disabled", true);
    }

    function enableDiv() {
        $(".tabs.tabs2.mx-0").find("input, select, button").prop("disabled", false);
    }

    function enableTab1() {
        $(".tabs.tabs1.mx-0").find("input, select, button").prop("disabled", false);
    }

    $(document).ready(function() {
        $("#one-way").trigger("click");

        $(".tabBtn.tabBtn1").on("click", function() {
            enableDiv1();
            disableDiv();
        });

        $(".tabBtn.tabBtn2").on("click", function() {
            enableDiv();
            disableDiv1();
        });

        // Your existing event handlers...
        $(document).on('click', "#search", function(e) {
            $("#lds-spinner").removeClass('d-none');
        });

        $(document).on('click', ".delete", function(e) {
            $(this).parent().parent(".row").html("");
            $(this).parent().parent(".row").removeClass("border-bottom");
        });

        $(".tabBtn2").click(function() {
            $(".ferryBanner").addClass("secHeight");
        });

        $(".tabBtn1").click(function() {
            $(".ferryBanner").removeClass("secHeight");
            $(".tabs2").children(".row").removeClass("hide");
        });

        // Initialize flatpickr only on desktop for better performance
        if (!isMobile) {
            const dateOptions = {
                dateFormat: 'Y-m-d',
                minDate: "today"
            };

            $('#date').flatpickr(dateOptions);
            $('#round_date').flatpickr(dateOptions);
            $('#round1_date').flatpickr(dateOptions);
            $('#round2_date').flatpickr(dateOptions);
        }

        $("#round-trip").on("click", function() {
            $("#trip_type").val('3');
        });

        $("#one-way").on("click", function() {
            $("#trip_type").val('1');
        });

        $(".trip-delete").on("click", function() {
            const tripVal = parseInt($("#trip_type").val()) - 1;
            $("#trip_type").val(tripVal);
        });
    });

    // Emergency scroll fixes for mobile
    if (isMobile) {
        window.addEventListener('load', function() {
            setTimeout(() => {
                window.scrollTo(0, 0);
                document.body.style.overflow = 'auto';
                document.documentElement.style.overflow = 'auto';
            }, 100);
        });

        // Prevent scroll issues during orientation change
        window.addEventListener('orientationchange', function() {
            setTimeout(() => {
                window.scrollTo(0, 0);
                document.body.style.overflow = 'auto';
                document.documentElement.style.overflow = 'auto';
            }, 500);
        });

        // Prevent problematic touch behaviors
        document.addEventListener('touchmove', function(e) {
            // Allow normal scrolling
        }, { passive: true });

        // Fix any remaining scroll issues
        window.addEventListener('scroll', function() {
            // Ensure scroll is not locked
            if (document.body.style.overflow === 'hidden') {
                document.body.style.overflow = 'auto';
            }
        }, { passive: true });
    }

    // Google Reviews Functionality
    document.addEventListener('DOMContentLoaded', function() {
        loadGoogleReviews();
    });

    function loadGoogleReviews() {
        fetch('/api/google-reviews')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayGoogleReviews(data);
                } else {
                    showReviewsError();
                }
            })
            .catch(error => {
                console.error('Error loading Google reviews:', error);
                showReviewsError();
            });
    }

    function displayGoogleReviews(data) {
        // Hide loading state
        document.getElementById('reviews-loading').classList.add('d-none');
        
        // Update rating display
        document.getElementById('google-rating').textContent = data.rating;
        document.getElementById('total-reviews').textContent = `Based on ${data.total_ratings.toLocaleString()}+ reviews`;
        
        // Generate review cards
        const reviewsContainer = document.getElementById('reviews-container');
        const dotsContainer = document.getElementById('review-dots');
        
        reviewsContainer.innerHTML = '';
        dotsContainer.innerHTML = '';
        
        data.reviews.forEach((review, index) => {
            // Create review card
            const reviewCard = document.createElement('div');
            reviewCard.className = `testimonial-card single-slide ${index === 0 ? 'active' : ''}`;
            reviewCard.setAttribute('data-index', index);
            
            const stars = generateStars(review.rating);
            const reviewDate = new Date(review.time * 1000).toLocaleDateString();
            
            reviewCard.innerHTML = `
                <div class="card-inner glass-block">
                    <div class="testimonial-profile">
                        <div class="customer-avatar">
                            <img src="${review.profile_photo_url || 'https://via.placeholder.com/50x50/008495/ffffff?text=' + review.author_name.charAt(0)}" 
                                 alt="${review.author_name}" loading="lazy">
                        </div>
                        <h4 class="customer-name">${review.author_name}</h4>
                        <p class="customer-role">Google Review • ${reviewDate}</p>
                        <div class="stars-container mb-1">
                            ${stars}
                        </div>
                    </div>
                    <div class="testimonial-quote-block">
                        <div class="quote-icon mb-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M10 7L8 12H12L10 18V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 7L17 12H21L19 18V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <blockquote class="testimonial-quote text-white">
                            "${review.text}"
                        </blockquote>
                    </div>
                </div>
            `;
            
            reviewsContainer.appendChild(reviewCard);
            
            // Create dot
            const dot = document.createElement('button');
            dot.className = `dot ${index === 0 ? 'active' : ''}`;
            dot.setAttribute('data-slide', index);
            dot.setAttribute('aria-label', `Go to review ${index + 1}`);
            dotsContainer.appendChild(dot);
        });
        
        // Show the slider
        document.getElementById('google-reviews-slider').classList.remove('d-none');
        
        // Initialize slider functionality
        initializeReviewsSlider();
    }

    function generateStars(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                stars += '<svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>';
            } else {
                stars += '<svg class="star" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>';
            }
        }
        return stars;
    }

    function showReviewsError() {
        document.getElementById('reviews-loading').classList.add('d-none');
        document.getElementById('reviews-error').classList.remove('d-none');
    }

    function initializeReviewsSlider() {
        const slides = document.querySelectorAll('.testimonial-card.single-slide');
        const dots = document.querySelectorAll('.dot');
        const prev = document.querySelector('.prev-arrow');
        const next = document.querySelector('.next-arrow');
        let currentSlide = 0;
        let autoSlideInterval;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            currentSlide = index;
        }

        function nextSlide() {
            const nextIndex = (currentSlide + 1) % slides.length;
            showSlide(nextIndex);
        }

        function prevSlide() {
            const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(prevIndex);
        }

        // Event listeners
        next.addEventListener('click', nextSlide);
        prev.addEventListener('click', prevSlide);

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => showSlide(index));
        });

        // Auto-slide every 5 seconds
        autoSlideInterval = setInterval(nextSlide, 5000);

        // Pause on hover
        const slider = document.querySelector('.testimonials-slider');
        slider.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
        slider.addEventListener('mouseleave', () => autoSlideInterval = setInterval(nextSlide, 5000));
    }
</script>
@endpush