<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="tQEHX8VUt_rcCaxLkD6xl_pUzDFhPfyqeJFtpfu-xU8" />
    <meta name="title"
        content="The Ultimate Guide to Andaman Ferry Booking: A Stress-Free Experience to Explore Paradise">
    <meta name="description"
        content="Discover everything you need to know about Andaman ferry booking. From routes to schedules, ensure a hassle-free experience as you explore Port Blair, Havelock, and Neil Island. Start planning your paradise adventure today.">
    <meta name="google-site-verification" content="JPrLU44c0wy90nU6w5dzciHXTduGuLWHUC2S21j7fJU" />
    <title>Home</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/images/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity=""
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        integrity="" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity=""
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Google tag (gtag.js) -->
    <script async src="" https://www.googletagmanager.com/gtag/js?id=AW-478149191""></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-478149191');
    </script>

    <!-- Google tag (gtag.js) event - delayed navigation helper -->
    <script>
        // Helper function to delay opening a URL until a gtag event is sent.
        // Call it in response to an action that should navigate to a URL.
        function gtagSendEvent(url) {
            var callback = function() {
                if (typeof url === 'string') {
                    window.location = url;
                }
            };
            gtag('event', 'ads_conversion_Contact_Us_1', {
                'event_callback': callback,
                'event_timeout': 2000,
                // <event_parameters>
            });
            return false;
        }
    </script>

    <!-- Google tag (gtag.js) event - delayed navigation helper -->
    <script>
        // Helper function to delay opening a URL until a gtag event is sent.
        // Call it in response to an action that should navigate to a URL.
        function gtagSendEvent(url) {
            var callback = function() {
                if (typeof url === 'string') {
                    window.location = url;
                }
            };
            gtag('event', 'ads_conversion_Andaman_ferry_booking_1', {
                'event_callback': callback,
                'event_timeout': 2000,
                // <event_parameters>
            });
            return false;
        }
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-N9H3ZXR9');
    </script>
    <!-- End Google Tag Manager -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />

</head>

