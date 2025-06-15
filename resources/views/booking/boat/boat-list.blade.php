@extends('layouts.app')

@section('content')
<main>
    <section>
        <div class="ferryBanner boatBook">
            <div class="bookingConsole ">
                <div class="position-relative tabContainer">
                    <form action="{{ url('/search-result-boat') }}" method="GET">
                        <div class="tabs opacity-100 row mx-0">
                            <div class="col-12 col-md-6 col-lg-4 mb-2 mb-lg-0 border-end">
                                <label for="location">Boat List</label>
                                <select name="id" class="form-select border-0 p-0" id="">
                                    {{-- <option value="select">Select</option> --}}
                                    @foreach ($boat_lists as $index => $boat_list)
                                    <option value="{{ $boat_list->id }}" {{ $index + 1 == 1 ? 'selected' : '' }}>
                                        {{ $boat_list->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                <label for="date">Date</label>
                                <input type="date" class="my_date_picker" placeholder="Select Date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                <label for="location">Passengers</label>
                                <input type="number" class="form-control" id="passengers" name="passengers" value="1" oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" required>
                            </div>

                            <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 ">
                                <label for="location">Infants</label>
                                <input type="tel" name="infants" maxlength="2" inputmode="numeric" id="infants" placeholder="No. of Infant" value="0">
                            </div>
                            <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0">
                                <button type="submit" class="btn button w-100"><i class="bi bi-search"></i>
                                    Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5 pt-3">
        <div class="container">
            <div class="row ">
                <div class="col-12 col-lg-5 ">
                    <div class="row secHead mb-4">
                        <div class="col-12 text-center">
                            <h2>Boats in Andaman</h2>
                            <p style="text-align: justify;">The Andaman Islands are a beautiful and popular tourist destination located in the Bay of Bengal. With
                                pristine beaches, lush forests and incredible marine life, these 572 islands
                                attract visitors from around the world. However, there is no road or air transport
                                between the islands. The only way to get around is by boat. This makes booking
                                boat tickets an essential part of planning any trip to the Andamans. <a href="https://andamanferrybookings.com" class="text-decoration-none">andamanferrybookings.com</a>
                                is the best website for comparing and booking tickets.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">

                    <div class="row">
                        <div class="col-12 searchResults">
                            @foreach ($boat_lists as $boat_list)
                            <div class="ferryCard boatCard ferrySearch mb-3">
                                <div class="ferryImg">
                                    <img src="{{ env('UPLOADED_ASSETS') . 'uploads/boat/' . $boat_list->image }}" alt="">
                                </div>
                                <div class="ferryDetails ms-3 ">
                                    <div>
                                        <h4 class="mb-3">{{ $boat_list->title }}</h4>
                                        {{-- <p class="">{{ $boat_list->price }}</p> --}}

                                    </div>
                                    <div class=" mt-4">
                                        <a href="{{ url('/search-result-boat/') }}?id={{ $boat_list->id }}&date={{ $date }}&passengers=1" class="btn">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <section class="mt-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0  col-md-3 col-12">
                    <div class="processCard card">
                        <div class="card-body">
                            <img src="images/search.png" alt="">
                        </div>
                        <div class="card-footer bg-transparent p-0 border-0">
                            <p>Search</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0 col-md-3 col-12">
                    <div class="processCard card">
                        <div class="card-body">
                            <img src="images/fill-info.png" alt="">
                        </div>
                        <div class="card-footer bg-transparent p-0 border-0">
                            <p>Fill Info</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0  col-md-3 col-12">
                    <div class="processCard card">
                        <div class="card-body">
                            <img src="images/payment.png" alt="">
                        </div>
                        <div class="card-footer bg-transparent p-0 border-0">
                            <p>Payment</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0  col-md-3 col-12">
                    <div class="processCard card">
                        <div class="card-body">
                            <img src="images/get-ticket.png" alt="">
                        </div>
                        <div class="card-footer bg-transparent p-0 border-0">
                            <p>Get Ticket</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-5 pt-3">
        <div class="row justify-content-end secHead w-100 m-0">
            <div class="col-12 col-lg-6 text-center">
                <h2>What They Say About Us</h2>
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
                                            <img src="{{ env('UPLOADED_ASSETS'). $testimonial->path }}" alt="">
                                        </div>
                                        <p class="text-white ps-5">
                                        <h3>{{ $testimonial->title }}</h3>
                                        <p >{{ $testimonial->designation }}</p>
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
                                            <img src="{{ env('UPLOADED_ASSETS') . $testimonial->path }}" alt="">
                                        </div>
                                        <div>
                                            <h3>{{ $testimonial->title }}</h3>
                                            <p >{{ $testimonial->designation }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <img src="images/left_arrow_white.svg" alt="">
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <img src="images/right_arrow_white.svg" alt="">
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
        </div>
    </section>

    <section class="faqSec">
        <div class="row secHead w-100 m-0">
            <div class="col-12 text-center">
                <h2>FAQs</h2>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="accordion bg-transparent" id="accordionExample">
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($faqs as $faq)
                        <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header bg-transparent">
                                <button class="accordion-button bg-transparent collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}" aria-expanded="true" aria-controls="collapseOne">
                                    {{ $faq->questions }}
                                </button>
                            </h2>
                            <div id="collapse{{ $i++ }}" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{ $faq->answers }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('js')
<script>
      $(document).ready(function() {
            $('#date').flatpickr({
                dateFormat: 'Y-m-d',
               
            });
            $('#tr_date').flatpickr({
                dateFormat: 'Y-m-d',
               
            });
            $('#return_date_of_journey').flatpickr({
                dateFormat: 'Y-m-d',
               
            });
    });
    
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

    function updateTomorrow() {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById('date').value = tomorrow.toISOString().split('T')[0];
    }
</script>
@endpush