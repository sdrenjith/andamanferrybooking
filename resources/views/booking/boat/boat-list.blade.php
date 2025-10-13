@extends('layouts.app')

@section('title', 'Andaman Ferry Booking Online | Fast & Easy Boat Booking')
@section('meta_title', 'Andaman Ferry Booking Online | Fast & Easy Boat Booking')
@section('meta_description', 'Book your Andaman ferry online with ease. Fast, secure, and reliable boat booking for Havelock, Neil Island, and more. Reserve your seat today')

@section('content')
<main>
    <!-- Hero/Booking Section -->
    <section class="modern-hero">
        <div class="hero-content">
            <h1>Book a Boat in Andaman</h1>
            <p>Private charters & speed boats for island hopping</p>
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

<style>
    .modern-hero {
        position: relative;
        background: linear-gradient(135deg, rgba(20, 30, 48, 0.9), rgba(36, 59, 85, 0.8));
        min-height: 38vh;
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
    @media (max-width: 768px) {
        .hero-content h1 { font-size: 1.5rem; }
        .hero-content p { font-size: 1rem; }
    }
</style>

{{-- Debug output for boat_lists --}}
@foreach ($boat_lists as $boat_list)
    <div>DEBUG: {{ $boat_list->name }} - {{ $boat_list->price }}</div>
@endforeach