<body>
    <div class="overlay"></div>
    {{-- <div class="ad text-center py-2 text-white">
        <p class="m-0"> FLAT Rs 100/- OFF ON ALL FERRY BOOKINGS (ONLY FOR NAUTIKA & MAKRUZZ)</p>
    </div> --}}
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg py-2">
                <div class="container-fluid justify-content-between flex-row-reverse flex-lg-row">
                    <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/images/logo.png') }}"
                            alt="image"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-view-list" id="menu"></i>
                        <i class="bi bi-x-lg" id="menuclose"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link menuBtn {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menuBtn {{ Request::is('search-result-ferry*') ? 'active' : '' }}" href="https://andamanferrybooking.com">Ferry Ticket Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menuBtn {{ Request::is('boat-booking*') ? 'active' : '' }}" href="{{ url('boat-booking') }}">Boat Booking</a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link menuBtn {{ Request::is('blog_list*') ? 'active' : '' }}" href="{{ url('blog_list') }}">Travel Guide</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menuBtn {{ Request::is('cancellation-refund*') ? 'active' : '' }}" href="{{ url('/cancellation-refund') }}">Cancel/Reschedule</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menuBtn {{ Request::is('contact-us*') ? 'active' : '' }}" href="{{ url('contact-us') }}">Contact Us</a>
                            </li>
                            <div class="desktop mb-visible">
                                <a class="btn quoteBtn"
                                    href="{{ url('search-result-ferry') }}?trip_type=1&form_location=1&to_location=2&date={{ date('Y-m-d') }}&passenger=1&infant=0">Book
                                    Now</a>
                            </div>

                        </ul>
                        <div class="desktop dk-visible">
                            <a class="btn quoteBtn"
                                href="{{ url('search-result-ferry') }}?trip_type=1&form_location=1&to_location=2&date={{ date('Y-m-d') }}&passenger=1&infant=0">Book
                                Now</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    @yield('content')
    <footer class="modern-footer w-100" data-aos="fade-up" data-aos-duration="1200" style="background: #0b2e36; color: #f5f7fa; margin-top: 0; padding-top: 3rem; padding-bottom: 2rem;">
        <div class="container-fluid px-5">
            <div class="row justify-content-center align-items-center text-center gy-4">
                <div class="col-12 col-lg-3 mb-4 mb-lg-0 d-flex flex-column align-items-center">
                    <a href="https://andamanferrybooking.com/"><img src="{{ asset('assets/images/andaman_ferry_logo_header.png') }}" width="220" alt="Andaman Ferry Logo" class="mb-3"></a>
                    <div class="footer-logos d-flex flex-wrap justify-content-center gap-3 mb-3">
                        <img src="{{ asset('assets/images/logo/tourismlogo1.png') }}" width="130" alt="Tourism">
                        <img src="{{ asset('assets/images/logo/Incredible india.png') }}" width="130" alt="Incredible India">
                        <img src="{{ asset('assets/images/start-up-india-logo.png') }}" width="130" alt="Startup India">
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-4 mb-lg-0 d-flex flex-column align-items-center">
                    <h5 class="footer-title">Contact Information</h5>
                    <ul class="footer-list mb-3">
                        <li>1st floor, Premnagar Muthoot Finance Building<br>Port Blair, Andaman and Nicobar Island<br>PIN code 744102</li>
                        <li><a href="mailto:andamanferrybookings@gmail.com"><i class="bi bi-envelope-at"></i> andamanferrybookings@gmail.com</a></li>
                        <li><a href="tel:+91 9679061419"><i class="bi bi-telephone"></i> +91 9679061419 / 9933281206</a></li>
                        <li><a href="https://wa.me/919933281206" target="_blank"><i class="bi bi-whatsapp"></i> +91 9933281206</a></li>
                    </ul>
                    <div class="footer-social mt-2">
                        <a href="https://www.instagram.com/andamanferrybooking" target="_blank"><img src="{{ asset('assets/images/instagram.svg') }}" width="36" alt="Instagram"></a>
                        <a href="https://www.facebook.com/profile.php?id=61551926759700" target="_blank"><img src="{{ asset('assets/images/facebook.svg') }}" width="36" alt="Facebook"></a>
                        <a href="https://g.co/kgs/QszVZdd" target="_blank"><img src="images/google.png" width="32" alt="Google"></a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mb-4 mb-lg-0 d-flex flex-column align-items-center">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-list">
                        <li><a href="{{ url('/terms-and-conditions') }}">Terms and Conditions</a></li>
                        <li><a href="{{ url('/privacy-policy') }}">Privacy and Policies</a></li>
                        <li><a href="{{ url('/cancellation-refund') }}">Cancellation Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center small text-muted">
                    &copy; {{ date('Y') }} Andaman Ferry Booking. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <!-- BOOKING SUMMARY MODAL -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Log In</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="error_msg" style="color: red"></span>
                    <form id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputpassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                aria-describedby="emailHelp">
                        </div>

                        {{-- <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">OTP</label>
                            <input type="number" class="form-control" pattern="\d*" maxlength="6" id="otp" style="display: none">
                        </div> --}}

                        {{-- <input type="hidden" name="boatScheduleId" id="boatScheduleId">
                        
                        <input type="hidden" name="ferryScheduleId" id="ferryScheduleId">
                        <input type="hidden" name="ferryclassId" id="ferryClassId"> --}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="login">Login</button>
                            {{-- <button type="button" class="btn btn-pr imary login-in-btn" style="display: none"
                                id="login">Login</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- <div class="modal fade" id="phoneVerificationModal" tabindex="-1" aria-labelledby="phoneVerificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="">
                <div class="modal-header" style="background: #0076ae; color:#FFF">
                    <h5 class="modal-title" id="phoneVerificationModalLabel">Register to Procced</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Mobile Number Input -->
                    <div class="mb-3">
                        <label for="mobileNumber" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobileNumber" name="abc" placeholder="Enter mobile number" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>
                        <div class="invalid-feedback">
                            Please enter a valid 10-digit mobile number.
                        </div>
                    </div>
                    <!-- OTP Input -->
                    <div class="mb-3" id="otpInput" style="display: none;">
                        <label for="otp" class="form-label">OTP</label>
                        <input type="text" class="form-control" id="otp" placeholder="Enter OTP">
                    </div>

                    <div class="mb-3" id="not_matched" style="display: none;">
                        <label class="form-label" style="color:#FF0000">OTP does not matched</label>
                    </div>

                    <div class="mb-3" id="otp_matched" style="display: none;">
                        <label for="otp" class="form-label" style=" color: #008000; border: 1px solid #008000; padding: 4px;
    border-radius: 3px">OTP Matched</label>
                    </div>
                    <button type="button" class="btn btn-primary" id="sendOTPButton">Send OTP</button>
                    <button type="button" class="btn btn-primary" id="verifyOTPButton" style="display: none;">Verify OTP</button>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Save</button> -->
                    <div class="btn " id="procced_button" style="display: none;">
                        <button type="button" id="procced_button" style="background: #0076ae; padding: 5px 25px; border-radius: 5px;">Procced</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity=""
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity=""
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ url('assets/js/script.js') }}?v=1"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N9H3ZXR9" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @stack('js')
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();

                sendDataViaAjax(email, password);
            });


            function sendDataViaAjax(email, password) {
                $.ajax({
                    url: "{{ url('login-check') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            $('#loginModal').modal('hide');
                            window.location.reload();

                        } else {
                            $('#error_msg').text(response.error);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // console.error(textStatus, errorThrown);
                    }
                });
            }

            $('#logout').on('click', function(e) {
                $.ajax({
                    url: "{{ url('logout') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.reload();
                            alert('Logout Successfull');
                        } else {
                            $('#error_msg').text(response.error);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // console.error(textStatus, errorThrown);
                    }
                });

            })

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>AOS.init();</script>
    <script>
        window.addEventListener('load', () => {
            AOS.refresh();
        });
    </script>

</body>

</html>
