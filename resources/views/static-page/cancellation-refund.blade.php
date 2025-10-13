@extends('layouts.app')

@section('title', 'Andaman Ferry: Online Booking, Cancel & Reschedule')
@section('meta_title', 'Andaman Ferry: Online Booking, Cancel & Reschedule')
@section('meta_description', 'Book your Andaman ferry online with ease. Learn how to cancel or reschedule tickets hassle-free for Havelock, Neil Island, and other popular routes.')

@section('content')
<style>
    :root {
        --primary-color: #2dd4bf;
        --primary-dark: #0d9488;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --text-light: #9ca3af;
        --border-light: #e5e7eb;
        --bg-light: #f9fafb;
        --bg-white: #ffffff;
        --transition: all 0.2s ease;
    }

    .policy-page * {
        box-sizing: border-box;
    }

    .policy-page {
        background: var(--bg-white);
        min-height: 100vh;
    }

    .modern-hero {
        position: relative;
        background: linear-gradient(135deg, rgba(20, 30, 48, 0.9), rgba(36, 59, 85, 0.8));
        min-height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .hero-content {
        text-align: center;
        z-index: 2;
        position: relative;
    }

    .hero-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    .hero-content p {
        font-size: 1.1rem;
        color: rgba(255,255,255,0.9);
        max-width: 600px;
        margin: 0 auto;
    }

    .breadcrumb {
        background: var(--bg-light);
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-light);
    }

    .breadcrumb-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .policy-page .breadcrumb a {
        color: var(--primary-color);
        text-decoration: none;
        transition: var(--transition);
    }

    .policy-page .breadcrumb a:hover {
        color: var(--primary-dark);
    }

    .main-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 1rem;
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 3rem;
    }

    .content-area {
        background: var(--bg-white);
    }

    .policy-section {
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--border-light);
    }

    .policy-section:last-child {
        border-bottom: none;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0 0 1.5rem 0;
        line-height: 1.3;
    }

    .subsection {
        margin: 2rem 0;
    }

    .subsection-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0 0 1rem 0;
    }

    .policy-text {
        color: var(--text-secondary);
        line-height: 1.7;
        margin: 1rem 0;
        font-size: 1rem;
    }

    .refund-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .refund-card {
        background: var(--bg-light);
        padding: 1.5rem;
        border-radius: 8px;
        border: 1px solid var(--border-light);
        transition: var(--transition);
        text-align: center;
    }

    .refund-card:hover {
        border-color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(45, 212, 191, 0.1);
    }

    .refund-type {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }

    .refund-desc {
        color: var(--text-secondary);
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .policy-list {
        list-style: none;
        padding: 0;
        margin: 1rem 0;
    }

    .policy-item {
        padding: 0.75rem 0;
        color: var(--text-secondary);
        line-height: 1.6;
        border-left: 3px solid transparent;
        padding-left: 1rem;
        transition: var(--transition);
    }

    .policy-item:hover {
        border-left-color: var(--primary-color);
        transform: translateX(0.25rem);
    }

    .policy-item::before {
        content: '•';
        color: var(--primary-color);
        margin-right: 0.75rem;
        font-weight: bold;
    }

    .highlight-box {
        background: #fef3c7;
        border: 1px solid #f59e0b;
        border-radius: 8px;
        padding: 1.5rem;
        margin: 1.5rem 0;
    }

    .highlight-box .policy-text {
        color: #92400e;
        margin: 0;
    }

    .sidebar {
        background: var(--bg-white);
    }

    .sidebar-section {
        background: var(--bg-light);
        border-radius: 8px;
        padding: 1.5rem;
        border: 1px solid var(--border-light);
    }

    .sidebar-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0 0 1rem 0;
    }

    .nav-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .policy-page .nav-link {
        display: block;
        padding: 0.5rem 0;
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 0.875rem;
        transition: var(--transition);
        border-bottom: 1px solid transparent;
    }

    .policy-page .nav-link:hover {
        color: var(--primary-color);
        padding-left: 0.5rem;
    }

    .contact-box {
        background: var(--primary-color);
        color: white;
        padding: 1.5rem;
        border-radius: 8px;
        text-align: center;
        margin-top: 2rem;
    }

    .contact-title {
        font-weight: 600;
        margin: 0 0 0.5rem 0;
        font-size: 1rem;
    }

    .contact-text {
        font-size: 0.875rem;
        opacity: 0.9;
        margin: 0;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .hero-content h1 { font-size: 1.5rem; }
        .hero-content p { font-size: 1rem; }
        .main-content {
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 2rem 1rem;
        }
        .sidebar {
            order: -1;
        }
        .refund-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="policy-page">
    <div class="modern-hero">
        <div class="hero-content">
            <h1>Cancellation & Refund Policy</h1>
            <p>Clear and transparent policies for all your ferry bookings</p>
        </div>
    </div>

    <div class="breadcrumb">
        <div class="breadcrumb-content">
            <a href="{{ url('/') }}">🏠 Home</a>
            <span>/</span>
            <span>Cancellation & Refund Policy</span>
        </div>
    </div>

    <div class="main-content">
        <div class="content-area">
            <div class="policy-section" id="user-cancellation">
                <h2 class="section-title">1. Cancellation by the User</h2>

                <div class="subsection">
                    <h3 class="subsection-title">1.1 Cancellation Timeframes</h3>
                    <p class="policy-text">Users may request to cancel their ferry booking, subject to the following timeframes:</p>
                    
                    <div class="refund-grid">
                        <div class="refund-card">
                            <div class="refund-type">Full Refund</div>
                            <div class="refund-desc">Cancellations made at least 72 hours prior to scheduled departure</div>
                        </div>
                        <div class="refund-card">
                            <div class="refund-type">Partial Refund</div>
                            <div class="refund-desc">24-48 hours prior with Rs. 250 cancellation fee</div>
                        </div>
                        <div class="refund-card">
                            <div class="refund-type">Non-Refundable</div>
                            <div class="refund-desc">Within 24 hours of departure or no-shows</div>
                        </div>
                    </div>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">1.2 Cancellation Process</h3>
                    <p class="policy-text">To request a cancellation, Users must contact our customer support team through the designated channels provided on our Website or by phone. Cancellation requests will only be considered valid once confirmed by our customer support team.</p>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">1.3 Refund Processing</h3>
                    <p class="policy-text">Refunds for eligible cancellations will be processed within 5 business days of receiving a valid cancellation request. The refund will be issued to the original payment method used during the booking process, unless otherwise agreed upon.</p>
                </div>
            </div>

            <div class="policy-section" id="operator-cancellation">
                <h2 class="section-title">2. Cancellations by the Ferry Operator</h2>

                <div class="subsection">
                    <h3 class="subsection-title">2.1 Schedule Changes or Cancellations</h3>
                    <p class="policy-text">In the event of schedule changes, cancellations, or disruptions due to unforeseen circumstances such as adverse weather conditions, mechanical issues, or operational constraints, the ferry operator reserves the right to:</p>
                    
                    <ul class="policy-list">
                        <li class="policy-item">Modify the departure time, route, or vessel assigned to the booking</li>
                        <li class="policy-item">Offer an alternative sailing option, subject to availability</li>
                        <li class="policy-item">Provide a full refund for the affected booking</li>
                    </ul>
                </div>

                <div class="subsection">
                    <h3 class="subsection-title">2.2 Notification</h3>
                    <p class="policy-text">If the ferry operator initiates a schedule change or cancellation, reasonable efforts will be made to notify affected Users via the contact information provided during the booking process. However, it is the User's responsibility to stay updated on any changes or cancellations by regularly checking our Website, official communication channels, or contacting our customer support team.</p>
                </div>
            </div>

            <div class="policy-section" id="discretionary">
                <h2 class="section-title">3. Discretionary Refunds</h2>
                <div class="highlight-box">
                    <p class="policy-text">In exceptional cases or under extenuating circumstances, the ferry booking service may consider discretionary refunds or waivers of cancellation fees on a case-by-case basis. Such decisions will be made at the sole discretion of the ferry booking service and are not guaranteed.</p>
                </div>
            </div>

            <div class="policy-section" id="no-show">
                <h2 class="section-title">4. No-Show Policy</h2>
                <p class="policy-text">If a User fails to appear for their scheduled departure (no-show), their booking will be considered canceled, and no refunds will be provided.</p>
            </div>

            <div class="policy-section">
                <h2 class="section-title">Changes to Policy</h2>
                <p class="policy-text">We reserve the right to modify or update this Refunds/Cancellations Policy at any time without prior notice. Changes to the policy will be effective immediately upon posting on our Website.</p>
            </div>
        </div>

        <div class="sidebar">
            <div class="sidebar-section">
                <h3 class="sidebar-title">Quick Navigation</h3>
                <div class="nav-links">
                    <a href="#user-cancellation" class="nav-link">User Cancellations</a>
                    <a href="#operator-cancellation" class="nav-link">Operator Cancellations</a>
                    <a href="#discretionary" class="nav-link">Discretionary Refunds</a>
                    <a href="#no-show" class="nav-link">No-Show Policy</a>
                </div>
            </div>

            <div class="contact-box">
                <h4 class="contact-title">Need Help?</h4>
                <p class="contact-text">Contact our support team for assistance with cancellations and refunds.</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Smooth scrolling for navigation (only within this page)
    document.querySelectorAll('.policy-page .nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>

@endsection