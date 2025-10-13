@extends('layouts.app')

@section('title', 'Book Ferry Tickets Online | Fast & Secure Booking')
@section('meta_title', 'Ferry Ticket Online | Fast & Secure Booking')
@section('meta_description', 'Quickly book ferry tickets online with easy steps, secure payments, instant confirmation, and 24/7 support. Enjoy smooth and stress-free travel today!')

@section('content')
    <main>
        <section class="mt-4 pt-4 mx-3 mx-md-5">
            <div class="ferryBanner">
                <div class="bookingConsole ">
                    <div class="tabBtns d-flex align-items-center">
                        <div class="d-flex align-items-center tabBtn tabBtn1 active" id="one-way" data-list="1">
                            <img src="{{ asset('assets/images/one-way-inactive.png') }}" class="icon-inactive" alt="">
                            <img src="{{ asset('assets/images/one-way-active.png') }}" class="icon-active" alt="">
                            <p class="mb-0 ms-2">One Way</p>
                        </div>
                        <div class="d-flex align-items-center tabBtn tabBtn2" data-list="2" id="round-trip">
                            <img src="{{ asset('assets/images/return-inactive.png') }}" class="icon-inactive" alt="">
                            <img src="{{ asset('assets/images/return-active.png') }}" class="icon-active" alt="">
                            <p class="mb-0 ms-2">Round Trip</p>
                        </div>
                        <div class="d-flex align-items-center tabBtn tabBtn3" id="available-schedule" onclick="location.href='{{ url('ferry-schedule') }}'">
                            <i class="fa fa-calendar-alt me-2"></i>
                            <p class="mb-0">Available Schedule</p>
                        </div>
                    </div>

                    <form action="{{ url('/search-result-ferry') }}" method="GET">
                        <input type="hidden" name="trip_type" id="trip_type" value="1">

                        <div class="position-relative tabContainer">
                            <div class="tabs tabs1 row mx-0">
                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                    <label for="location">From</label>
                                    <select name="form_location" class="form-select border-0 p-0" id="form_location">
                                        @foreach ($ferry_locations as $index => $ferry_location)
                                            <option value="{{ $ferry_location->id }}"
                                                {{ $index + 1 == 1 ? 'selected' : '' }}>
                                                {{ $ferry_location->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                    <label for="location">To</label>
                                    <select name="to_location" class="form-select border-0 p-0" id="to_location">
                                        @foreach ($ferry_locations as $index => $ferry_location)
                                            <option value="{{ $ferry_location->id }}"
                                                {{ $index + 1 == 2 ? 'selected' : '' }}>
                                                {{ $ferry_location->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                    <label for="date">Date</label>
                                    <input type="date" class="my_date_picker" placeholder="Select Date" id="date"
                                        name="date" min="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                    <label for="location">Passengers</label>
                                    <input type="number" class="form-control" id="pasanger" name="passenger"
                                        value="1" max="20" min="1" onkeyup="maxpassenger(this)" required>
                                </div>
                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 ">
                                    <label for="location">Infants</label>
                                    <input type="number" class="form-control" id="infants" name="infant" value="0"
                                        oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" required>
                                </div>
                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0" style="margin-top: 20px;">
                                    <button type="submit" class="btn button w-100" id="search"><i
                                            class="bi bi-search"></i>
                                        Search</button>
                                </div>
                            </div>
                            <div class="tabs tabs2  mx-0">
                                <div class="row pt-2 border-bottom">
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-lg-0 border-end">
                                        <label for="location">From</label>
                                        <select name="form_location" class="form-select border-0 p-0" id="form_location">
                                            @foreach ($ferry_locations as $index => $ferry_location)
                                                <option value="{{ $ferry_location->id }}"
                                                    {{ $index + 1 == 1 ? 'selected' : '' }}>
                                                    {{ $ferry_location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-lg-0 border-end">
                                        <label for="location">To</label>
                                        <select name="to_location" class="form-select border-0 p-0" id="to_location">
                                            @foreach ($ferry_locations as $index => $ferry_location)
                                                <option value="{{ $ferry_location->id }}"
                                                    {{ $index + 1 == 2 ? 'selected' : '' }}>
                                                    {{ $ferry_location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                        <label for="date">Date</label>
                                        <input type="date" class="my_date_picker" placeholder="Select Date"
                                            id="round_date" name="date" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-1 mb-2 mb-lg-0 border-end">
                                        <label for="passenger">Passengers</label>
                                        <input type="number" class="form-control" id="passenger" name="passenger"
                                            value="1" onkeyup="maxpassenger(this)" required>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-1 mb-2 mb-lg-0 ">
                                        <label for="infant">Infants</label>
                                        <input type="number" class="form-control" id="infant" name="infant"
                                            value="0"
                                            oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" required>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0" style="margin-top: 20px;">
                                        <button class="btn button w-100" id="search"><i class="bi bi-search"></i>
                                            Search</button>
                                    </div>
                                </div>
                                <div class="row py-2 border-bottom">
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-lg-0 border-end">
                                        <label for="location">From</label>
                                        <select name="round1_from_location" class="form-select border-0 p-0"
                                            id="round1_from_location">
                                            @foreach ($ferry_locations as $index => $ferry_location)
                                                <option value="{{ $ferry_location->id }}"
                                                    {{ $index + 1 == 2 ? 'selected' : '' }}>
                                                    {{ $ferry_location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-lg-0 border-end">
                                        <label for="location">To</label>
                                        <select name="round1_to_location" class="form-select border-0 p-0"
                                            id="round1_to_location">
                                            @foreach ($ferry_locations as $index => $ferry_location)
                                                <option value="{{ $ferry_location->id }}"
                                                    {{ $index + 1 == 3 ? 'selected' : '' }}>
                                                    {{ $ferry_location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                        <label for="date">Date</label>
                                        <input type="date" placeholder="Select Date" id="round1_date"
                                            name="round1_date" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-1 mb-2 mb-lg-0 border-end">
                                        <label for="location">Passengers</label>
                                        <input type="number" class="form-control" id="round1_pasanger" value=""
                                            onkeyup="maxpassenger(this)" readonly>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-1 mb-2 mb-lg-0 ">
                                        <label for="location">Infants</label>
                                        <input type="number" class="form-control" id="round1_infants" value=""
                                            oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" readonly>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 text-center">
                                        <button type="button" class="btn btn-outline-danger delete trip-delete"><i
                                                class="bi bi-trash3-fill"></i></button>
                                    </div>
                                </div>
                                <div class="row py-2 border-bottom">
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-lg-0 border-end">
                                        <label for="location">From</label>
                                        <select name="round2_from_location" class="form-select border-0 p-0"
                                            id="round2_from_location">
                                            @foreach ($ferry_locations as $index => $ferry_location)
                                                <option value="{{ $ferry_location->id }}"
                                                    {{ $index + 1 == 3 ? 'selected' : '' }}>
                                                    {{ $ferry_location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-lg-0 border-end">
                                        <label for="location">To</label>
                                        <select name="round2_to_location" class="form-select border-0 p-0"
                                            id="round2_to_location">
                                            @foreach ($ferry_locations as $index => $ferry_location)
                                                <option value="{{ $ferry_location->id }}"
                                                    {{ $index + 1 == 1 ? 'selected' : '' }}>
                                                    {{ $ferry_location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                        <label for="round2_date">Date</label>
                                        <input type="date" class="my_date_picker" placeholder="Select Date"
                                            id="round2_date" name="round2_date" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-1 mb-2 mb-lg-0 border-end">
                                        <label for="location">Passengers</label>
                                        <input type="number" class="form-control" id="round2_pasanger" value=""
                                            onkeyup="maxpassenger(this)" readonly>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-1 mb-2 mb-lg-0 ">
                                        <label for="location">Infants</label>
                                        <input type="number" class="form-control" id="round2_infants" value=""
                                            oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" readonly>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 text-center">
                                        <button type="button" class="btn btn-outline-danger delete trip-delete"><i
                                                class="bi bi-trash3-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Achievement Banner -->
        <section class="py-5 achievement-banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row text-center">
                            <div class="col-12 col-md-3 mb-4 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="me-3">
                                        <div class="bg-white rounded-3 p-3 shadow-sm" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                            <img src="{{ url('assets/images/logo-startup.png') }}" alt="Startup India" style="max-width: 40px; max-height: 40px;">
                                        </div>
                                    </div>
                                    <div class="text-start">
                                        <div class="text-muted small">Recognised by</div>
                                        <div class="fw-bold text-dark">#startupindia</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-4 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="me-3">
                                        <div class="bg-white rounded-3 p-3 shadow-sm" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                            <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png" alt="Google" style="max-width: 40px; max-height: 40px;">
                                        </div>
                                    </div>
                                    <div class="text-start">
                                        <div class="fw-bold text-primary fs-4">4.9</div>
                                        <div class="text-muted small">Google Ratings</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-4 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="me-3">
                                        <div class="bg-white rounded-3 p-3 shadow-sm" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-ticket-perforated text-danger" style="font-size: 24px;"></i>
                                        </div>
                                    </div>
                                    <div class="text-start">
                                        <div class="fw-bold text-primary fs-4">1,00,000+</div>
                                        <div class="text-muted small">Ferry Tickets Booked</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-4 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="me-3">
                                        <div class="bg-white rounded-3 p-3 shadow-sm" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-calendar-check text-danger" style="font-size: 24px;"></i>
                                        </div>
                                    </div>
                                    <div class="text-start">
                                        <div class="fw-bold text-primary fs-4">4 Years</div>
                                        <div class="text-muted small">Booking Ferries for You</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Videos Section --}}
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h2 class="display-5 fw-bold text-primary mb-3">Experience Andaman</h2>
                        <p class="lead text-muted">Watch our videos to see the beauty of Andaman Islands</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body p-0">
                                <div class="video-container">
                                    <video 
                                        class="w-100 rounded-top" 
                                        controls 
                                        preload="metadata"
                                        poster="{{ url('assets/images/video-poster-1.jpg') }}"
                                        style="height: 350px; object-fit: cover;">
                                        <source src="{{ url('assets/videos/vid1.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div class="p-3">
                                    <h5 class="card-title mb-2">Andaman Ferry Experience</h5>
                                    <p class="card-text text-muted small">Experience the smooth and comfortable ferry journey to the beautiful islands of Andaman.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body p-0">
                                <div class="video-container">
                                    <video 
                                        class="w-100 rounded-top" 
                                        controls 
                                        preload="metadata"
                                        poster="{{ url('assets/images/video-poster-2.jpg') }}"
                                        style="height: 350px; object-fit: cover;">
                                        <source src="{{ url('assets/videos/vid2.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div class="p-3">
                                    <h5 class="card-title mb-2">Island Adventures</h5>
                                    <p class="card-text text-muted small">Discover the pristine beaches and crystal clear waters of Havelock and Neil Islands.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body p-0">
                                <div class="video-container">
                                    <video 
                                        class="w-100 rounded-top" 
                                        controls 
                                        preload="metadata"
                                        poster="{{ url('assets/images/video-poster-3.jpg') }}"
                                        style="height: 350px; object-fit: cover;">
                                        <source src="{{ url('assets/videos/vid3.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div class="p-3">
                                    <h5 class="card-title mb-2">Booking Made Easy</h5>
                                    <p class="card-text text-muted small">See how easy it is to book your ferry tickets with our simple and secure booking process.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center">
            <div id="lds-spinner" class="lds-spinner d-none">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </main>
@endsection

@push('js')
    <script type="text/javascript">
        function maxpassenger(element) {
            if (element.value < 1 || element.value > 20) {
                $(element).val('');
            }
        }

        // Set default date to tomorrow for one-way trips
        document.addEventListener('DOMContentLoaded', function() {
            const toDateInput = document.getElementById('date');
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

        // Set default date to today for round trips
        document.addEventListener('DOMContentLoaded', function() {
            const toDateInput = document.getElementById('round_date');
            const today = new Date();
            toDateInput.value = today.toISOString().split('T')[0];

            setInterval(() => {
                const today = new Date();
                toDateInput.value = today.toISOString().split('T')[0];
            }, 60 * 60 * 1000);
        });

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

        disableDiv();

        $(document).ready(function() {
            $('.tabBtn').click(function() {
                var list = $(this).data('list');
                $('.tabBtn').removeClass('active');
                $(this).addClass('active');

                if (list == 1) {
                    $('.tabs1').show();
                    $('.tabs2').hide();
                    enableDiv1();
                    disableDiv();
                    $('#trip_type').val('1');
                } else if (list == 2) {
                    $('.tabs1').hide();
                    $('.tabs2').show();
                    disableDiv1();
                    enableDiv();
                    $('#trip_type').val('2');
                }
            });

            // Copy passenger and infant values to round trip fields
            $('#passenger, #infant').on('input', function() {
                var passengerValue = $('#passenger').val();
                var infantValue = $('#infant').val();
                
                $('#round1_pasanger, #round2_pasanger').val(passengerValue);
                $('#round1_infants, #round2_infants').val(infantValue);
            });

            // Handle trip deletion
            $('.trip-delete').click(function() {
                $(this).closest('.row').remove();
            });
        });

        // Video functionality - using native controls
        document.addEventListener('DOMContentLoaded', function() {
            const videos = document.querySelectorAll('video');
            
            videos.forEach((video) => {
                // Ensure videos don't autoplay
                video.autoplay = false;
                
                // Add some basic styling for better UX
                video.addEventListener('loadstart', function() {
                    console.log('Video loading started');
                });
                
                video.addEventListener('canplay', function() {
                    console.log('Video can start playing');
                });
            });
        });
    </script>
@endpush

@push('css')
<style>
    .video-container {
        overflow: hidden;
        border-radius: 0.375rem 0.375rem 0 0;
    }

    video {
        transition: all 0.3s ease;
    }

    video:hover {
        transform: scale(1.02);
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }

    /* Mobile responsiveness fixes */
    @media (max-width: 768px) {
        video {
            height: 280px !important;
        }
        
        .achievement-banner .col-12 {
            margin-bottom: 1.5rem;
            display: block !important;
        }
        
        .achievement-banner .d-flex {
            justify-content: flex-start !important;
        }
        
        .achievement-banner .text-start {
            text-align: left !important;
        }
    }

    @media (max-width: 576px) {
        video {
            height: 250px !important;
        }
        
        .achievement-banner .col-12 {
            margin-bottom: 1.5rem;
            display: block !important;
        }
        
        .achievement-banner .me-3 {
            margin-right: 0.75rem !important;
        }
        
        .achievement-banner .bg-white {
            width: 50px !important;
            height: 50px !important;
        }
        
        .achievement-banner .bg-white img {
            max-width: 30px !important;
            max-height: 30px !important;
        }
        
        .achievement-banner .bg-white i {
            font-size: 18px !important;
        }
    }
    
    /* Ensure all achievement items are visible on mobile */
    @media (max-width: 991px) {
        .achievement-banner .col-12 {
            display: block !important;
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }
</style>
@endpush