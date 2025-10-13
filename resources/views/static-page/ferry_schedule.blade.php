@extends('layouts.app')
@section('title', 'Book Ferry Tickets Online | Fast & Secure Booking')
@section('meta_description', 'Quickly book ferry tickets online with easy steps, secure payments, instant confirmation, and 24/7 support. Enjoy smooth and stress-free travel today!')

@section('content')

<section class="blogs mt-5 pt-5 pb-0 pb-lg-3">
    <div class="row secHead w-100 m-0">
        <div class="col-12 text-center subPage">
            <h2 class="display-4 fw-bold mb-4" style="color: #008495; margin-top: 2rem;">Ferry Schedule</h2>
            <p class="lead text-muted mb-0">Check the latest ferry timings and schedules for your Andaman journey</p>
        </div>
    </div>
</section>
<section class="mt-4">
    <div class="container">
        <!-- Filter Section -->
        <div class="row mb-4 justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <h6 class="mb-2 fw-bold text-primary">Filter by Ferry Operator</h6>
                                <select id="ferryFilter" class="form-select">
                                    <option value="all">All Ferries</option>
                                    <option value="Makruzz">Makruzz</option>
                                    <option value="Green Ocean">Green Ocean</option>
                                    <option value="Nautika">Nautika</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <h6 class="mb-2 fw-bold text-primary">Filter by Route</h6>
                                <select id="routeFilter" class="form-select">
                                    <option value="all">All Routes</option>
                                    <option value="port-havelock">Port Blair to Havelock</option>
                                    <option value="havelock-neil">Havelock to Neil</option>
                                    <option value="neil-port">Neil to Port Blair</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-lg-5 mb-3 justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-lg border-0 rounded-4 schedule-section" data-route="port-havelock" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header bg-white border-0 rounded-top-4" style="color: #008495;">
                        <h5 class="info-box-text mb-0 fw-bold">Schedule For <b>Port Blair to Havelock</b></h5>
                            </div>
                    <div class="card-body table-responsive p-4">
                        <table class="table table-hover align-middle mb-0 modern-schedule-table">
                            <thead style="background-color: #e6f7fa;">
                                        <tr style="color: #008495; font-weight: 600;">
                                            <th>Ferry</th>
                                            <th>Dep Time</th>
                                            <th>Arv Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-ferry="Makruzz">
                                            <td>Makruzz</td>
                                            <td>06:00</td>
                                            <td>07:30</td>
                                        </tr>
                                                                                                        <tr data-ferry="Green Ocean">
                                            <td>Green Ocean 1</td>
                                            <td>06:30</td>
                                            <td>08:45</td>
                                        </tr>
                                                                                                        <tr data-ferry="Green Ocean">
                                            <td>Green Ocean 2</td>
                                            <td>07:00</td>
                                            <td>09:00</td>
                                        </tr>
                                                                                                        <tr data-ferry="Nautika">
                                            <td>Nautika</td>
                                            <td>07:30</td>
                                            <td>09:00</td>
                                        </tr>
                                        <tr data-ferry="Makruzz">
                                            <td>Makruzz</td>
                                            <td>08:00</td>
                                            <td>09:30</td>
                                        </tr>
                                        <tr data-ferry="Makruzz">
                                            <td>Makruzz</td>
                                            <td>11:30</td>
                                            <td>13:00</td>
                                        </tr>
                                        <tr data-ferry="Green Ocean">
                                            <td>Green Ocean 2</td>
                                            <td>11:45</td>
                                            <td>13:45</td>
                                        </tr>
                                        <tr data-ferry="Nautika">
                                            <td>Nautika</td>
                                            <td>12:15</td>
                                            <td>13:45</td>
                                        </tr>
                                        <tr data-ferry="Green Ocean">
                                            <td>Green Ocean 1</td>
                                            <td>13:15</td>
                                            <td>15:30</td>
                                        </tr>
                                        <tr data-ferry="Makruzz">
                                            <td>Makruzz</td>
                                            <td>14:00</td>
                                            <td>15:30</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center mt-3">
                                    <a href="{{ url('search-result-ferry') }}?trip_type=1&form_location=1&to_location=2&date={{ date('Y-m-d') }}&passenger=1&infant=0" class="btn btn-primary book-now-bottom-btn">
                                        <i class="bi bi-calendar-check me-2"></i>Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card schedule-section" data-route="havelock-neil">
                            <div class="card-header" style="color: #008495;">
                                <h5 class="info-box-text mb-0">Schedule For <b><strong>Havelock To Neil</strong></b></h5>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead style="background-color: #0084954a;">
                                        <tr>
                                            <th>Ferry</th>
                                            <th>Dep Time</th>
                                            <th>Arv Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                                                                                                        <tr data-ferry="Makruzz">
                                            <td>Makruzz</td>
                                            <td>08:00</td>
                                            <td>09:00</td>
                                        </tr>
                                                                                                        <tr data-ferry="Green Ocean">
                                            <td>Green Ocean 1</td>
                                            <td>09:15</td>
                                            <td>10:30</td>
                                        </tr>
                                        <tr data-ferry="Nautika">
                                            <td>Nautika</td>
                                            <td>09:30</td>
                                            <td>10:15</td>
                                        </tr>
                                        <tr data-ferry="Makruzz">
                                            <td>Makruzz</td>
                                            <td>10:00</td>
                                            <td>11:00</td>
                                        </tr>
                                        <tr data-ferry="Green Ocean">
                                            <td>Green Ocean 2</td>
                                            <td>14:15</td>
                                            <td>15:30</td>
                                        </tr>
                                        <tr data-ferry="Makruzz">
                                            <td>Makruzz</td>
                                            <td>14:45</td>
                                            <td>15:45</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center mt-3">
                                    <a href="{{ url('search-result-ferry') }}?trip_type=1&form_location=2&to_location=3&date={{ date('Y-m-d') }}&passenger=1&infant=0" class="btn btn-primary book-now-bottom-btn">
                                        <i class="bi bi-calendar-check me-2"></i>Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card schedule-section" data-route="neil-port">
                            <div class="card-header" style="color: #008495;">
                                <h5 class="info-box-text mb-0">Schedule For <b><strong>Neil to Port Blair</strong></b></h5>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead style="background-color: #0084954a;">
                                        <tr>
                                            <th>Ferry</th>
                                            <th>Dep Time</th>
                                            <th>Arv Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                                                                                                        <tr data-ferry="Makruzz">
                                            <td>Makruzz</td>
                                            <td>09:30</td>
                                            <td>10:30</td>
                                        </tr>
                                                                                                        <tr data-ferry="Nautika">
                                            <td>Nautika</td>
                                            <td>10:45</td>
                                            <td>12:00</td>
                                        </tr>
                                        <tr data-ferry="Green Ocean">
                                            <td>Green Ocean 1</td>
                                            <td>11:00</td>
                                            <td>12:45</td>
                                        </tr>
                                        <tr data-ferry="Makruzz">
                                            <td>Makruzz</td>
                                            <td>11:20</td>
                                            <td>12:30</td>
                                        </tr>
                                        <tr data-ferry="Green Ocean">
                                            <td>Green Ocean 2</td>
                                            <td>15:45</td>
                                            <td>18:00</td>
                                        </tr>
                                        <tr data-ferry="Makruzz">
                                            <td>Makruzz</td>
                                            <td>16:00</td>
                                            <td>17:10</td>
                                        </tr>
                                        <tr data-ferry="Nautika">
                                            <td>Nautika</td>
                                            <td>16:15</td>
                                            <td>17:30</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center mt-3">
                                    <a href="{{ url('search-result-ferry') }}?trip_type=1&form_location=3&to_location=1&date={{ date('Y-m-d') }}&passenger=1&infant=0" class="btn btn-primary book-now-bottom-btn">
                                        <i class="bi bi-calendar-check me-2"></i>Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    </div>
