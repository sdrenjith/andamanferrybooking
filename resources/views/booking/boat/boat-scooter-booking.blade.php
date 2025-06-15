@extends('layouts.app')

@section('content')
<main>
    <!-- Booking Section with Modern Layout -->
    <section class="py-5" style="background: #f7fafc;">
        <div class="container">
            <div class="row justify-content-center align-items-stretch g-4 flex-wrap">
                <!-- Boat Booking Card -->
                <div class="col-12 col-lg-6 d-flex align-items-stretch">
                    <div class="card shadow-lg border-0 rounded-4 p-4 w-100 position-relative" style="background: #fff; min-width: 320px;">
                        <div class="position-absolute top-0 start-0 w-100" style="height: 5px; background: #0097a7; border-radius: 8px 8px 0 0;"></div>
                        <div class="d-flex align-items-center mb-2 mt-2">
                            <span class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 44px; height: 44px;"><i class="bi bi-boat fs-3 text-primary"></i></span>
                            <h2 class="fw-bold mb-0" style="font-size: 1.7rem;">Book a Boat in Andaman</h2>
                        </div>
                        <div class="text-muted mb-3" style="font-size: 1rem;">Private charters & speed boats for island hopping</div>
                        <form action="{{ url('/search-result-boat') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="boat" class="form-label">Select Boat</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="bi bi-boat"></i></span>
                                        <select name="id" class="form-select" id="boat">
                                            @foreach ($boat_lists as $index => $boat_list)
                                                <option value="{{ $boat_list->id }}">{{ $boat_list->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="bi bi-calendar-event"></i></span>
                                        <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="passengers" class="form-label">Passengers</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                                        <input type="number" class="form-control" id="passengers" name="passengers" value="1" min="1" max="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="infants" class="form-label">Infants</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="bi bi-baby"></i></span>
                                        <input type="number" class="form-control" id="infants" name="infants" value="0" min="0" max="5">
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold shadow-sm" style="font-size: 1.1rem; transition: transform 0.1s;">Search Boats</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Scooter Booking Card -->
                <div class="col-12 col-lg-6 d-flex align-items-stretch">
                    <div class="card shadow-lg border-0 rounded-4 p-4 w-100 position-relative" style="background: #fff; min-width: 320px;">
                        <div class="position-absolute top-0 start-0 w-100" style="height: 5px; background: #ffc107; border-radius: 8px 8px 0 0;"></div>
                        <div class="d-flex align-items-center mb-2 mt-2">
                            <span class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 44px; height: 44px;"><i class="bi bi-scooter fs-3 text-warning"></i></span>
                            <h2 class="fw-bold mb-0" style="font-size: 1.7rem;">Book a Scooter</h2>
                        </div>
                        <div class="text-muted mb-3" style="font-size: 1rem;">Explore the islands at your own pace</div>
                        <form action="{{ url('/search-result-scooter') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="scooter_location" class="form-label">Pickup Location</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="bi bi-geo-alt"></i></span>
                                        <select name="location" class="form-select" id="scooter_location">
                                            <option value="Port Blair">Port Blair</option>
                                            <option value="Havelock">Havelock</option>
                                            <option value="Neil">Neil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="scooter_date" class="form-label">Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="bi bi-calendar-event"></i></span>
                                        <input type="date" class="form-control" id="scooter_date" name="date" min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="scooter_days" class="form-label">No. of Days</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="bi bi-clock"></i></span>
                                        <input type="number" class="form-control" id="scooter_days" name="days" value="1" min="1" max="14">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="scooter_count" class="form-label">No. of Scooters</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="bi bi-scooter"></i></span>
                                        <input type="number" class="form-control" id="scooter_count" name="count" value="1" min="1" max="10">
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-warning w-100 py-2 fw-semibold shadow-sm" style="font-size: 1.1rem; transition: transform 0.1s;">Search Scooters</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3 Steps Process Section -->
    <section class="py-5" data-aos="fade-up" data-aos-delay="400">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold display-6 mb-4">The Simplest Process Ever.<br>Book in 3 Steps.</h2>
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-start">
                            <div class="step-icon bg-white shadow rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px;"><i class="bi bi-search fs-2 text-dark"></i></div>
                            <div>
                                <h5 class="fw-bold mb-1">1. Search</h5>
                                <p class="mb-0">Find the right timings and best rates for your trip.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="step-icon bg-white shadow rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px;"><i class="bi bi-journal-check fs-2 text-dark"></i></div>
                            <div>
                                <h5 class="fw-bold mb-1">2. Book</h5>
                                <p class="mb-0">Choose from the largest selection and book instantly.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="step-icon bg-white shadow rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px;"><i class="bi bi-emoji-sunglasses fs-2 text-dark"></i></div>
                            <div>
                                <h5 class="fw-bold mb-1">3. Sail</h5>
                                <p class="mb-0">Enjoy your trip with peace of mind and support.</p>
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
</main>
@endsection

<style>
@media (min-width: 992px) {
    .booking-section-cards .card {
        min-height: 420px;
    }
}
</style> 