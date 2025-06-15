@extends('layouts.app')

@section('content')
    <main>
        <section class="searchResultsPage">
            <div class="ferryBanner ferryResults">
                <div class="container">
                    <div class="bookingConsole ">
                        <div class="tabBtns  d-flex align-items-center">
                            <div class="d-flex align-items-start tabBtn tabBtn1 active" data-list="1">
                                <img src="images/one-way-inactive.png" class="icon-inactive" alt="">
                                <img src="images/one-way-active.png" class="icon-active" alt="">
                                <p class="mb-0 ms-2">One Way</p>
                            </div>
                            <div class="d-flex align-items-center tabBtn tabBtn2" data-list="2">
                                <img src="images/return-inactive.png" class="icon-inactive" alt="">
                                <img src="images/return-active.png" class="icon-active" alt="">
                                <p class="mb-0 ms-2">Return</p>
                            </div>
                        </div>

                        <form action="{{ route('search-result-ferry', ['form_location' => request('form_location'), 'to_location' => request('to_location'), 'to_date' => request('to_date'), 'passengers' => request('passengers'), 'infants' => request('infants')]) }}"
                            method="GET">
                            <div class="position-relative tabContainer">
                                <div class="tabs tabs1 row mx-0">
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                        <label for="location">From</label>
                                        <select name="form_location" class="form-select border-0 p-0" id="form_location">
                                            <option value="">Select</option>
                                            @foreach ($ferry_locations as $ferry_location)
                                                <option value="{{ $ferry_location->id }}"
                                                    {{ old('form_location', request('form_location')) == $ferry_location->id ? 'selected' : '' }}>
                                                    {{ $ferry_location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                        <label for="location">To</label>
                                        <select name="to_location" class="form-select border-0 p-0" id="to_location">
                                            <option value="">Select</option>
                                            @foreach ($ferry_locations as $ferry_location)
                                                <option value="{{ $ferry_location->id }}"
                                                    {{ old('to_location', request('to_location')) == $ferry_location->id ? 'selected' : '' }}>
                                                    {{ $ferry_location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                        <label for="date">Date</label>
                                        <input type="date" class="my_date_picker" placeholder="Select Date"
                                            id="date" name="date" min="<?php echo date('Y-m-d'); ?>"
                                            value="{{ old('date', request('date')) }}">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                        <label for="location">Passengers</label>
                                        <input type="number" class="form-control" id="passengers" name="passengers"
                                            placeholder=1 value="{{ old('passengers', request('passengers')) }}"
                                            oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" required>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 ">
                                        <label for="location">Infants</label>
                                        <input type="tel" name="infants" maxlength="2" inputmode="numeric"
                                            id="infants" placeholder="No. of Infant" value="{{old('infants', request('infants'))}}">
                                    </div>

                                    <input type="hidden" name="trip_type" value="single_trip">

                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0">
                                        <button class="btn button w-100"><i class="bi bi-search"></i>
                                            Search</button>
                                    </div>
                                </div>

                                <div
                                    class="tabs tabs2 row mx-0 {{ request('trip_type') == 'return_trip' ? 'active' : '' }}">
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                        <label for="location">From</label>
                                        <select name="form_location" class="form-select border-0 p-0" id="form_location">
                                            <option value="">Select</option>
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
                                            <option value="">Select</option>
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
                                            id="tr_date" name="date" min="<?php echo date('Y-m-d'); ?>"
                                            value="{{ old('date', request('date')) }}">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                        <label for="return_date">Return Date</label>
                                        <input type="date" class="my_date_picker" placeholder="Select Date"
                                            id="return_date_of_journey" name="return_date_of_journey"
                                            min="<?php echo date('Y-m-d'); ?>"
                                            value="{{ old('return_date_of_journey', request('return_date_of_journey')) }}">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-1 mb-2 mb-lg-0 border-end">
                                        <label for="location">Passengers</label>
                                        <input type="number" class="form-control" id="pasanger" name="passengers"
                                            value="{{ old('passengers', request('passengers')) }}"
                                            oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);"
                                            required>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 col-lg-1 mb-2 mb-lg-0 ">
                                        <label for="location">Infants</label>
                                        <input type="tel" name="infants" maxlength="2" inputmode="numeric"
                                            id="infants" placeholder="No. of Infant" value="{{old('infants', request('infants'))}}">
                                    </div>


                                    <input type="hidden" name="trip_type" value="return_trip">
                                    <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0">
                                        <button class="btn button w-100"><i class="bi bi-search"></i>
                                            Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <?php if ($_REQUEST['trip_type'] == 'single_trip')  { ?>
        <section class="mt-5 pt-3 searchResultsPage">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-12 col-lg-8">
                        <div class="row secHead mb-4">
                            <div class="col-12 text-center">
                                <h2>Search Results For Ferry</h2>
                            </div>
                        </div>
                        <div class="route row px-2">
                            <div class="col-10">
                                <nav class=" mb-3  tabNav ">
                                    <div class="row w-100 m-0 nav nav-tabs justify-content-start border-0" id="nav-tab"
                                        role="tablist">
                                        <button class="nav-link  active col-6 border-0" style="color: black; background:#0076ae" id="nav-profile-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
                                            role="tab" aria-controls="nav-profile" aria-selected="false"
                                            tabindex="-1">{{ $route_titles['from_location'] }} -
                                            {{ $route_titles['to_location'] }}
                                        </button>

                                    </div>
                                </nav>
                            </div>
                            <div class="col-12">
                                <div class="tab-content p-3 border bg-transparent border-0" id="nav-tabContent">
                                    <div class="tab-pane fade active show" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">

                                        <div class="row">
                                            <div class="col-12 searchResults">
                                                @if (isset($apiScheduleData))
                                                    @foreach ($apiScheduleData as $key => $shipSchedule)
                                                        @if ($shipSchedule['ship_name'] == 'Nautika')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg">
                                                                    <img src="{{ $shipSchedule['ship_image'] }}"
                                                                        alt="" style="width:240px">
                                                                </div>
                                                                <div class="ferryDetails ms-3 ">
                                                                    <div>
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship_name'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            {{ $shipSchedule['from'] ?? 'NA' }} -
                                                                            {{ $shipSchedule['to'] ?? 'NA' }}
                                                                        </p>
                                                                    </div>

                                                                    <div class="classBtn">
                                                                        <a href="#"
                                                                            id="{{ 'ferry_p_' . $key + 1 }}"
                                                                            data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                            data-trip_id="{{ $shipSchedule['tripId'] }}"
                                                                            data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                                                            data-from="{{ $shipSchedule['from'] }}"
                                                                            data-to="{{ $shipSchedule['to'] }}"
                                                                            data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                            data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                            data-class-title="{{ 'Premium' }}"
                                                                            data-nautika_class_id="{{ 1 }}"
                                                                            data-price="{{ $shipSchedule['fares']->pBaseFare }}"
                                                                            data-psf="{{ 50 }}"
                                                                            data-ship_name="{{ 'Nautika' }}"
                                                                            class="btn {{ 'Premium' }} ferry-btn mb-2">
                                                                            <p>{{ 'Premium' }}</p>
                                                                            <p class="text-white m-0">
                                                                                ₹{{ $shipSchedule['fares']->pBaseFare }}
                                                                            </p>
                                                                        </a>

                                                                        <a href="#"
                                                                            id="{{ 'ferry_b_' . $key + 1 }}"
                                                                            data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                            data-trip_id="{{ $shipSchedule['tripId'] }}"
                                                                            data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                                                            data-from="{{ $shipSchedule['from'] }}"
                                                                            data-to="{{ $shipSchedule['to'] }}"
                                                                            data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                            data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                            data-class-title="{{ 'Bussiness' }}"
                                                                            data-nautika_class_id="{{ 2 }}"
                                                                            data-price="{{ $shipSchedule['fares']->bBaseFare }}"
                                                                            data-psf="{{ 50 }}"
                                                                            data-ship_name="{{ 'Nautika' }}"
                                                                            class="btn {{ 'Business' }} ferry-btn mb-2">
                                                                            {{ 'Business' }}
                                                                            <p class="text-white">
                                                                                ₹{{ $shipSchedule['fares']->bBaseFare }}
                                                                            </p>
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @elseif($shipSchedule['ship_name'] == 'Admin')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg">
                                                                    <img src="{{ $shipSchedule['ship']['image'] }}"
                                                                        alt="" style="">
                                                                </div>
                                                                <div class="ferryDetails ms-3 ">
                                                                    <div>
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship']['title'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            {{ $shipSchedule['from_location']['title'] ?? 'NA' }}
                                                                            -
                                                                            {{ $shipSchedule['to_location']['title'] ?? 'NA' }}
                                                                        </p>
                                                                    </div>

                                                                    <div>
                                                                        @foreach ($shipSchedule['ferry_prices'] as $adminFerry)
                                                                            <a href="#"
                                                                                id="{{ 'ferry_p_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                                data-from="{{ $shipSchedule['from_location']['title'] }}"
                                                                                data-to="{{ $shipSchedule['to_location']['title'] }}"
                                                                                data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                                data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                                data-class-title="{{ $adminFerry['class']['title'] }}"
                                                                                data-green_class_id="{{ $adminFerry['class']['id'] }}"
                                                                                data-price="{{ $adminFerry['price'] }}"
                                                                                data-psf="{{ 50 }}"
                                                                                data-ship_name="{{ $shipSchedule['ship']['title'] }}"
                                                                                class="btn {{ $adminFerry['class']['title'] }} ferry-btn mb-2">
                                                                                {{ $adminFerry['class']['title'] }}
                                                                                <p class="text-white">
                                                                                    ₹{{ $adminFerry['price'] }}</p>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @elseif($shipSchedule['ship_name'] == 'Makruzz')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg">
                                                                    <img src="{{ $shipSchedule['ship_image'] }}"
                                                                        alt="" style="">
                                                                </div>

                                                                <div class="ferryDetails ms-3 ">

                                                                    <div>
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship_name'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                        </p>

                                                                        <p class="mb-3">
                                                                            {{ $shipSchedule['ship_class'][0]->source_name ?? 'NA' }}
                                                                            -
                                                                            {{ $shipSchedule['ship_class'][0]->destination_name ?? 'NA' }}
                                                                        </p>

                                                                    </div>

                                                                    <div class="classBtn">
                                                                        @foreach ($shipSchedule['ship_class'] as $ferryPrice)
                                                                            <a href="#"
                                                                                id="{{ 'ferry_' . $ferryPrice->ship_class_title . '_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $ferryPrice->id }}"
                                                                                data-makruzz_class_id="{{ $ferryPrice->ship_class_id }}"
                                                                                data-from="{{ $ferryPrice->source_name }}"
                                                                                data-to="{{ $ferryPrice->destination_name }}"
                                                                                data-departure_time="{{ $ferryPrice->departure_time }}"
                                                                                data-arrival_time="{{ $ferryPrice->arrival_time }}"
                                                                                data-class-title="{{ $ferryPrice->ship_class_title }}"
                                                                                data-price="{{ $ferryPrice->ship_class_price }}"
                                                                                data-psf="{{ $ferryPrice->psf }}"
                                                                                data-ship_name="{{ 'Makruzz' }}"
                                                                                class="btn {{ $ferryPrice->ship_class_title }} ferry-btn mb-2">
                                                                                {{ $ferryPrice->ship_class_title }}<p
                                                                                    class="text-white">₹
                                                                                    {{ number_format($ferryPrice->ship_class_price, 2) }}
                                                                                </p>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>


        {{-- ************************************************** for Return trip ****************************************** --}}

        @if ($_REQUEST['trip_type'] == 'return_trip')
            <section class="mt-5 pt-3 searchResultsPage">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-12 col-md-12 col-lg-8">
                            <div class="row secHead mb-4">
                                <div class="col-12 text-center">
                                    <h2>Search Results For Ferry</h2>
                                </div>
                            </div>
                            <div class="route row px-2">
                                <div class="col-10">
                                    <nav class=" mb-3  tabNav ">
                                        <div class="row w-100 m-0 nav nav-tabs  border-0"
                                            id="nav-tab" role="tablist">
                                            <button class="nav-link  active col-6 border-0" id="nav-profile-tab" style="color: black; background:#0076ae"
                                                data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
                                                role="tab" aria-controls="nav-profile" aria-selected="false"
                                                tabindex="-1">{{ $route_titles['from_location'] }} -
                                                {{ $route_titles['to_location'] }}
                                            </button>
                                            <button class="nav-link return_tab_button col-6 border-0 disabled" style="color: black; background:#0076ae"
                                                id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                                                type="button" role="tab" aria-controls="nav-contact"
                                                aria-selected="true">{{ $route_titles['to_location'] }} -
                                                {{ $route_titles['from_location'] }}
                                            </button>
                                        </div>
                                    </nav>
                                </div>
                                <div class="col-12">
                                    <div class="tab-content  border bg-transparent border-0" id="nav-tabContent">
                                        <div class="tab-pane fade active show " id="nav-profile" role="tabpanel"
                                            aria-labelledby="nav-profile-tab">

                                            <div class="row">
                                                <div class="col-12 p-0 searchResults">
                                                    @if (isset($apiScheduleData))
                                                        @foreach ($apiScheduleData as $key => $shipSchedule)
                                                            @if ($shipSchedule['ship_name'] == 'Nautika')
                                                                <div class="ferryCard ferrySearch mb-3">
                                                                    <div class="ferryImg">
                                                                        <img src="{{ $shipSchedule['ship_image'] }}"
                                                                            alt="" style="">
                                                                    </div>
                                                                    <div class="ferryDetails ms-3 ">
                                                                        <div>
                                                                            <h4 class="mb-3">
                                                                                {{ $shipSchedule['ship_name'] }}
                                                                            </h4>
                                                                            <p class="mb-3">
                                                                                Departure Time
                                                                                {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                            </p>
                                                                            <p class="mb-3">
                                                                                {{ $shipSchedule['from'] ?? 'NA' }} -
                                                                                {{ $shipSchedule['to'] ?? 'NA' }}
                                                                            </p>
                                                                        </div>

                                                                        <div class="classBtn">
                                                                            <a href="#"
                                                                                id="{{ 'ferry_p_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                                data-trip_id="{{ $shipSchedule['tripId'] }}"
                                                                                data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                                                                data-from="{{ $shipSchedule['from'] }}"
                                                                                data-to="{{ $shipSchedule['to'] }}"
                                                                                data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                                data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                                data-class-title="{{ 'Premium' }}"
                                                                                data-nautika_class_id="{{ 1 }}"
                                                                                data-price="{{ $shipSchedule['fares']->pBaseFare }}"
                                                                                data-psf="{{ 50 }}"
                                                                                data-ship_name="{{ 'Nautika' }}"
                                                                                class="btn {{ 'Premium' }} return_tab mb-2">
                                                                                {{ 'Premium' }}
                                                                                <p class="text-white">
                                                                                    ₹{{ $shipSchedule['fares']->pBaseFare }}
                                                                                </p>
                                                                            </a>
                                                                        
                                                                            <a href="#"
                                                                                id="{{ 'ferry_b_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                                data-trip_id="{{ $shipSchedule['tripId'] }}"
                                                                                data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                                                                data-from="{{ $shipSchedule['from'] }}"
                                                                                data-to="{{ $shipSchedule['to'] }}"
                                                                                data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                                data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                                data-class-title="{{ 'Bussiness' }}"
                                                                                data-nautika_class_id="{{ 2 }}"
                                                                                data-price="{{ $shipSchedule['fares']->bBaseFare }}"
                                                                                data-psf="{{ 50 }}"
                                                                                data-ship_name="{{ 'Nautika' }}"
                                                                                class="btn {{ 'Business' }} return_tab mb-2">
                                                                                {{ 'Business' }}
                                                                                <p class="text-white">
                                                                                    ₹{{ $shipSchedule['fares']->bBaseFare }}
                                                                                </p>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @elseif($shipSchedule['ship_name'] == 'Admin')
                                                                <div class="ferryCard ferrySearch mb-3">
                                                                    <div class="ferryImg">
                                                                        <img src="{{ $shipSchedule['ship']['image'] }}"
                                                                            alt="" style="">
                                                                    </div>
                                                                    <div class="ferryDetails ms-3 ">
                                                                        <div>
                                                                            <h4 class="mb-3">
                                                                                {{ $shipSchedule['ship']['title'] }}
                                                                            </h4>
                                                                            <p class="mb-3">
                                                                                Departure Time
                                                                                {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                            </p>
                                                                            <p class="mb-3">
                                                                                {{ $shipSchedule['from_location']['title'] ?? 'NA' }}
                                                                                -
                                                                                {{ $shipSchedule['to_location']['title'] ?? 'NA' }}
                                                                            </p>
                                                                        </div>

                                                                        <div>
                                                                            @foreach ($shipSchedule['ferry_prices'] as $adminFerry)
                                                                                <a href="#"
                                                                                    id="{{ 'ferry_p_' . $key + 1 }}"
                                                                                    data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                                    data-from="{{ $shipSchedule['from_location']['title'] }}"
                                                                                    data-to="{{ $shipSchedule['to_location']['title'] }}"
                                                                                    data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                                    data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                                    data-class-title="{{ $adminFerry['class']['title'] }}"
                                                                                    data-green_class_id="{{ $adminFerry['class']['id'] }}"
                                                                                    data-price="{{ $adminFerry['price'] }}"
                                                                                    data-psf="{{ 50 }}"
                                                                                    data-ship_name="{{ $shipSchedule['ship']['title'] }}"
                                                                                    class="btn {{ $adminFerry['class']['title'] }} return_tab mb-2 me-2">
                                                                                    {{ $adminFerry['class']['title'] }}
                                                                                    <p class="text-white">
                                                                                        ₹{{ $adminFerry['price'] }}</p>
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($shipSchedule['ship_name'] == 'Makruzz')
                                                                <div class="ferryCard ferrySearch mb-3">
                                                                    <div class="ferryImg">
                                                                        <img src="{{ $shipSchedule['ship_image'] }}"
                                                                            alt="" style="">
                                                                    </div>

                                                                    <div class="ferryDetails ms-3 ">

                                                                        <div>
                                                                            <h4 class="mb-3">
                                                                                {{ $shipSchedule['ship_name'] }}
                                                                            </h4>
                                                                            <p class="mb-3">
                                                                                Departure Time
                                                                                {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                            </p>

                                                                            <p class="mb-3">
                                                                                {{ $shipSchedule['ship_class'][0]->source_name ?? 'NA' }}
                                                                                -
                                                                                {{ $shipSchedule['ship_class'][0]->destination_name ?? 'NA' }}
                                                                            </p>

                                                                        </div>

                                                                        <div class="">
                                                                            @foreach ($shipSchedule['ship_class'] as $ferryPrice)
                                                                                <a href="#"
                                                                                    id="{{ 'ferry_' . $ferryPrice->ship_class_title . '_' . $key + 1 }}"
                                                                                    data-ferryschedule-id="{{ $ferryPrice->id }}"
                                                                                    data-makruzz_class_id="{{ $ferryPrice->ship_class_id }}"
                                                                                    data-from="{{ $ferryPrice->source_name }}"
                                                                                    data-to="{{ $ferryPrice->destination_name }}"
                                                                                    data-departure_time="{{ $ferryPrice->departure_time }}"
                                                                                    data-arrival_time="{{ $ferryPrice->arrival_time }}"
                                                                                    data-class-title="{{ $ferryPrice->ship_class_title }}"
                                                                                    data-price="{{ $ferryPrice->ship_class_price }}"
                                                                                    data-psf="{{ $ferryPrice->psf }}"
                                                                                    data-ship_name="{{ 'Makruzz' }}"
                                                                                    class="btn {{ $ferryPrice->ship_class_title }} return_tab mb-2">
                                                                                    {{ $ferryPrice->ship_class_title }}<p
                                                                                        class="text-white">₹
                                                                                        {{ number_format($ferryPrice->ship_class_price, 2) }}
                                                                                    </p>
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        <input type="hidden" name="ferryschedule-id" id="single_ferryschedule-id"
                                            value="">
                                        <input type="hidden" name="trip_id" id="single_trip_id" value="">
                                        <input type="hidden" name="vessel_id" id="single_vessel_id" value="">
                                        <input type="hidden" name="from" id="single_from" value="">
                                        <input type="hidden" name="to" id="single_to" value="">
                                        <input type="hidden" name="departure_time" id="single_departure_time"
                                            value="">
                                        <input type="hidden" name="arrival_time" id="single_arrival_time"
                                            value="">
                                        <input type="hidden" name="class-title" id="single_class-title" value="">
                                        <input type="hidden" name="nautika_class_id" id="single_nautika_class_id"
                                            value="">
                                        <input type="hidden" name="price" id="single_price" value="">
                                        <input type="hidden" name="psf" id="single_psf" value="">
                                        <input type="hidden" name="ship_name" id="single_ship_name" value="">
                                        <input type="hidden" name="green_class_id" id="single_green_class_id" value="">
                                        <input type="hidden" name="makruzz_class_id" id="single_makruzz_class_id"
                                            value="">

                                        <div class="tab-pane societyList fade next_return_tab " id="nav-contact"
                                            role="tabpanel" aria-labelledby="nav-contact-tab">
                                            <div class="row">
                                                <div class="col-12 searchResults">
                                                    @if (isset($apiScheduleDataReturn))
                                                        @foreach ($apiScheduleDataReturn as $key => $shipScheduleReturn)
                                                            @if ($shipScheduleReturn['ship_name'] == 'Nautika')
                                                                <div class="ferryCard ferrySearch mb-3">
                                                                    <div class="ferryImg">
                                                                        <img src="{{ $shipScheduleReturn['ship_image'] }}"
                                                                            alt="" style="">
                                                                    </div>

                                                                    <div class="ferryDetails ms-3 ">

                                                                        <div>
                                                                            <h4 class="mb-3">
                                                                                {{ $shipScheduleReturn['ship_name'] }}
                                                                            </h4>
                                                                            <p class="mb-3">
                                                                                Departure Time
                                                                                {{ date('H:i', strtotime($shipScheduleReturn['departure_time'])) }}
                                                                            </p>
                                                                            <p class="mb-3">
                                                                                {{ $shipScheduleReturn['from'] ?? 'NA' }}
                                                                                - {{ $shipScheduleReturn['to'] ?? 'NA' }}
                                                                            </p>

                                                                        </div>

                                                                        <div class="classBtn">
                                                                            <a href="#"
                                                                                id="{{ 'ferry_p_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $shipScheduleReturn['id'] }}"
                                                                                data-trip_id="{{ $shipScheduleReturn['tripId'] }}"
                                                                                data-vessel_id="{{ $shipScheduleReturn['vesselID'] }}"
                                                                                data-from="{{ $shipScheduleReturn['from'] }}"
                                                                                data-to="{{ $shipScheduleReturn['to'] }}"
                                                                                data-departure_time="{{ $shipScheduleReturn['departure_time'] }}"
                                                                                data-arrival_time="{{ $shipScheduleReturn['arrival_time'] }}"
                                                                                data-class-title="{{ 'Premium' }}"
                                                                                data-nautika_class_id="{{ 1 }}"
                                                                                data-price="{{ $shipScheduleReturn['fares']->pBaseFare }}"
                                                                                data-psf="{{ 50 }}"
                                                                                data-ship_name="{{ 'Nautika' }}"
                                                                                class="btn {{ 'Premium' }} return_trip_button mb-2">
                                                                                {{ 'Premium' }}
                                                                                <p class="text-white">
                                                                                    ₹{{ $shipScheduleReturn['fares']->pBaseFare }}
                                                                                </p>
                                                                            </a>
                                                                        
                                                                            <a href="#"
                                                                                id="{{ 'ferry_b_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $shipScheduleReturn['id'] }}"
                                                                                data-trip_id="{{ $shipScheduleReturn['tripId'] }}"
                                                                                data-vessel_id="{{ $shipScheduleReturn['vesselID'] }}"
                                                                                data-from="{{ $shipScheduleReturn['from'] }}"
                                                                                data-to="{{ $shipScheduleReturn['to'] }}"
                                                                                data-departure_time="{{ $shipScheduleReturn['departure_time'] }}"
                                                                                data-arrival_time="{{ $shipScheduleReturn['arrival_time'] }}"
                                                                                data-class-title="{{ 'Bussiness' }}"
                                                                                data-nautika_class_id="{{ 2 }}"
                                                                                data-price="{{ $shipScheduleReturn['fares']->bBaseFare }}"
                                                                                data-psf="{{ 50 }}"
                                                                                data-ship_name="{{ 'Nautika' }}"
                                                                                class="btn {{ 'Business' }} return_trip_button  mb-2">
                                                                                {{ 'Business' }}
                                                                                <p class="text-white">
                                                                                    ₹{{ $shipScheduleReturn['fares']->bBaseFare }}
                                                                                </p>
                                                                            </a>
                                                                        </div>
                                                                        <div>
                                                                            <button> Return </button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @elseif($shipScheduleReturn['ship_name'] == 'Admin')
                                                                <div class="ferryCard ferrySearch mb-3">
                                                                    <div class="ferryImg">
                                                                        <img src="{{ $shipScheduleReturn['ship']['image'] }}"
                                                                            alt="" style="">
                                                                    </div>
                                                                    <div class="ferryDetails ms-3 ">
                                                                        <div>
                                                                            <h4 class="mb-3">
                                                                                {{ $shipScheduleReturn['ship']['title'] }}
                                                                            </h4>
                                                                            <p class="mb-3">
                                                                                Departure Time
                                                                                {{ date('H:i', strtotime($shipScheduleReturn['departure_time'])) }}
                                                                            </p>
                                                                            <p class="mb-3">
                                                                                {{ $shipScheduleReturn['from_location']['title'] ?? 'NA' }}
                                                                                -
                                                                                {{ $shipScheduleReturn['to_location']['title'] ?? 'NA' }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            @foreach ($shipScheduleReturn['ferry_prices'] as $adminFerry)
                                                                                <a href="#"
                                                                                    id="{{ 'ferry_p_' . $key + 1 }}"
                                                                                    data-ferryschedule-id="{{ $shipScheduleReturn['id'] }}"
                                                                                    data-from="{{ $shipScheduleReturn['from_location']['title'] }}"
                                                                                    data-to="{{ $shipScheduleReturn['to_location']['title'] }}"
                                                                                    data-departure_time="{{ $shipScheduleReturn['departure_time'] }}"
                                                                                    data-arrival_time="{{ $shipScheduleReturn['arrival_time'] }}"
                                                                                    data-class-title="{{ $adminFerry['class']['title'] }}"
                                                                                    data-green_class_id="{{ $adminFerry['class']['id'] }}"
                                                                                    data-price="{{ $adminFerry['price'] }}"
                                                                                    data-psf="{{ 50 }}"
                                                                                    data-ship_name="{{ $shipScheduleReturn['ship']['title'] }}"
                                                                                    class="btn {{ $adminFerry['class']['title'] }} return_trip_button mb-2 me-2">
                                                                                    {{ $adminFerry['class']['title'] }}
                                                                                    <p class="text-white">
                                                                                        ₹{{ $adminFerry['price'] }}</p>
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif ($shipScheduleReturn['ship_name'] == 'Makruzz')
                                                                <div class="ferryCard ferrySearch mb-3">
                                                                    <div class="ferryImg">
                                                                        <img src="{{ $shipScheduleReturn['ship_image'] }}"
                                                                            alt="" >
                                                                    </div>
                                                                    <div class="ferryDetails ms-3 ">
                                                                        <div>
                                                                            <h4 class="mb-3">
                                                                                {{ $shipScheduleReturn['ship_name'] }}
                                                                            </h4>
                                                                            <p class="mb-3">
                                                                                Departure Time
                                                                                {{ date('H:i', strtotime($shipScheduleReturn['departure_time'])) }}
                                                                            </p>

                                                                            <p class="mb-3">
                                                                                {{ $shipScheduleReturn['ship_class'][0]->source_name ?? 'NA' }}
                                                                                -
                                                                                {{ $shipScheduleReturn['ship_class'][0]->destination_name ?? 'NA' }}
                                                                            </p>

                                                                        </div>
                                                                        <div class="">
                                                                            @foreach ($shipScheduleReturn['ship_class'] as $ferryPrice)
                                                                                <a href="#"
                                                                                    id="{{ 'ferry_' . $ferryPrice->ship_class_title . '_' . $key + 1 }}"
                                                                                    data-ferryschedule-id="{{ $ferryPrice->id }}"
                                                                                    data-makruzz_class_id="{{ $ferryPrice->ship_class_id }}"
                                                                                    data-from="{{ $ferryPrice->source_name }}"
                                                                                    data-to="{{ $ferryPrice->destination_name }}"
                                                                                    data-departure_time="{{ $ferryPrice->departure_time }}"
                                                                                    data-arrival_time="{{ $ferryPrice->arrival_time }}"
                                                                                    data-class-title="{{ $ferryPrice->ship_class_title }}"
                                                                                    data-price="{{ $ferryPrice->ship_class_price }}"
                                                                                    data-psf="{{ $ferryPrice->psf }}"
                                                                                    data-ship_name="{{ 'Makruzz' }}"
                                                                                    class="btn {{ $ferryPrice->ship_class_title }} return_trip_button mb-2">
                                                                                    {{ $ferryPrice->ship_class_title }}<p
                                                                                        class="text-white">₹
                                                                                        {{ number_format($ferryPrice->ship_class_price, 2) }}
                                                                                    </p>
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </main>
@endsection

@push('js')
    <script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function() {
        const toDateInput = document.getElementById('return_date_of_journey');
        
        // Check if the input is empty and set the initial date
        if (!toDateInput.value) {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 2);
            toDateInput.value = tomorrow.toISOString().split('T')[0];
        }

        // Update the date every hour
        setInterval(() => {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            toDateInput.value = tomorrow.toISOString().split('T')[0];
        }, 60 * 60 * 1000);
    });


        function disableDiv() {
            $(".tabs.tabs2.row.mx-0").find("input, select, button").prop("disabled", true);
        }

        function disableDiv1() {
            $(".tabs.tabs1.row.mx-0").find("input, select, button").prop("disabled", true);
        }

        disableDiv();

        function enableDiv() {
            $(".tabs.tabs2.row.mx-0").find("input, select, button").prop("disabled", false);
        }

        function enableDiv1() {
            $(".tabs.tabs1.row.mx-0").find("input, select, button").prop("disabled", false);
        }

        function updateToLocationOptions() {
            var formLocationValue = document.getElementById('form_location').value;
            var toLocation = document.getElementById('to_location');

            for (var i = 0; i < toLocation.options.length; i++) {
                var option = toLocation.options[i];
                if (option.value === formLocationValue) {
                    option.disabled = true;
                    if (option.selected) {
                        toLocation.selectedIndex = 0;
                    }
                } else {
                    option.disabled = false;
                }
            }
        }

        function getQueryParams() {
            const params = new URLSearchParams(window.location.search);
            return {
                tripType: params.get('trip_type'),
            };
        }

        function activateTab(tripType) {
            if (tripType === 'single_trip') {
                $('.tabBtn2').removeClass('active');
                $('.tabBtn1').addClass('active');
                $('#nav-contact').addClass('disabled');
                $(".return_tab_button").prop("disabled", true);

            } else if (tripType === 'return_trip') {
                $('.tabBtn1').removeClass('active');
                // $('.tabBtn2').addClass('active');                
                $('.tabBtn2').trigger('click');
                enableDiv();
                disableDiv1();
            }
        }

        $(document).ready(function() {
            document.getElementById('form_location').addEventListener('change', function() {
                updateToLocationOptions();
            });
            updateToLocationOptions();

            $('.ferry-btn').on('click', function(event) {
                event.preventDefault();

                var ferryScheduleId = $(this).data('ferryschedule-id');
                var tripId = $(this).data('trip_id');
                if (tripId == undefined) {
                    var tripId = '';
                }
                var vesselID = $(this).data('vessel_id');
                if (vesselID == undefined) {
                    var vesselID = '';
                }
                var from = $(this).data('from');
                var to = $(this).data('to');
                var departure_date = $(this).data('departure_time');
                var arrival_time = $(this).data('arrival_time');
                var nautika_class_id = $(this).data('nautika_class_id');
                if (nautika_class_id == undefined) {
                    var nautika_class_id = '';
                }
                var makruzz_class_id = $(this).data('makruzz_class_id');
                if (makruzz_class_id == undefined) {
                    var makruzz_class_id = '';
                }
                var green_class_id = $(this).data('green_class_id');
                if (green_class_id == undefined) {
                    var green_class_id = '';
                }
                
                var ferry_class_title = $(this).data('class-title');
                var price = $(this).data('price');
                var psf = $(this).data('psf') ?? 0;

                var ship_name = $(this).data('ship_name');

                // var ferryClass = $('#ferryClass').val();
                var date = $('#date').val();
                var passengers = $('#passengers').val();
                var infants = $('#infants').val();
                var mobileNo = $("#mobile_no").val();
                
                var otp = $("#otp").val();
                var newUrl = '{{ route('booking-ferry') }}';
                newUrl += '?ferryScheduleId=' + encodeURIComponent(ferryScheduleId);
                newUrl += '&nautika_class_id=' + encodeURIComponent(nautika_class_id);
                newUrl += '&makruzz_class_id=' + encodeURIComponent(makruzz_class_id);
                newUrl += '&green_class_id=' + encodeURIComponent(green_class_id);
                newUrl += '&ferry_class_title=' + encodeURIComponent(ferry_class_title);
                newUrl += '&tripId=' + encodeURIComponent(tripId);
                newUrl += '&vesselID=' + encodeURIComponent(vesselID);
                newUrl += '&from=' + encodeURIComponent(from);
                newUrl += '&to=' + encodeURIComponent(to);
                newUrl += '&departure_date=' + encodeURIComponent(departure_date);
                newUrl += '&arrival_time=' + encodeURIComponent(arrival_time);
                newUrl += '&date=' + encodeURIComponent(date);
                newUrl += '&passengers=' + encodeURIComponent(passengers);
                newUrl += '&infants=' + encodeURIComponent(infants);
                newUrl += '&price=' + encodeURIComponent(price);
                newUrl += '&psf=' + encodeURIComponent(psf);
                newUrl += '&ship_name=' + encodeURIComponent(ship_name);
                newUrl += '&trip_type=' + encodeURIComponent('single_trip');
                window.location.href = newUrl;

            });


            $(document).on('click', '.return_tab', function(event) {
                event.preventDefault();

                var ferryScheduleId = $(this).data('ferryschedule-id');
                var tripId = $(this).data('trip_id');
                if (tripId == undefined) {
                    var tripId = '';
                }
                var vesselID = $(this).data('vessel_id');
                if (vesselID == undefined) {
                    var vesselID = '';
                }
                var from = $(this).data('from');
                var to = $(this).data('to');
                var departure_date = $(this).data('departure_time');
                var arrival_time = $(this).data('arrival_time');
                var nautika_class_id = $(this).data('nautika_class_id');
                if (nautika_class_id == undefined) {
                    var nautika_class_id = '';
                }
                var makruzz_class_id = $(this).data('makruzz_class_id');
                if (makruzz_class_id == undefined) {
                    var makruzz_class_id = '';
                }
                var green_class_id = $(this).data('green_class_id');
                if (green_class_id == undefined) {
                    var green_class_id = '';
                }
           
                var ferry_class_title = $(this).data('class-title');
                var price = $(this).data('price');
                var psf = $(this).data('psf') ?? 0;

                var ship_name = $(this).data('ship_name');

                // var ferryClass = $('#ferryClass').val();
                var date = $('#date').val();
                var passengers = $('#passengers').val();
                var infants = $('#infants').val();
                var return_date_of_journey = $('#return_date_of_journey').val();
                var mobileNo = $("#mobile_no").val();
                var otp = $("#otp").val();


                $('#single_ferryschedule-id').val(ferryScheduleId);
                $('#single_trip_id').val(tripId);
                $('#single_vessel_id').val(vesselID);
                $('#single_from').val(from);
                $('#single_to').val(to);
                $('#single_departure_time').val(departure_date);
                $('#single_arrival_time').val(arrival_time);
                $('#single_class-title').val(ferry_class_title);
                $('#single_nautika_class_id').val(nautika_class_id);
                $('#single_price').val(price);
                $('#single_psf').val(psf);
                $('#single_ship_name').val(ship_name);
                $('#single_makruzz_class_id').val(makruzz_class_id);
                $('#single_green_class_id').val(green_class_id);


                $(document).find("#nav-contact-tab").removeClass('disabled').trigger("click");
            });


            $('.return_trip_button').on('click', function(event) {
                event.preventDefault();

                var return_ferryScheduleId = $(this).data('ferryschedule-id');
                //alert(return_ferryScheduleId);
                var return_tripId = $(this).data('trip_id');
                if (return_tripId == undefined) {
                    var return_tripId = '';
                }
                var return_vesselID = $(this).data('vessel_id');
                if (return_vesselID == undefined) {
                    var return_vesselID = '';
                }
                var return_from = $(this).data('from');
                var return_to = $(this).data('to');
                var return_departure_date = $(this).data('departure_time');
                var return_arrival_time = $(this).data('arrival_time');
                var return_nautika_class_id = $(this).data('nautika_class_id');
                if (return_nautika_class_id == undefined) {
                    var return_nautika_class_id = '';
                }
                var return_makruzz_class_id = $(this).data('makruzz_class_id');
                if (return_makruzz_class_id == undefined) {
                    var return_makruzz_class_id = '';
                }
                var return_green_class_id = $(this).data('green_class_id');
                if (return_green_class_id == undefined) {
                    var return_green_class_id = '';
                }
              
                var return_ferry_class_title = $(this).data('class-title');
                var return_price = $(this).data('price');
                var return_psf = $(this).data('psf') ?? 0;
                var return_ship_name = $(this).data('ship_name');

                // var ferryClass = $('#ferryClass').val();
                var return_date = $('#date').val();
                var return_date_of_journey = $('#return_date_of_journey').val();

                var return_passengers = $('#passengers').val();
                var return_infants = $('#infants').val();
            
                var return_mobileNo = $("#mobile_no").val();
                var return_otp = $("#otp").val();


                ferryScheduleId = $('#single_ferryschedule-id').val();

                tripId = $('#single_trip_id').val();
                vesselID = $('#single_vessel_id').val();
                from = $('#single_from').val();
                to = $('#single_to').val();
                departure_date = $('#single_departure_time').val();
                arrival_time = $('#single_arrival_time').val();
                ferry_class_title = $('#single_class-title').val();
                nautika_class_id = $('#single_nautika_class_id').val();
                green_class_id = $('#single_green_class_id').val();
                price = $('#single_price').val();
                psf = $('#single_psf').val();
                ship_name = $('#single_ship_name').val();
                makruzz_class_id = $('#single_makruzz_class_id').val();

                var newUrl = "{{ route('booking-ferry') }}";
                newUrl += '?ferryScheduleId=' + encodeURIComponent(ferryScheduleId);
                newUrl += '&nautika_class_id=' + encodeURIComponent(nautika_class_id);
                newUrl += '&makruzz_class_id=' + encodeURIComponent(makruzz_class_id);
                newUrl += '&green_class_id=' + encodeURIComponent(green_class_id);
                newUrl += '&ferry_class_title=' + encodeURIComponent(ferry_class_title);
                newUrl += '&tripId=' + encodeURIComponent(tripId);
                newUrl += '&vesselID=' + encodeURIComponent(vesselID);
                newUrl += '&from=' + encodeURIComponent(from);
                newUrl += '&to=' + encodeURIComponent(to);
                newUrl += '&departure_date=' + encodeURIComponent(departure_date);
                newUrl += '&arrival_time=' + encodeURIComponent(arrival_time);

                newUrl += '&price=' + encodeURIComponent(price);
                newUrl += '&psf=' + encodeURIComponent(psf);
                newUrl += '&ship_name=' + encodeURIComponent(ship_name);


                newUrl += '&return_ferryScheduleId=' + encodeURIComponent(return_ferryScheduleId);
                newUrl += '&return_nautika_class_id=' + encodeURIComponent(return_nautika_class_id);
                newUrl += '&return_makruzz_class_id=' + encodeURIComponent(return_makruzz_class_id);
                newUrl += '&return_green_class_id=' + encodeURIComponent(return_green_class_id);
                newUrl += '&return_ferry_class_title=' + encodeURIComponent(return_ferry_class_title);
                newUrl += '&return_tripId=' + encodeURIComponent(return_tripId);
                newUrl += '&return_vesselID=' + encodeURIComponent(return_vesselID);
                newUrl += '&return_from=' + encodeURIComponent(return_from);
                newUrl += '&return_to=' + encodeURIComponent(return_to);
                newUrl += '&return_departure_date=' + encodeURIComponent(return_departure_date);
                newUrl += '&return_arrival_time=' + encodeURIComponent(return_arrival_time);
                newUrl += '&date=' + encodeURIComponent(return_date);
                newUrl += '&return_date=' + encodeURIComponent(return_date_of_journey);
                newUrl += '&passengers=' + encodeURIComponent(return_passengers);
                newUrl += '&infants=' + encodeURIComponent(return_infants);
                newUrl += '&return_price=' + encodeURIComponent(return_price);
                newUrl += '&return_psf=' + encodeURIComponent(return_psf);
                newUrl += '&return_ship_name=' + encodeURIComponent(return_ship_name);
                newUrl += '&return_trip_type=return_trip';
                window.location.href = newUrl;

            });

            $(".tabBtn.tabBtn2").on("click", function() {
                enableDiv();
                disableDiv1();
            });

            $(".tabBtn.tabBtn1").on("click", function() {
                enableDiv1();
                disableDiv();
            });

            const queryParams = getQueryParams();
            activateTab(queryParams.tripType);

        });
    </script>
@endpush
