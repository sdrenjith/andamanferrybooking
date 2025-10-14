// ===============================================
// SCROLL PERFORMANCE & ANTI-JITTER OPTIMIZATIONS
// ===============================================

$(document).ready(function() {
    // ===============================================
    // CRITICAL SCROLL PERFORMANCE OPTIMIZATION
    // ===============================================
    
    let ticking = false;
    let lastScrollTop = 0;
    let scrollTimer = null;
    
    // Optimized scroll handler with throttling
    function optimizedScrollHandler() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Only process if scroll position actually changed
        if (scrollTop !== lastScrollTop) {
            lastScrollTop = scrollTop;
            
            // Clear any existing timer
            if (scrollTimer) {
                clearTimeout(scrollTimer);
            }
            
            // Add scrolling class for CSS optimizations
            document.body.classList.add('is-scrolling');
            
            // Remove scrolling class after scroll ends
            scrollTimer = setTimeout(() => {
                document.body.classList.remove('is-scrolling');
                ticking = false;
            }, 150);
        }
        
        ticking = false;
    }
    
    // Throttled scroll event
    function requestScrollTick() {
        if (!ticking) {
            requestAnimationFrame(optimizedScrollHandler);
            ticking = true;
        }
    }
    
    // Use passive event listeners for better performance
    window.addEventListener('scroll', requestScrollTick, { 
        passive: true, 
        capture: false 
    });
    
    // ===============================================
    // MOBILE-SPECIFIC OPTIMIZATIONS
    // ===============================================
    
    const isMobile = window.innerWidth <= 767;
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    const isAndroid = /Android/.test(navigator.userAgent);
    
    if (isMobile) {
        // Disable problematic animations on mobile
        $('[data-aos]').each(function() {
            $(this).removeAttr('data-aos');
        });
        
        // Optimize iOS Safari scrolling
        if (isIOS) {
            $('body').css({
                '-webkit-overflow-scrolling': 'touch',
                'overflow-scrolling': 'touch'
            });
            
            // Fix iOS viewport height issues
            function setVHProperty() {
                let vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            }
            
            setVHProperty();
            window.addEventListener('resize', setVHProperty, { passive: true });
            window.addEventListener('orientationchange', setVHProperty, { passive: true });
        }
        
        // Optimize Android scrolling
        if (isAndroid) {
            document.body.style.overscrollBehavior = 'contain';
        }
        
        // Prevent zoom on double tap (can cause jitter)
        let lastTouchEnd = 0;
        document.addEventListener('touchend', function(event) {
            const now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, { passive: false });
        
        // Optimize touch scrolling performance
        document.addEventListener('touchstart', function() {
            // Add class for touch-based optimizations
            document.body.classList.add('touching');
        }, { passive: true });
        
        document.addEventListener('touchend', function() {
            setTimeout(() => {
                document.body.classList.remove('touching');
            }, 100);
        }, { passive: true });
    }
    
    // ===============================================
    // INTERSECTION OBSERVER FOR PERFORMANCE
    // ===============================================
    
    // Use Intersection Observer instead of scroll events for animations
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    // Unobserve after animation to improve performance
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        // Observe elements that need animation
        $('.feature-card, .info-card, .step-block').each(function() {
            observer.observe(this);
        });
    }
    
    // ===============================================
    // OPTIMIZED CAROUSEL INITIALIZATION
    // ===============================================
    
    // Owl Carousel with performance optimizations
    const owlConfig = {
        loop: false,
        margin: 20,
        responsiveClass: true,
        navigator: true,
        autoHeight: false,
        smartSpeed: 300,
        fluidSpeed: 300,
        // Disable on mobile to prevent jitter
        mouseDrag: !isMobile,
        touchDrag: isMobile,
        pullDrag: false,
        freeDrag: false,
        responsive: {
            0: {
                items: 1,
                nav: true,
                dots: false
            },
            600: {
                items: 2,
                nav: true,
                dots: false
            },
            1000: {
                items: 3,
                nav: true,
                dots: false
            },
            1400: {
                items: 4,
                nav: true,
                dots: false
            }
        }
    };
    
    // Initialize carousels with error handling
    function initializeCarousels() {
        try {
            if ($.fn.owlCarousel) {
                $('#packageCardSlider').owlCarousel(owlConfig);
                $('#ferryCardSlider').owlCarousel({...owlConfig, responsive: {
                    0: { items: 1, nav: true },
                    1000: { items: 2, nav: true }
                }});
                $('#topDestinations').owlCarousel({...owlConfig, responsive: {
                    0: { items: 1, nav: true },
                    467: { items: 2, nav: true },
                    600: { items: 3, nav: true },
                    1000: { items: 5, nav: true }
                }});
                $('#blogs').owlCarousel(owlConfig);
            }
        } catch (error) {
            console.warn('Carousel initialization failed:', error);
        }
    }
    
    // Initialize after DOM is ready
    setTimeout(initializeCarousels, 100);
    
    // ===============================================
    // OPTIMIZED NAVBAR FUNCTIONALITY
    // ===============================================
    
    let navbarOpen = false;
    
    $(".navbar-toggler").click(function(e) {
        e.preventDefault();
        
        const $this = $(this);
        const $navbar = $("#navbarNav");
        const $overlay = $(".overlay");
        
        navbarOpen = !navbarOpen;
        
        $this.toggleClass("show", navbarOpen);
        
        if (navbarOpen) {
            // Opening navbar
            $overlay.css('display', 'block');
            $("body").css('overflow', 'hidden');
            $navbar.addClass('show');
            
            // Prevent body scroll on mobile
            if (isMobile) {
                document.body.style.position = 'fixed';
                document.body.style.top = `-${window.scrollY}px`;
                document.body.style.width = '100%';
            }
        } else {
            // Closing navbar
            $overlay.css('display', 'none');
            $("body").css('overflow', 'auto');
            $navbar.removeClass('show');
            
            // Restore body scroll
            if (isMobile) {
                const scrollY = document.body.style.top;
                document.body.style.position = '';
                document.body.style.top = '';
                document.body.style.width = '';
                window.scrollTo(0, parseInt(scrollY || '0') * -1);
            }
        }
    });
    
    // Close navbar when clicking overlay
    $(document).on('click', '.overlay', function() {
        if (navbarOpen) {
            $(".navbar-toggler").click();
        }
    });
    
    // ===============================================
    // OPTIMIZED TAB FUNCTIONALITY
    // ===============================================
    
    $(".tabBtn1").addClass("active");
    $(".tabs1").css({"opacity": "1", "height": "auto"});
    $(".tabs2").css({"opacity": "0", "height": "0", "overflow": "hidden"});
    
    $(".tabBtn").click(function(e) {
        e.preventDefault();
        
        const $this = $(this);
        const tabNumber = $this.data("list");
        
        // Remove active class from siblings
        $this.siblings().removeClass("active");
        $this.addClass("active");
        
        // Hide all tabs first
        $(".tabs").css({
            "opacity": "0",
            "height": "0",
            "overflow": "hidden"
        });
        
        // Show selected tab with animation
        setTimeout(() => {
            $(`.tabs${tabNumber}`).css({
                "opacity": "1",
                "height": "auto",
                "overflow": "visible"
            });
        }, 50);
        
        // Update trip type
        $("#trip_type").val(tabNumber === 2 ? '3' : '1');
    });
    
    // ===============================================
    // OPTIMIZED DATE PICKER
    // ===============================================
    
    const dateOptions = {
        dateFormat: 'Y-m-d',
        minDate: "today", // Prevent selection of past dates
        maxDate: new Date().getFullYear() + 1 + "-12-31", // Allow up to next year
        animate: false, // Disable animation to prevent jitter
        changeMonth: true,
        changeYear: true,
        showAnim: '', // Disable show animation
        onReady: function(selectedDates, dateStr, instance) {
            // Disable past months and years in the calendar
            const today = new Date();
            const currentMonth = today.getMonth();
            const currentYear = today.getFullYear();
            
            // Disable past months in current year
            const monthElements = instance.calendarContainer.querySelectorAll('.flatpickr-monthDropdown-months');
            if (monthElements.length > 0) {
                const monthDropdown = monthElements[0];
                const options = monthDropdown.querySelectorAll('option');
                options.forEach((option, index) => {
                    if (index < currentMonth) {
                        option.disabled = true;
                    }
                });
            }
        },
        onSelect: function() {
            // Force reflow to prevent layout issues
            this.blur();
        }
    };
    
    // Initialize date pickers with error handling
    try {
        if ($.fn.flatpickr) {
            // Check if we're on the boat booking page - if so, skip #date initialization
            const isBoatBookingPage = window.location.pathname.includes('boat-booking') || 
                                     window.location.pathname.includes('boat/boat-booking');
            
            if (isBoatBookingPage) {
                // On boat booking page, only initialize other date fields, not #date
                $('#round_date, #round1_date, #round2_date').each(function() {
                    if (!$(this).data('flatpickr')) {
                        $(this).flatpickr(dateOptions);
                    }
                });
            } else {
                // Check if we're on the homepage - if so, skip initialization to let homepage handle it
                const isHomepage = window.location.pathname === '/' || 
                                  window.location.pathname.includes('home') ||
                                  window.location.pathname.includes('index');
                
                if (!isHomepage) {
                    // On other pages, initialize all date fields including #date
                    $('#date, #round_date, #round1_date, #round2_date').each(function() {
                        if (!$(this).data('flatpickr')) {
                            $(this).flatpickr(dateOptions);
                        }
                    });
                }
            }
        } else if ($.fn.datepicker) {
            $('.my_date_picker').datepicker({
                dateFormat: 'dd-mm-yy',
                defaultDate: "today",
                minDate: 0,
                changeMonth: true,
                changeYear: true,
                showAnim: '' // Disable animation
            });
        }
    } catch (error) {
        console.warn('Date picker initialization failed:', error);
    }
    
    // ===============================================
    // FORM OPTIMIZATION
    // ===============================================
    
    // Optimize passenger input
    function maxpassenger(element) {
        const value = parseInt(element.value);
        if (isNaN(value) || value < 1 || value > 20) {
            element.value = '';
        }
    }
    
    // Add to global scope for inline handlers
    window.maxpassenger = maxpassenger;
    
    // Optimize form submission
    $(document).on('click', "#search, #round_search", function(e) {
        const $spinner = $("#lds-spinner");
        if ($spinner.length) {
            $spinner.removeClass('d-none');
        }
        
        // Add small delay to show spinner before form submission
        setTimeout(() => {
            // Form will submit naturally
        }, 100);
    });
    
    // ===============================================
    // PERFORMANCE MONITORING
    // ===============================================
    
    // Log performance issues in development
    if (window.location.hostname === 'localhost' || window.location.hostname.includes('127.0.0.1')) {
        let performanceObserver;
        
        if ('PerformanceObserver' in window) {
            performanceObserver = new PerformanceObserver((list) => {
                list.getEntries().forEach((entry) => {
                    if (entry.duration > 16) { // Longer than 1 frame at 60fps
                        console.warn('Long task detected:', entry.duration + 'ms', entry);
                    }
                });
            });
            
            try {
                performanceObserver.observe({ entryTypes: ['longtask'] });
            } catch (error) {
                console.warn('Performance observer not supported');
            }
        }
    }
    
    // ===============================================
    // RESIZE HANDLER OPTIMIZATION
    // ===============================================
    
    let resizeTimer;
    
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            // Recalculate any layout-dependent elements
            if (isMobile && window.innerWidth > 767) {
                // Switched to desktop - reload if needed
                location.reload();
            } else if (!isMobile && window.innerWidth <= 767) {
                // Switched to mobile - reload if needed
                location.reload();
            }
        }, 250);
    });
    
    // ===============================================
    // IMMEDIATE OPTIMIZATIONS
    // ===============================================
    
    // Set initial date values
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowString = tomorrow.toISOString().split('T')[0];
    
    $('#date, #round1_date').val(tomorrowString);
    
    const dayAfterTomorrow = new Date();
    dayAfterTomorrow.setDate(dayAfterTomorrow.getDate() + 2);
    $('#round2_date').val(dayAfterTomorrow.toISOString().split('T')[0]);
    
    // Optimize initial tab state
    $("#trip_type").val('1');
    
    // Force initial layout to prevent FOUC
    setTimeout(() => {
        $('body').addClass('loaded');
    }, 100);
    
    // ===============================================
    // CLEANUP ON PAGE UNLOAD
    // ===============================================
    
    $(window).on('beforeunload', function() {
        // Cancel any running animations
        $('*').stop(true, true);
        
        // Clear timers
        if (scrollTimer) clearTimeout(scrollTimer);
        if (resizeTimer) clearTimeout(resizeTimer);
        
        // Disconnect observers
        if (typeof observer !== 'undefined') observer.disconnect();
        if (performanceObserver) performanceObserver.disconnect();
    });
});

// ===============================================
// ADDITIONAL CSS OPTIMIZATIONS VIA JAVASCRIPT
// ===============================================

// Add CSS optimizations that need to be dynamic
const styleSheet = document.createElement('style');
styleSheet.textContent = `
    /* Additional mobile scroll optimizations */
    @media (max-width: 767px) {
        body.is-scrolling {
            pointer-events: none;
        }
        
        body.is-scrolling * {
            pointer-events: none;
        }
        
        body.touching {
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
        }
        
        .loaded {
            visibility: visible;
        }
    }
    
    /* Optimize animations for 60fps */
    @media (prefers-reduced-motion: no-preference) {
        .feature-card,
        .info-card,
        .step-block {
            transition: opacity 0.3s ease, box-shadow 0.3s ease;
        }
    }
    
    /* Disable animations for users who prefer reduced motion */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
`;

document.head.appendChild(styleSheet);