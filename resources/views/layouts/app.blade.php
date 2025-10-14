<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="tQEHX8VUt_rcCaxLkD6xl_pUzDFhPfyqeJFtpfu-xU8" />
    <meta name="google-site-verification" content="JPrLU44c0wy90nU6w5dzciHXTduGuLWHUC2S21j7fJU" />

    <title>@yield('title', 'Andaman Ferry Booking')</title>
    <meta name="title" content="@yield('meta_title', 'Andaman Ferry Booking')">
    <meta name="description" content="@yield('meta_description', 'Book ferry & boat tickets in Andaman – schedules, prices, instant booking.')">

    {{-- Social share tags --}}
    <meta property="og:title" content="@yield('title', 'Andaman Ferry Booking')">
    <meta property="og:description" content="@yield('meta_description', 'Book ferry & boat tickets in Andaman – schedules, prices, instant booking.')">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/images/favicon.ico') }}">

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}?v=4">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" crossorigin="anonymous">
    {{-- Keep only one Font Awesome include --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Custom Navigation Styles -->
    <style>
        .navbar-nav .nav-link {
            font-size: 10px;
            font-weight: 500;
            padding: 0.15rem 0.25rem;
            color: #333;
            transition: color 0.3s ease;
            position: relative;
        }
        .navbar-nav .nav-link:hover { color: #0097a7; }
        .navbar-nav .nav-link.active { color: #0097a7; font-weight: 600; border-bottom: none; }
        .navbar-nav .nav-link.active::after {
            content: ''; display: block; position: absolute; left: 0; right: 0; bottom: 0.18rem;
            height: 2px; border-radius: 1px; background: #0097a7; transform: scaleX(1); transition: transform 0.22s; z-index: 2;
        }
        .navbar-brand img { max-height: 45px; width: auto; }
        .quoteBtn { background-color: #0097a7; border: none; color: white; font-weight: 600; font-size: 12px; border-radius: 18px; padding: 0.4rem 0.8rem; transition: all 0.3s ease; }
        .quoteBtn:hover { background-color: #007a87; color: white; transform: translateY(-1px); }
        .navbar { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .navbar-nav .nav-item { margin-right: 0.2rem; }
        .navbar-nav { gap: 0.1rem; }
        @media (max-width: 991.98px) {
            .navbar-nav .nav-link { font-size: 9px; padding: 0.3rem 0.4rem; }
            .navbar-brand img { max-height: 35px; }
        }

        /* Floating WhatsApp & Call Buttons */
        .floating-buttons {
            position: fixed;
            bottom: 100px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 15px;
            transition: all 0.3s ease;
        }
        .floating-buttons a {
            width: 55px; height: 55px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white !important; font-size: 24px; text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
        .floating-buttons .whatsapp-btn { background-color: #25D366; }
        .floating-buttons .call-btn { background-color: #1e90ff; }
    </style>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-478149191"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-478149191');

        // Conversion helpers (use different names to avoid overriding)
        function gtagSendContactConversion(url){
            var callback = function(){ if (typeof url === 'string') window.location = url; };
            gtag('event', 'ads_conversion_Contact_Us_1', { 'event_callback': callback, 'event_timeout': 2000 });
            return false;
        }
        function gtagSendFerryConversion(url){
            var callback = function(){ if (typeof url === 'string') window.location = url; };
            gtag('event', 'ads_conversion_Andaman_ferry_booking_1', { 'event_callback': callback, 'event_timeout': 2000 });
            return false;
        }
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
            var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true; j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-N9H3ZXR9');
    </script>
    <!-- End Google Tag Manager -->
    <!-- REMOVED AOS CSS for mobile scroll performance -->
</head>

<body>
    <div class="overlay"></div>

    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg py-2">
                <div class="container-fluid justify-content-between flex-row-reverse flex-lg-row">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="image">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-view-list" id="menu"></i>
                        <i class="bi bi-x-lg" id="menuclose"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link menuBtn {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link menuBtn {{ Request::is('ferry-booking*') ? 'active' : '' }}" href="{{ url('ferry-booking') }}">Ferry Ticket Booking</a></li>
                            <li class="nav-item"><a class="nav-link menuBtn {{ Request::is('boat-booking*') ? 'active' : '' }}" href="{{ url('boat-booking') }}">Boat Booking</a></li>
                            <li class="nav-item"><a class="nav-link menuBtn {{ Request::is('ferry-schedule*') ? 'active' : '' }}" href="{{ url('ferry-schedule') }}">Available Schedule</a></li>
                            <li class="nav-item"><a class="nav-link menuBtn {{ Request::is('blog_list*') ? 'active' : '' }}" href="{{ url('blog_list') }}">Travel Guide</a></li>
                            <li class="nav-item"><a class="nav-link menuBtn {{ Request::is('cancellation-refund*') ? 'active' : '' }}" href="{{ url('/cancellation-refund') }}">Cancel/Reschedule</a></li>
                            <li class="nav-item"><a class="nav-link menuBtn {{ Request::is('contact-us*') ? 'active' : '' }}" href="{{ url('contact-us') }}">Contact Us</a></li>
                            <div class="desktop mb-visible">
                                <a class="btn quoteBtn"
                                   href="{{ url('search-result-ferry') }}?trip_type=1&form_location=1&to_location=2&date={{ date('Y-m-d') }}&passenger=1&infant=0">Book Now</a>
                            </div>
                        </ul>
                        <div class="desktop dk-visible">
                            <a class="btn quoteBtn"
                               href="{{ url('search-result-ferry') }}?trip_type=1&form_location=1&to_location=2&date={{ date('Y-m-d') }}&passenger=1&infant=0">Book Now</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    {{-- Floating WhatsApp & Call Buttons (now correctly inside <body>) --}}
    <div class="floating-buttons">
        <a href="https://wa.me/919933281206" target="_blank" class="whatsapp-btn" aria-label="WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a href="tel:+919679061419" class="call-btn" aria-label="Call">
            <i class="fa-solid fa-phone"></i>
        </a>
    </div>

    @yield('content')

    <footer class="modern-footer w-100 mobile-scroll-safe" style="background: #0b2e36; color: #f5f7fa; margin-top: 0; padding-top: 3rem; padding-bottom: 2rem;">
        <div class="container-fluid px-5">
            <div class="row gy-4">
                <!-- Left Column: Logo and Social Icons -->
                <div class="col-12 col-lg-4 footer-left">
                    <a href="https://andamanferrybooking.com/"><img src="{{ asset('assets/images/andaman_ferry_logo_header.png') }}" width="220" alt="Andaman Ferry Logo" class="mb-3"></a>
                    <div class="footer-logos d-flex flex-wrap gap-3 mb-3">
                        <img src="{{ asset('assets/images/logo/tourismlogo1.png') }}" width="130" alt="Tourism">
                        <img src="{{ asset('assets/images/logo/Incredible india.png') }}" width="130" alt="Incredible India">
                        <img src="{{ asset('assets/images/start-up-india-logo.png') }}" width="130" alt="Startup India">
                    </div>
                    <div class="footer-social">
                        <a href="https://www.instagram.com/andamanferrybooking" target="_blank"><img src="{{ asset('assets/images/instagram.svg') }}" width="36" alt="Instagram"></a>
                        <a href="https://www.facebook.com/profile.php?id=61551926759700" target="_blank"><img src="{{ asset('assets/images/facebook.svg') }}" width="36" alt="Facebook"></a>
                        <a href="https://g.co/kgs/QszVZdd" target="_blank"><img src="{{ asset('assets/images/google.png') }}" width="32" alt="Google"></a>
                    </div>
                </div>
                
                <!-- Center Column: Contact Information -->
                <div class="col-12 col-lg-4 footer-center">
                    <h5 class="footer-title">Contact Information</h5>
                    <ul class="footer-list mb-3">
                        <li>1st floor, Premnagar Muthoot Finance Building<br>Port Blair, Andaman and Nicobar Island<br>PIN code 744102</li>
                        <li><a href="mailto:andamanferrybookings@gmail.com"><i class="bi bi-envelope-at"></i> andamanferrybookings@gmail.com</a></li>
                        <li><a href="tel:+91 9679061419"><i class="bi bi-telephone"></i> +91 9679061419</a></li>
                        <li><a href="https://wa.me/+919933281206" target="_blank"><i class="bi bi-whatsapp"></i> +91 9933281206</a></li>
                    </ul>
                </div>
                
                <!-- Right Column: Quick Links -->
                <div class="col-12 col-lg-4 footer-right">
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

    <!-- LOGIN MODAL -->
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
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputpassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JS (order matters: jQuery -> Bootstrap -> plugins -> your scripts) --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ url('assets/js/script.js') }}?v=1"></script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N9H3ZXR9" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
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
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: { email: email, password: password },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#loginModal').modal('hide');
                            window.location.reload();
                        } else {
                            $('#error_msg').text(response.error);
                        }
                    },
                    error: function() { /* silent */ }
                });
            }

            $('#logout').on('click', function() {
                $.ajax({
                    url: "{{ url('logout') }}",
                    type: 'POST',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.reload();
                            alert('Logout Successfull');
                        } else {
                            $('#error_msg').text(response.error);
                        }
                    },
                    error: function() { /* silent */ }
                });
            });
        });
    </script>

    <!-- Mobile scroll performance optimization -->
    <script>
        window.addEventListener('load', () => {
            if (window.innerWidth <= 767) {
                document.body.style.webkitOverflowScrolling = 'auto';
                document.body.style.overflowScrolling = 'auto';
                document.body.style.overscrollBehavior = 'auto';
                document.documentElement.style.scrollBehavior = 'auto';
                if ('scrollRestoration' in history) {
                    history.scrollRestoration = 'manual';
                }
                setTimeout(() => { window.scrollTo(0, 0); }, 100);
            }
        });
    </script>

    <!-- AI Chatbot Widget -->
    <div id="chatbot-widget" class="chatbot-container">
        <div id="chatbot-toggle" class="chatbot-toggle">
            <i class="bi bi-chat-dots-fill"></i>
            <span class="chatbot-pulse"></span>
        </div>

        <div id="chatbot-window" class="chatbot-window">
            <div class="chatbot-header">
                <div class="chatbot-avatar"><i class="bi bi-robot"></i></div>
                <div class="chatbot-info">
                    <h6 class="mb-0">AI Assistant</h6>
                    <small class="text-muted">Online</small>
                </div>
                <button id="chatbot-close" class="chatbot-close"><i class="bi bi-x"></i></button>
            </div>

            <div class="chatbot-messages" id="chatbot-messages">
                <div class="chatbot-loading">
                    <div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>
                    <span>Loading AI Assistant...</span>
                </div>
            </div>

            <div class="chatbot-input-container">
                <div class="chatbot-input-wrapper">
                    <input type="text" id="chatbot-input" class="chatbot-input" placeholder="Type your message...">
                    <button id="chatbot-send" class="chatbot-send"><i class="bi bi-send"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Chatbot Styles -->
    <style>
        .chatbot-container { position: fixed; bottom: 20px; right: 20px; z-index: 1000; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif; }
        .chatbot-toggle { width: 60px; height: 60px; background: linear-gradient(135deg,#008495 0%,#00a0b7 100%); border-radius: 50%; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow:0 4px 20px rgba(0,132,149,0.3); transition: all .3s ease; position: relative; }
        .chatbot-toggle:hover { transform: scale(1.1); box-shadow:0 6px 25px rgba(0,132,149,0.4); }
        .chatbot-toggle i { color:#fff; font-size:24px; }
        .chatbot-pulse { position:absolute; width:100%; height:100%; border-radius:50%; background: rgba(0,132,149,.3); animation:pulse 2s infinite; }
        @keyframes pulse { 0%{transform:scale(1);opacity:1;} 100%{transform:scale(1.4);opacity:0;} }
        .chatbot-window { position:absolute; bottom:80px; right:0; width:350px; height:500px; background:#fff; border-radius:15px; box-shadow:0 10px 30px rgba(0,0,0,.2); display:none; flex-direction:column; overflow:hidden; }
        .chatbot-window.active { display:flex; }
        .chatbot-header { background: linear-gradient(135deg,#008495 0%,#00a0b7 100%); color:#fff; padding:15px; display:flex; align-items:center; gap:10px; }
        .chatbot-avatar { width:40px; height:40px; background: rgba(255,255,255,.2); border-radius:50%; display:flex; align-items:center; justify-content:center; }
        .chatbot-close { background:none; border:none; color:#fff; font-size:20px; cursor:pointer; padding:8px; border-radius:50%; transition:all 0.3s ease; margin-left:auto; min-width:36px; min-height:36px; display:flex; align-items:center; justify-content:center; }
        .chatbot-close:hover { background:rgba(255,255,255,0.2); transform:scale(1.1); }
        .chatbot-close:active { transform:scale(0.95); }
        .chatbot-messages { flex:1; padding:15px; overflow-y:auto; background:#f8f9fa; }
        .chatbot-loading { display:flex; align-items:center; gap:10px; color:#666; font-size:14px; }
        .message { margin-bottom:15px; display:flex; align-items:flex-start; gap:10px; }
        .message-avatar { width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px; flex-shrink:0; }
        .message.user { flex-direction: row-reverse; }
        .message.user .message-avatar { background:#008495; color:#fff; }
        .message.bot .message-avatar { background:#e9ecef; color:#666; }
        .message-content { max-width:80%; padding:10px 15px; border-radius:15px; font-size:14px; line-height:1.4; }
        .message.user .message-content { background:#008495; color:#fff; border-bottom-right-radius:5px; }
        .message.bot .message-content { background:#fff; color:#333; border:1px solid #e9ecef; border-bottom-left-radius:5px; }
        .chatbot-input-container { padding:15px; background:#fff; border-top:1px solid #e9ecef; }
        .chatbot-input-wrapper { display:flex; gap:10px; align-items:center; }
        .chatbot-input { flex:1; padding:10px 15px; border:1px solid #e9ecef; border-radius:25px; outline:none; font-size:14px; transition: border-color .3s ease; }
        .chatbot-input:focus { border-color:#008495; }
        .chatbot-send { width:40px; height:40px; background:#008495; color:#fff; border:none; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; transition: background .3s ease; }
        .chatbot-send:hover { background:#006d7a; }
        .chatbot-send:disabled { background:#ccc; cursor:not-allowed; }
        @media (max-width: 768px) {
            .chatbot-container { bottom: 15px; right: 15px; }
            .chatbot-window { width: calc(100vw - 30px); height: calc(100vh - 100px); bottom: 80px; right: -15px; border-radius: 15px 15px 0 0; }
            .chatbot-toggle { width: 50px; height: 50px; }
            .chatbot-toggle i { font-size: 20px; }
            .chatbot-close { font-size: 18px; padding: 8px; min-width: 36px; min-height: 36px; display: flex; align-items: center; justify-content: center; }
        }
    </style>

    <!-- Chatbot JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatbotToggle = document.getElementById('chatbot-toggle');
            const chatbotWindow = document.getElementById('chatbot-window');
            const chatbotClose = document.getElementById('chatbot-close');
            const chatbotInput = document.getElementById('chatbot-input');
            const chatbotSend = document.getElementById('chatbot-send');
            const chatbotMessages = document.getElementById('chatbot-messages');

            let isOpen = false;
            let isLoading = false;

            chatbotToggle.addEventListener('click', function() { isOpen ? closeChatbot() : openChatbot(); });
            chatbotClose.addEventListener('click', closeChatbot);

            function openChatbot() {
                isOpen = true;
                chatbotWindow.classList.add('active');
                chatbotInput.focus();
                hideFloatingButtons(); // Hide floating buttons
                if (chatbotMessages.children.length === 1) loadInitialMessage();
            }
            function closeChatbot() { 
                isOpen = false; 
                chatbotWindow.classList.remove('active'); 
                showFloatingButtons(); // Show floating buttons
            }

            function hideFloatingButtons() {
                const floatingButtons = document.querySelector('.floating-buttons');
                if (floatingButtons) {
                    floatingButtons.style.opacity = '0';
                    floatingButtons.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        floatingButtons.style.display = 'none';
                        // Completely disable pointer events and make buttons non-functional
                        const buttons = floatingButtons.querySelectorAll('a');
                        buttons.forEach(button => {
                            button.style.pointerEvents = 'none';
                            button.style.opacity = '0';
                            button.style.visibility = 'hidden';
                        });
                    }, 300);
                }
            }

            function showFloatingButtons() {
                const floatingButtons = document.querySelector('.floating-buttons');
                if (floatingButtons) {
                    // Re-enable pointer events and make buttons functional again
                    const buttons = floatingButtons.querySelectorAll('a');
                    buttons.forEach(button => {
                        button.style.pointerEvents = 'auto';
                        button.style.opacity = '1';
                        button.style.visibility = 'visible';
                    });
                    
                    floatingButtons.style.display = 'flex';
                    floatingButtons.style.opacity = '0';
                    floatingButtons.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        floatingButtons.style.opacity = '1';
                        floatingButtons.style.transform = 'translateY(0)';
                    }, 10);
                }
            }

            function loadInitialMessage() {
                showLoading(true);
                fetch('/api/chatbot/initial')
                    .then(r => r.json())
                    .then(data => { showLoading(false); addMessage('bot', data.message); })
                    .catch(() => { showLoading(false); addMessage('bot', "Hello! I'm your AI assistant for Andaman Ferry Booking. How can I help you today?"); });
            }

            function addMessage(sender, content) {
                const wrap = document.createElement('div'); wrap.className = `message ${sender}`;
                const avatar = document.createElement('div'); avatar.className = 'message-avatar'; avatar.textContent = sender === 'user' ? 'U' : 'AI';
                const bubble = document.createElement('div'); bubble.className = 'message-content'; bubble.textContent = content;
                wrap.appendChild(avatar); wrap.appendChild(bubble); chatbotMessages.appendChild(wrap);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }
            function showLoading(show) {
                const el = chatbotMessages.querySelector('.chatbot-loading');
                if (el) el.style.display = show ? 'flex' : 'none';
            }

            function sendMessage() {
                const message = chatbotInput.value.trim();
                if (!message || isLoading) return;
                addMessage('user', message);
                chatbotInput.value = ''; chatbotSend.disabled = true; isLoading = true; showLoading(true);

                fetch('/api/chatbot/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ message })
                })
                .then(r => r.json())
                .then(data => { showLoading(false); addMessage('bot', data.success ? data.message : (data.message || "Sorry, I couldn't process your request. Please try again.")); })
                .catch(() => { showLoading(false); addMessage('bot', 'Sorry, I\'m having trouble connecting. Please try again later.'); })
                .finally(() => { chatbotSend.disabled = false; isLoading = false; });
            }

            chatbotSend.addEventListener('click', sendMessage);
            chatbotInput.addEventListener('keypress', function(e) { if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); } });
        });
    </script>
</body>
</html>
