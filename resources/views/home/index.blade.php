@extends('layouts.app')

@section('content')

<main>
    <!-- New Hero Section -->
    <section class="hero-section" data-aos="fade-up" data-aos-duration="1200">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <h1 class="display-4 fw-bold mb-4">Discover Andaman's Islands with Ease</h1>
                    <p class="lead mb-4">Book your ferry tickets in minutes and explore the pristine beaches and crystal clear waters of Andaman Islands.</p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="rated me-4" data-aos="zoom-in" data-aos-delay="400">
                            <img src="{{ url('assets/images/Stars-2.png') }}" alt="rating" class="me-2">
                            <span class="text-muted">4.9/5 - Trusted by 10,000+ travelers</span>
                        </div>
                    </div>
                    <div class="hero-features">
                        <div class="d-flex align-items-center mb-3" data-aos="fade-right" data-aos-delay="600">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Instant Booking Confirmation</span>
                        </div>
                        <div class="d-flex align-items-center mb-3" data-aos="fade-right" data-aos-delay="700">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>24/7 Customer Support</span>
                        </div>
                        <div class="d-flex align-items-center" data-aos="fade-right" data-aos-delay="800">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Best Price Guarantee</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6" data-aos="fade-left" data-aos-delay="400">
                    <div class="booking-form-wrapper" data-aos="zoom-in" data-aos-delay="600">
                        <div class="booking-form-header text-center mb-4">
                            <h3 class="mb-0">Book Your Ferry</h3>
                            <p class="text-muted">Quick and easy booking process</p>
                        </div>
                        <div class="bookingConsole" style="margin-bottom:2px">
                            <div class="tabBtns d-flex align-items-center" style="position:relative;">
                                <div class="d-flex align-items-start tabBtn tabBtn1 active" id="one-way" data-list="1" data-aos="fade-right" data-aos-delay="700">
                                    <img src="{{ url('assets/images/one-way-inactive.png') }}" class="icon-inactive" alt="image">
                                    <img src="{{ url('assets/images/one-way-active.png') }}" class="icon-active" alt="image">
                                    <p class="mb-0 ms-2">One Way</p>
                                </div>
                                <div class="d-flex align-items-center tabBtn tabBtn2" data-list="2" id="round-trip" data-aos="fade-left" data-aos-delay="700">
                                    <img src="{{ url('assets/images/return-inactive.png') }}" class="icon-inactive" alt="image">
                                    <img src="{{ url('assets/images/return-active.png') }}" class="icon-active" alt="image">
                                    <p class="mb-0 ms-2">Round Trip</p>
                                </div>
                                <div class="available-btn dk-visible" data-aos="fade-up" data-aos-delay="800">
                                    <button type="button" class="btn btn-outline-warning w-100 btn-available" onclick="location.href='{{ url('ferry-schedule') }}'" fdprocessedid="h7vj7o">Available Schedule</button>
                                </div>
                            </div>
                            <form action="{{ url('search-result-ferry') }}" method="GET" data-aos="fade-up" data-aos-delay="900">
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
                                        </div>
                                        <div class="row search-bar-btn">
                                            <div class="col-12 col-lg-2">
                                                <button type="submit" class="btn button w-100" id="search" fdprocessedid="r4c7dvd"><i class="bi bi-search"></i> Search</button>
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
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="round_passenger">Passengers</label>
                                                <input type="number" class="form-control" id="round_passenger" name="passenger" value="1" max="20" min="1" onkeyup="maxpassenger(this)" required>
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="round_infant">Infants</label>
                                                <input type="number" class="form-control" id="round_infant" name="infant" value="0" oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" required>
                                            </div>
                                        </div>
                                        <div class="row search-bar-btn">
                                            <div class="col-12">
                                                <button type="submit" class="btn button w-100" id="round_search"><i class="bi bi-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-lg-3 py-0 trop-relative">
                                    <div class="mb-visible">
                                        <div class="row trip-section my-3">
                                            <div class="col-12 trip-name p-0">Trip 2</div>
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

    <section>
        <a class="whats-app" href="https://api.whatsapp.com/send?phone=9933281206" target="_blank">
            <i class="fa-brands fa-square-whatsapp"></i>
        </a>
        
    </section>
    <section>
        <a class="phone-app" href="tel:+919679061419" target="_blank">
            <i class="fa fa-phone-square" aria-hidden="true"></i>
        </a>
    </section>

    {{-- Start patterned background wrapper --}}
    <div class="homepage-pattern-bg">
        {{-- Step for Ferry Booking section --}}
        <section class="mt-5 pt-0">
            <div class="container">
                <div class="row secHead pb-3 pt-3">
                    <div class="col-12 text-center">
                        <h2>Step for Ferry Booking</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0  col-md-3 col-12">
                        <div class="processCard card step-block">
                            <div class="card-body">
                                <img src="{{url('assets/images/search.jpg')}}" alt="">
                            </div>
                            {{-- <div class="card-footer bg-transparent p-0 border-0">
                                <p>Search</p>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0 col-md-3 col-12">
                        <div class="processCard card step-block">
                            <div class="card-body">
                                <img src="{{url('assets/images/select.jpg')}}" alt="">
                            </div>
                            {{-- <div class="card-footer bg-transparent p-0 border-0">
                                <p>Fill Info</p>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0  col-md-3 col-12">
                        <div class="processCard card step-block">
                            <div class="card-body">
                                <img src="{{url('assets/images/pay.jpg')}}" alt="">
                            </div>
                            {{-- <div class="card-footer bg-transparent p-0 border-0">
                                <p>Payment</p>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 col-md-6 mb-3 mb-lg-0  col-md-3 col-12">
                        <div class="processCard card step-block">
                            <div class="card-body">
                                <img src="{{url('assets/images/received.jpg')}}" alt="">
                            </div>
                            {{-- <div class="card-footer bg-transparent p-0 border-0">
                                <p>Get Ticket</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3 Steps Process Section -->
        <section class="py-5" data-aos="fade-up" data-aos-delay="100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                        <h2 class="fw-bold display-6 mb-4">The Simplest Process Ever.<br>Book Ferry in 3 Steps.</h2>
                        <div class="d-flex flex-column gap-4">
                            <div class="d-flex align-items-start">
                                <div class="step-icon bg-white shadow rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px;"><i class="bi bi-search fs-2 text-dark"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-1">1. Search</h5>
                                    <p class="mb-0">We'll help you find the right timings and best rates to help you make the most of your trip.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="step-icon bg-white shadow rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px;"><i class="bi bi-journal-check fs-2 text-dark"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-1">2. Book</h5>
                                    <p class="mb-0">Book your favorite from the largest selection of ferries and avoid any sneaky processing fees. You pay what you see!</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="step-icon bg-white shadow rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px;"><i class="bi bi-emoji-sunglasses fs-2 text-dark"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-1">3. Sail</h5>
                                    <p class="mb-0">You'll find that travelers love how we manage their bookings. We're reachable, available and here to help. Sail away without worry!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 text-center">
                        <img src="{{ url('assets/images/3steps-illustration.png') }}" alt="3 Steps" class="img-fluid rounded-4 shadow-lg" style="max-width:90%;">
                    </div>
                </div>
            </div>
        </section>

        {{-- Why Us section --}}
        <section class="why-us-section py-5" data-aos="fade-up" data-aos-delay="200">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center mb-5">
                        <h2 class="section-title">Why Choose Us?</h2>
                        <p class="section-subtitle">Experience the best ferry booking service in Andaman</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="feature-card" data-aos="fade-up" data-aos-duration="600">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/images/trusted.svg') }}" alt="Trusted Agency">
                            </div>
                            <h3>100% Trusted Agency</h3>
                            <p>Official partner of all major ferry operators in Andaman</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="feature-card" data-aos="fade-up" data-aos-duration="600">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/images/approval.svg') }}" alt="Customer Experience">
                            </div>
                            <h3>Delightful Experience</h3>
                            <p>Seamless booking process with instant confirmation</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="feature-card" data-aos="fade-up" data-aos-duration="600">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/images/authorized.svg') }}" alt="Authorized Travel">
                            </div>
                            <h3>Authorized Travel</h3>
                            <p>Licensed and authorized by Andaman Tourism</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="feature-card" data-aos="fade-up" data-aos-duration="600">
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

        {{-- Andaman Ferry Booking Information section --}}
        <section class="mt-5 mt-lg-5 pt-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="container">
                <div class="row secHead pb-3">
                    <div class="col-12 pb-lg-2 text-center">
                        <h4 style="font-size: 34px; font-weight: 700; color: #008495;">Andaman Ferry Booking Information</h4>
                    </div>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="info-card p-4 text-center h-100 ferry-info-block">
                            <img src="{{url('assets/images/1-Most-popular-ferry-booking-site.jpg')}}" alt="Popular" class="mb-3 info-img">
                            <h5 class="fw-bold mb-2">Most Popular Ferry Booking Site</h5>
                            <p class="mb-0">Trusted by thousands for reliable and fast ferry bookings in Andaman.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="info-card p-4 text-center h-100 ferry-info-block">
                            <img src="{{url('assets/images/2-Simplest-ferry-booking-experience.jpg')}}" alt="Simple" class="mb-3 info-img">
                            <h5 class="fw-bold mb-2">Simplest Booking Experience</h5>
                            <p class="mb-0">Book your ferry in just a few clicks with our user-friendly interface.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="info-card p-4 text-center h-100 ferry-info-block">
                            <img src="{{url('assets/images/3-Easy-changes-fast-refunds.jpg')}}" alt="Easy Changes" class="mb-3 info-img">
                            <h5 class="fw-bold mb-2">Easy Changes & Fast Refunds</h5>
                            <p class="mb-0">Modify bookings and get refunds quickly with our hassle-free process.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="400">
                        <div class="info-card p-4 text-center h-100 ferry-info-block">
                            <img src="{{url('assets/images/4-Friendly-email-phone-support.jpg')}}" alt="Support" class="mb-3 info-img">
                            <h5 class="fw-bold mb-2">Friendly Support</h5>
                            <p class="mb-0">Get help anytime via email or phone from our dedicated team.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="500">
                        <div class="info-card p-4 text-center h-100 ferry-info-block">
                            <img src="{{url('assets/images/5-International-domestic-payment-accepted.jpg')}}" alt="Payments" class="mb-3 info-img">
                            <h5 class="fw-bold mb-2">All Payments Accepted</h5>
                            <p class="mb-0">Pay easily with international and domestic payment options.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="600">
                        <div class="info-card p-4 text-center h-100 ferry-info-block">
                            <img src="{{url('assets/images/6-Money-Safe-Guarantee.jpg')}}" alt="Safe" class="mb-3 info-img">
                            <h5 class="fw-bold mb-2">Money Safe Guarantee</h5>
                            <p class="mb-0">Your payments are secure with our trusted platform.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Featuring Andaman section --}}
        <section class="mt-5 mt-lg-5 pt-lg-3 featured-andaman-card" data-aos="fade-up" data-aos-delay="400">
            <div class="container">
                <div class="row secHead pb-3">
                    <div class="col-12 pb-lg-2 text-center">
                        <h5 style="font-size: 34px; font-weight: 700; color: #008495;">Featuring Andaman</h5>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 text-center mb-4 mb-lg-0">
                        <img src="{{ url('assets/images/feature.jpg') }}" alt="image" class="img-fluid rounded shadow" style="max-width: 100%; height: 320px; object-fit: cover;">
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="p-3">
                            <h4 class="mb-2">Know More About Andaman</h4>
                            <h5 class="mb-3">Land</h5>
                            <p>With more than 300 islands, the Andaman Islands provide a distinctive and varied vacation experience. The main Andaman Islands include the North, Middle, and South Andaman, referred to as the Great Andaman; further islands include Rutland Island, Landfall Island, Interview Island, the Sentinel Islands, and Ritchie's Archipelago. The 90-mile (145-kilometer) Ten Degree Channel divides the Nicobar Islands from the Little Andaman in the south. Andaman Ferry Booking offers easy and dependable ferry services for smooth island hopping and touring these amazing destinations, guaranteeing you can effortlessly traverse and take in the beauty of the Andaman Islands.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ/Accordion section --}}
        <section class="mt-4 mt-lg-5 pt-lg-3" data-aos="fade-up" data-aos-delay="500">
            <div class="faq_portion">
                <div class="container">
                    <div>
                        <div class="row">
                            <div class="col">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item custom_tab" role="presentation">
                                      <button class="nav-link nav_link_color active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" fdprocessedid="fu3hyp">Pre booking</button>
                                    </li>
                                    <li class="nav-item custom_tab" role="presentation">
                                      <button class="nav-link nav_link_color" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" fdprocessedid="8b04u" tabindex="-1">Booking</button>
                                    </li>
                                    <li class="nav-item custom_tab" role="presentation">
                                      <button class="nav-link nav_link_color" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false" fdprocessedid="2ls415" tabindex="-1">Post booking</button>
                                    </li>
                                  </ul>
                                <div class="content_portion">
                                      <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="accordion" id="accordionExample">
            
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" fdprocessedid="rbygv">
                                                    Can We Book the Ferries After Reaching Andaman Or At The Last Moment?
                                                    </button>
                                                  </h2>
                                                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                    <div class="accordion-body accordion_body">
                                                      It's advisable to book ferry tickets in advance when travelling to the Andaman Islands, especially during the peak tourist season, to secure your seats and schedules. Last-minute bookings may be risky due to limited availability, so planning ahead is recommended for a smoother travel experience.
                                                    </div>
                                                  </div>
                                                </div>
            
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" fdprocessedid="mjgskf">
                                                    What Is The Infant Policy?
                                                    </button>
                                                  </h2>
                                                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body accordion_body">
                                                        Different ferry operators have varying policies for infants:<br>
                                                        <strong>Makruzz and ITT Majestic:</strong> No charges for infants under 1 year.<br>
                                                        <strong>Green Ocean:</strong> No charges for infants under 2 years.<br>
                                                        <strong>Nautika/Nautika Lite:</strong> Infants under 2 years are not charged in full, but there is an INR 105 + 50 PSF fee per infant.
                                                    </div>
                                                  </div>
                                                </div>
            
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" fdprocessedid="a3td1">
                                                    What Is The Difference In Booking Between The Ferry Operator Website And In Website?
                                                    </button>
                                                  </h2>
                                                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body accordion_body">
                                                        Booking directly through the ferry operator's official website grants access solely to their services and support. Conversely, Andamanferrybooking is a partnering platform that consolidates information from multiple operators, offering a broader array of choices, potential discounts, and superior user experiences and customer support.
                                                    </div>
                                                  </div>
                                                </div>
                                              
            
                                              <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" fdprocessedid="ghkje6">
                                                  Which Ferry Offers Access To The Open Deck?
                                                  </button>
                                                </h2>
                                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                  <div class="accordion-body accordion_body">
                                                    The only ferry providing Open Deck Access is Green Ocean 1; all other ferries are fully enclosed, offering a panoramic view of the sea.
                                                  </div>
                                                </div>
                                              </div>
            
                                              <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5" fdprocessedid="pcyzjl">
                                                  What Is The Distance Between Port Blair Airport And The Jetty?
                                                  </button>
                                                </h2>
                                                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                  <div class="accordion-body accordion_body">
                                                    The distance between Veer Savarkar International Airport in Port Blair and the boarding point for Private Ferries at Haddo Jetty is around 5 km. It takes approximately 15-30 minutes to reach there by auto-rickshaw or taxi. In case you plan to take the Government Ferry, you will have to go to Phoenix Bay Jetty, which is 10-20 minutes away.
                                                  </div>
                                                </div>
                                              </div>
            
                                              <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6" fdprocessedid="d2dppf">
                                                  What Is The Difference Between Seat Categories In A Ferry?
                                                  </button>
                                                </h2>
                                                <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                  <div class="accordion-body accordion_body">
                                                    Ferry seat categories offer different comfort levels, sea views, and legroom. The base category is like economy class on a flight and is below deck. The mid and upper categories are above deck and like business class on a flight.
                                                  </div>
                                                </div>
                                              </div>
            
                                              <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7" fdprocessedid="iqzzz">
                                                  Do You Book Tickets From Mainland India to Andaman?
                                                  </button>
                                                </h2>
                                                <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                  <div class="accordion-body accordion_body">
                                                    We do not accept booking requests for routes from mainland India (such as Kolkata, Vizag, or Chennai) to Andaman, Little Andaman, or any restricted islands.
                                                  </div>
                                                </div>
                                              </div>
            
                                              <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8" fdprocessedid="qxybme">
                                                  What Is The Luggage Policy?
                                                  </button>
                                                </h2>
                                                <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                  <div class="accordion-body accordion_body">
                                                    When you take a ferry, your luggage will be subjected to an X-ray scan for security purposes. Please note that only checked-in luggage can carry alcohol up to 1 liter per person. It is not allowed to carry alcohol in hand baggage. Additionally, you are allowed to carry small hand luggage and check-in luggage that weighs up to 25 KG per person.
                                                  </div>
                                                </div>
                                              </div>
            
            
                                            </div>
                                        </div>
            
            
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                     What Is Your Policy If I Book A Ferry For Travel Within The Next 7 Days?
                                                    </button>
                                                  </h2>
                                                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                    <div class="accordion-body accordion_body">
                                                      <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the , though the transition does limit overflow.
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                     What Is Your Cancellation or Rescheduling Policy?
                                                    </button>
                                                  </h2>
                                                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body accordion_body">
                                                      <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the, though the transition does limit overflow.
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                     What Happens If We Encounter Any Booking Failure or Payment Failure?
                                                    </button>
                                                  </h2>
                                                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body accordion_body">
                                                      <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the , though the transition does limit overflow.
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                        </div>
            
            
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                     What Is Your Policy If I Book A Ferry For Travel Within The Next 7 Days?
                                                    </button>
                                                  </h2>
                                                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                    <div class="accordion-body accordion_body ">
                                                      <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the , though the transition does limit overflow.
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                     What Is Your Cancellation or Rescheduling Policy?
                                                    </button>
                                                  </h2>
                                                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body accordion_body">
                                                      <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the , though the transition does limit overflow.
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                     What Happens If We Encounter Any Booking Failure or Payment Failure?
                                                    </button>
                                                  </h2>
                                                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body accordion_body">
                                                      <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the , though the transition does limit overflow.
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
                </div>
            
            </div>
        
        </section>

        {{-- Testimonials section --}}
        <section class="mt-5 mt-lg-5 pt-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="row justify-content-center secHead w-100 m-0">
                <div class="col-12 col-lg-6 text-center">
                    <h2>Testimonials</h2>
                </div>
            </div>
            <div class="testimonials">
                <div class="container">
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach ($testimonials as $key =>$testimonial)
                            @if ($key==0)
                            <div class="carousel-item active">
                                <div class="row align-items-center">
                                    <div class="col-12 col-sm-12 col-md-7">
                                        <div class="comment">
                                            <div class="text-white">
                                                <p>{{ $testimonial->subtitle }}</p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-5">
                                        <div class="profileInfo">
                                            <div class="profilePic">
                                                <img src="{{ env('UPLOADED_ASSETS'). $testimonial->path }}" alt="image">
                                            </div>
                                            <h3>{{ $testimonial->title }}</h3>
                                            <p class="text-white">

                                                {{ $testimonial->designation }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else

                            <div class="carousel-item ">
                                <div class="row align-items-center">
                                    <div class="col-12 col-sm-12 col-md-7">
                                        <div class="comment">
                                            <div class="text-white">

                                                <p>{{ $testimonial->subtitle }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-5">
                                        <div class="profileInfo">
                                            <div class="profilePic">
                                                <img src="{{ env('UPLOADED_ASSETS') . $testimonial->path }}" alt="image">
                                            </div>
                                            <div>
                                                <h3>{{ $testimonial->title }}</h3>
                                                <p class="text-white">
                                                    {{ $testimonial->designation }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <img src="images/left_arrow_white.svg" alt="image">
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <img src="images/right_arrow_white.svg" alt="image">
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>
        </section>

        {{-- Our Partners section --}}
        <section class="mt-5 mt-lg-4 py-lg-5" data-aos="fade-up" data-aos-delay="700">
            <div class="container">
                <div class="row secHead pb-3">
                    <div class="col-12 pb-lg-2 text-center">
                        <h2>Our Partners</h2>
                    </div>
                </div>
                <div class="row justify-content-center g-3">
                    <div class="col-6 col-md-3 col-lg-2 text-center">
                        <img src="{{url('images/Makruzz/makruzz-logo.jpg')}}" alt="Makruzz" class="partner-logo mb-2">
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 text-center">
                        <img src="{{url('images/green_ocean1/logo.png')}}" alt="Green Ocean" class="partner-logo mb-2">
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 text-center">
                        <img src="{{url('images/Nautika/nautika-logo.jpg')}}" alt="Nautika" class="partner-logo mb-2">
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 text-center">
                        <img src="{{url('images/itt/logoGreen.png')}}" alt="ITT" class="partner-logo mb-2">
                    </div>
                    <!-- Add more partners as needed, keeping two lines -->
                </div>
                <div class="row justify-content-center g-3 mt-2">
                    <div class="col-6 col-md-3 col-lg-2 text-center">
                        <img src="{{ asset('assets/images/logo/acci.png') }}" alt="ACCI" class="partner-logo mb-2">
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 text-center">
                        <img src="{{ asset('assets/images/logo/travel-massiv.png') }}" alt="Travel Massive" class="partner-logo mb-2">
                    </div>
                    <!-- Add more if needed -->
                </div>
            </div>
        </section>
    </div>
    {{-- End patterned background wrapper --}}

</main>
@endsection

@push('js')
    <script type="text/javascript">
        function maxpassenger(element) {
            if (element.value < 1 || element.value > 20) {

                $(element).val('');
            }
        }

        // function updateToLocationOptions() {
        //     var formLocationValue = document.getElementById('form_location').value;
        //     var toLocation = document.getElementById('to_location');

        //     var toLocationChanged = false;

        //     for (var i = 0; i < toLocation.options.length; i++) {
        //         var option = toLocation.options[i];
        //         if (option.value === formLocationValue) {
        //             option.disabled = true;
        //             if (option.selected) {
        //                 toLocationChanged = true;
        //             }
        //         } else {
        //             option.disabled = false;
        //         }
        //     }

        //     if (toLocationChanged) {
        //         for (var i = 0; i < toLocation.options.length; i++) {
        //             var option = toLocation.options[i];
        //             if (!option.disabled) {
        //                 toLocation.value = option.value;
        //                 break;
        //             }
        //         }
        //     }
        // }

        // document.getElementById('form_location').addEventListener('change', function() {
        //     updateToLocationOptions();
        // });
        // updateToLocationOptions();


        // // return from and to date
        // function updateToLocationOptions() {
        //     var formLocationValue = document.getElementById('return_form_location').value;
        //     var toLocation = document.getElementById('return_to_location');

        //     var toLocationChanged = false;

        //     for (var i = 0; i < toLocation.options.length; i++) {
        //         var option = toLocation.options[i];
        //         if (option.value === formLocationValue) {
        //             option.disabled = true;
        //             if (option.selected) {
        //                 toLocationChanged = true;
        //             }
        //         } else {
        //             option.disabled = false;
        //         }
        //     }

        //     if (toLocationChanged) {
        //         for (var i = 0; i < toLocation.options.length; i++) {
        //             var option = toLocation.options[i];
        //             if (!option.disabled) {
        //                 toLocation.value = option.value;
        //                 break;
        //             }
        //         }
        //     }
        // }

        // document.getElementById('return_form_location').addEventListener('change', function() {
        //     updateToLocationOptions();
        // });
        // updateToLocationOptions();


        //   ******single_trip
        document.addEventListener('DOMContentLoaded', function() {
            const toDateInput = document.getElementById('date');
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1); // Increment the date by 1 to get tomorrow's date
            toDateInput.value = tomorrow.toISOString().split('T')[0];

            setInterval(() => {
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 1); // Increment the date by 1 to get tomorrow's date
                toDateInput.value = tomorrow.toISOString().split('T')[0];
            }, 60 * 60 * 1000);
        });

        function updateTomorrow() {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1); // Increment the date by 1 to get tomorrow's date
            document.getElementById('date').value = tomorrow.toISOString().split('T')[0];
        }


        // ***** round_trip
        document.addEventListener('DOMContentLoaded', function() {
            const toDateInput = document.getElementById('round_date');
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 0);
            toDateInput.value = tomorrow.toISOString().split('T')[0];

            setInterval(() => {
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 0);
                toDateInput.value = tomorrow.toISOString().split('T')[0];
            }, 60 * 60 * 1000);
        });

        function updateTomorrow() {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 0);
            document.getElementById('round_date').value = tomorrow.toISOString().split('T')[0];
        }

        // ******* round1_date update
        document.addEventListener('DOMContentLoaded', function() {
            const toDateInput = document.getElementById('round1_date');
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            toDateInput.value = tomorrow.toISOString().split('T')[0];

            setInterval(() => {
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 1);
                toDateInput.value = tomorrow.toISOString().split('T')[0];
            }, 60 * 60 * 1000);
        });

        function updateTomorrow() {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            document.getElementById('round1_date').value = tomorrow.toISOString().split('T')[0];
        }

        // ********** round2_trip date update
        document.addEventListener('DOMContentLoaded', function() {
            const toDateInput = document.getElementById('round2_date');
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 2);
            toDateInput.value = tomorrow.toISOString().split('T')[0];

            setInterval(() => {
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 2);
                toDateInput.value = tomorrow.toISOString().split('T')[0];
            }, 60 * 60 * 1000);
        });

        function updateTomorrow() {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 2);
            document.getElementById('round2_date').value = tomorrow.toISOString().split('T')[0];
        }


        // document.addEventListener('DOMContentLoaded', function() {
        //     const fromDateInput = document.getElementById('tr_date');
        //     const toDateInput = document.getElementById('return_date_of_journey');

        //     const setReturnDate = () => {
        //         const fromDate = new Date(fromDateInput.value);
        //         const returnDate = new Date(fromDate);
        //         returnDate.setDate(fromDate.getDate() + 1);
        //         toDateInput.value = returnDate.toISOString().split('T')[0];
        //         toDateInput.min = returnDate.toISOString().split('T')[0];
        //     };

        //     fromDateInput.addEventListener('change', setReturnDate);

        //     // Initialize the return date field to tomorrow by default
        //     const tomorrow = new Date();
        //     tomorrow.setDate(tomorrow.getDate() + 2);
        //     toDateInput.value = tomorrow.toISOString().split('T')[0];
        //     toDateInput.min = tomorrow.toISOString().split('T')[0];

        //     setInterval(() => {
        //         const today = new Date();
        //         const tomorrow = new Date(today);
        //         tomorrow.setDate(tomorrow.getDate() + 1);
        //         toDateInput.value = tomorrow.toISOString().split('T')[0];
        //     }, 60 * 60 * 1000);
        // });

        function enableDiv1() {
            $(".tabs.tabs1.row.mx-0").find("input, select, button").prop("disabled", false);
        }

        function disableDiv() {

            $(".tabs.tabs2.mx-0").find("input, select, button").prop("disabled", true);
        }

        function disableDiv1() {
            $(".tabs.tabs1.row.mx-0").find("input, select, button").prop("disabled", true);
        }

        // disableDiv();

        function enableDiv() {
            $(".tabs.tabs2.mx-0").find("input, select, button").prop("disabled", false);
        }

        function enableTab1() {
            $(".tabs.tabs1.mx-0").find("input, select, button").prop("disabled", false);
        }

        $(document).ready(function() {
            // enableTab1();
            $("#one-way").trigger("click");

            $(".tabBtn.tabBtn1").on("click", function() {
                enableDiv1();
                disableDiv();
            });

            $(".tabBtn.tabBtn2").on("click", function() {
                enableDiv();
                disableDiv1();
            });

            $(document).on('click', "#search", function(e) {

                $("#lds-spinner").removeClass('d-none');
                var car_id = $(this).val();

            });

            $(document).on('click', ".delete", function(e) {
            $(this).parent().parent(".row").html("");
            $(this).parent().parent(".row").removeClass("border-bottom");
            });

            $(document).on('click', ".delete", function(e) {
                var row = $(this).closest(".row");
                row.html("");
                row.removeClass("border-bottom");
            });


            $(".tabBtn2").click(function() {
                $(".ferryBanner ").addClass("secHeight");
            })
            $(".tabBtn1").click(function() {
                $(".ferryBanner").removeClass("secHeight");
                $(".tabs2").children(".row").removeClass("hide");
            });


            const dateOptions = {
                dateFormat: 'Y-m-d',
                 minDate: "today"
            };

            $('#date').flatpickr(dateOptions);
            $('#round_date').flatpickr(dateOptions);
            $('#round1_date').flatpickr(dateOptions);
            $('#round2_date').flatpickr(dateOptions);

            $("#round-trip").on("click", function() {
                $("#trip_type").val('3');
            });

            $("#one-way").on("click", function() {
                $("#trip_type").val('1');
            });

            $(".trip-delete").on("click", function() {
                $tripVal = parseInt($("#trip_type").val()) - 1;
                $("#trip_type").val($tripVal);
            });

            // enableTab1();

        });
    </script>
@endpush

<style>
.partner-logo { width: 160px !important; height: 100px !important; }
</style>