</section>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ferryFilter = document.getElementById('ferryFilter');
    const routeFilter = document.getElementById('routeFilter');
    const scheduleSections = document.querySelectorAll('.schedule-section');

    function filterSchedules() {
        const selectedFerry = ferryFilter.value;
        const selectedRoute = routeFilter.value;

        scheduleSections.forEach(section => {
            const route = section.getAttribute('data-route');
            const tableRows = section.querySelectorAll('tbody tr[data-ferry]');
            
            // Show/hide section based on route filter
            if (selectedRoute === 'all' || selectedRoute === route) {
                section.style.display = 'block';
                
                // Filter rows within the section
                tableRows.forEach(row => {
                    const ferry = row.getAttribute('data-ferry');
                    if (selectedFerry === 'all' || ferry === selectedFerry) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            } else {
                section.style.display = 'none';
            }
        });
    }

    // Add event listeners
    ferryFilter.addEventListener('change', filterSchedules);
    routeFilter.addEventListener('change', filterSchedules);

    // Initialize with all schedules visible
    filterSchedules();
});
</script>
@endpush

@push('css')
<style>
.schedule-section {
    transition: all 0.3s ease;
}

.schedule-section.hidden {
    display: none !important;
}

.filter-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 1px solid #dee2e6;
}

.form-select {
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-select:focus {
    border-color: #008495;
    box-shadow: 0 0 0 0.2rem rgba(0, 132, 149, 0.25);
}

.modern-schedule-table tbody tr {
    transition: all 0.3s ease;
}

.modern-schedule-table tbody tr:hover {
    background-color: #f8f9fa;
    transform: translateY(-1px);
}

/* Animation for filtered rows */
.modern-schedule-table tbody tr[style*="display: none"] {
    opacity: 0;
    transform: scale(0.95);
}

.modern-schedule-table tbody tr[style*="display: table-row"] {
    opacity: 1;
    transform: scale(1);
}

/* Book Now Bottom Button Styles */
.book-now-bottom-btn {
    background: linear-gradient(135deg, #008495 0%, #00a0b7 100%);
    border: none;
    color: white;
    font-weight: 600;
    font-size: 1rem;
    padding: 0.8rem 2rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(0, 132, 149, 0.2);
}

.book-now-bottom-btn:hover {
    background: linear-gradient(135deg, #006d7a 0%, #008495 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 132, 149, 0.3);
    text-decoration: none;
}

.book-now-bottom-btn:active {
    transform: translateY(0);
    box-shadow: 0 4px 15px rgba(0, 132, 149, 0.2);
}

/* Responsive button sizing */
@media (max-width: 768px) {
    .book-now-bottom-btn {
        font-size: 0.9rem;
        padding: 0.6rem 1.5rem;
    }
}
</style>
@endpush

@endsection