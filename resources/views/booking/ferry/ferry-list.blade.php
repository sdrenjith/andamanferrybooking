@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="ferryBanner">
                <div class="bookingConsole ">
                    <div class="tabBtns  d-flex align-items-center">
                        <div class="d-flex align-items-start tabBtn tabBtn1 active" id="one-way" data-list="1">
                            <img src="{{ asset('assets/images/one-way-inactive.png') }}" class="icon-inactive" alt="">
                            <img src="{{ asset('assets/images/one-way-active.png') }}" class="icon-active" alt="">

                            <p class="mb-0 ms-2">One Way</p>
                        </div>
                        <div class="d-flex align-items-center tabBtn tabBtn2" data-list="2" id="round-trip">
                            <img src="{{ asset('assets/images/return-inactive.png') }}" class="icon-inactive"
                                alt="">
                            <img src="{{ asset('assets/images/return-active.png') }}" class="icon-active" alt="">
                            <p class="mb-0 ms-2">Round Trip</p>
                        </div>
                    </div>

                    <form action="{{ url('/search-result-ferry') }}" method="GET">
                        <input type="hidden" name="trip_type" id="trip_type" value="1">

                        <div class="position-relative tabContainer">
                            <div class="tabs tabs1 row mx-0">
                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                    <label for="location">From</label>
                                    <select name="form_location" class="form-select border-0 p-0" id="form_location">
                                        {{-- <option value="">Select</option> --}}
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
                                        {{-- <option value="">Select</option> --}}
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
                                    {{-- <input type="number" name="infants" maxlength="2" inputmode="numeric" id="pasanger" placeholder="No. of Infant" value="0"> --}}
                                    <input type="number" class="form-control" id="infants" name="infant" value="0"
                                        oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" required>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0">
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
                                            {{-- <option value="">Select</option> --}}
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
                                        {{-- <input type="tel" name="infants" maxlength="2" inputmode="numeric" id="pasanger" placeholder="No. of Infant" value="0"> --}}
                                        <input type="number" class="form-control" id="infant" name="infant"
                                            value="0"
                                            oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" required>
                                    </div>

                                    {{-- <input type="hidden" name="trip_type" value="single_trip"> --}}
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0">
                                        <button class="btn button w-100" id="search"><i class="bi bi-search"></i>
                                            Search</button>
                                    </div>
                                </div>
                                <div class="row py-2 border-bottom">
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-lg-0 border-end">
                                        <label for="location">From</label>
                                        <select name="round1_from_location" class="form-select border-0 p-0"
                                            id="round1_from_location">
                                            {{-- <option value="">Select</option> --}}
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
                                        {{-- <input type="tel" name="infants" maxlength="2" inputmode="numeric" id="pasanger" placeholder="No. of Infant" value="0"> --}}
                                        <input type="number" class="form-control" id="round1_infants" value=""
                                            oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" readonly>
                                    </div>

                                    {{-- <input type="hidden" name="trip_type" value="round1_trip">  --}}
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
                                            {{-- <option value="">Select</option> --}}
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
                                        {{-- <input type="tel" name="infants" maxlength="2" inputmode="numeric" id="pasanger" placeholder="No. of Infant" value="0"> --}}
                                        <input type="number" class="form-control" id="round2_infants" value=""
                                            oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" readonly>
                                    </div>

                                    {{-- <input type="hidden" name="trip_type" value="round2_trip">  --}}
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


        <section class="mt-5 pt-3">
            <div class="container">
                <div class="row ">
                    <div class="col-12 col-lg-5 ">
                        <div class="row secHead mb-4">
                            <div class="col-12 text-center">
                                <h2>Ferries in Andaman</h2>
                                <p style="text-align: justify;">The Andaman Islands are a beautiful and popular tourist
                                    destination located in the Bay of Bengal. With
                                    pristine beaches, lush forests and incredible marine life, these 572 islands
                                    attract visitors from around the world. However, there is no road or air transport
                                    between the islands. The only way to get around is by ferry. This makes booking
                                    ferry tickets an essential part of planning any trip to the Andamans. <a
                                        href="https://andamanferrybookings.com/" class="text-decoration-none">andamanferrybookings.com</a>
                                    is the best website for comparing and booking tickets for the 3 private ferries
                                    operating between Port Blair, Havelock and Neil Islands.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="row">
                            <div class="col-12 searchResults">
                                <div class="ferryCard boatCard ferrySearch mb-3">
                                    <div class="ferryImg" data-ferry-id="5">
                                        <img src="uploads/ship/Green ocean 1.jpg" alt="" style="">
                                    </div>
                                    <div class="ferryDetails ms-3  ">
                                        <div class="ferryName w-auto">
                                            <h4 class="mb-3">
                                                Green Ocean 1
                                            </h4>

                                            <p class="mb-3">
                                                Port Blair
                                                -
                                                Swaraj Dweep (Havelock)
                                            </p>
                                            <p class="mb-3">
                                                Port Blair
                                                -
                                                Neil Island
                                            </p>
                                            <p class="mb-3">
                                                Swaraj Dweep (Havelock)
                                                -
                                                Port Blair
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="ferryCard boatCard ferrySearch mb-3">
                                    <div class="ferryImg" data-ferry-id="5">
                                        <img src="uploads/ship/greenocean.jpeg" alt="" style="">
                                    </div>
                                    <div class="ferryDetails ms-3  ">
                                        <div class="ferryName w-auto">
                                            <h4 class="mb-3">
                                                Green Ocean 2
                                            </h4>

                                            <p class="mb-3">
                                                Port Blair
                                                -
                                                Swaraj Dweep (Havelock)
                                            </p>
                                            <p class="mb-3">
                                                Port Blair
                                                -
                                                Neil Island
                                            </p>
                                            <p class="mb-3">
                                                Swaraj Dweep (Havelock)
                                                -
                                                Port Blair
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ferryCard boatCard ferrySearch mb-3">
                                    <div class="ferryImg" data-ferry-id="667b33592d721d9ec56a7029">

                                        <img src="uploads/ship/nautika.jpeg" alt="" style="">
                                    </div>
                                    <div class="ferryDetails ms-3 ">
                                        <div class="ferryName w-auto">
                                            <h4 class="mb-3">
                                                Nautika
                                            </h4>

                                            <p class="mb-3">
                                                Port Blair
                                                -
                                                Swaraj Dweep (Havelock)
                                            </p>
                                            <p class="mb-3">
                                                Port Blair
                                                -
                                                Neil Island
                                            </p>
                                            <p class="mb-3">
                                                Swaraj Dweep (Havelock)
                                                -
                                                Port Blair
                                            </p>
                                        </div>



                                    </div>
                                </div>

                                <div class="ferryCard ferrySearch boatCard mb-3">
                                    <div class="ferryImg" data-ferry-id="600">
                                        <img src="uploads/ship/makruzz.jpeg" alt="" style="">
                                    </div>

                                    <div class="ferryDetails ms-3 ">

                                        <div class="ferryName w-100">
                                            <h4 class="mb-3">
                                                Makruzz
                                            </h4>


                                            <p class="mb-3">
                                                Port Blair
                                                -
                                                Swaraj Dweep (Havelock)
                                            </p>
                                            <p class="mb-3">
                                                Port Blair
                                                -
                                                Neil Island
                                            </p>
                                            <p class="mb-3">
                                                Swaraj Dweep (Havelock)
                                                -
                                                Port Blair
                                            </p>

                                        </div>

                                    </div>
                                </div>

                                <div class="ferryCard ferrySearch boatCard mb-3">
                                    <div class="ferryImg" data-ferry-id="600">
                                        <img src="uploads/ship/majestic.jpg" alt="" style="">
                                    </div>

                                    <div class="ferryDetails ms-3 ">

                                        <div class="ferryName w-100">
                                            <h4 class="mb-3">
                                                ITT Majestic
                                            </h4>


                                            <p class="mb-3">
                                                Port Blair
                                                -
                                                Swaraj Dweep (Havelock)
                                            </p>
                                            <p class="mb-3">
                                                Port Blair
                                                -
                                                Neil Island
                                            </p>
                                            <p class="mb-3">
                                                Swaraj Dweep (Havelock)
                                                -
                                                Port Blair
                                            </p>
                                        </div>
                                    </div>
                                </div>

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
                            @foreach ($testimonials as $key => $testimonial)
                                @if ($key == 0)
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
                                                        <img src="{{ env('UPLOADED_ASSETS') . $testimonial->path }}"
                                                            alt="">
                                                    </div>
                                                    <p class="text-white ps-5">
                                                    <h3>{{ $testimonial->title }}</h3>
                                                    <p>{{ $testimonial->designation }}</p>
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
                                                        <img src="{{ env('UPLOADED_ASSETS') . $testimonial->path }}"
                                                            alt="">
                                                    </div>
                                                    <div>
                                                        <h3>{{ $testimonial->title }}</h3>
                                                        <p>{{ $testimonial->designation }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <img src="images/left_arrow_white.svg" alt="">
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
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
                                        <button class="accordion-button bg-transparent collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            {{ $faq->questions }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $i++ }}" class="accordion-collapse collapse "
                                        data-bs-parent="#accordionExample">
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

        disableDiv();

        function enableDiv() {
            $(".tabs.tabs2.mx-0").find("input, select, button").prop("disabled", false);
        }

        $(document).ready(function() {
            disableDiv();

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

            // $(document).on('click', ".delete", function(e) {
            // $(this).parent().parent(".row").html("");
            // $(this).parent().parent(".row").removeClass("border-bottom");
            // });

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

        });
    </script>
@endpush
