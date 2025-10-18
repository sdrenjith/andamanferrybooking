{{-- FIXED VERSION - NO DUPLICATE IDs --}}
@extends('layouts.app')

@section('content')
<div class="tab-content border bg-transparent border-0" id="nav-tabContent">
    {{-- DEPARTURE TAB --}}
    <div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="row">
            <div class="col-12 searchResults px-0">
                {{-- Departure Journey Ferries --}}
                @if (isset($apiScheduleData) && !empty($apiScheduleData))
                    @foreach ($apiScheduleData as $key => $shipSchedule)
                        {{-- Ferry rendering code for departure (keep existing code) --}}
                        @if ($shipSchedule['ship_name'] == 'Nautika')
                            <div class="ferryCard ferrySearch mb-3">
                                {{-- Nautika ferry card code --}}
                            </div>
                        @elseif($shipSchedule['ship_name'] == 'Admin')
                            <div class="ferryCard ferrySearch mb-3">
                                {{-- Admin ferry card code --}}
                            </div>
                        @elseif($shipSchedule['ship_name'] == 'Makruzz')
                            <div class="ferryCard ferrySearch mb-3">
                                {{-- Makruzz ferry card code --}}
                            </div>
                        @elseif($shipSchedule['ship_name'] == 'Green Ocean 1' || $shipSchedule['ship_name'] == 'Green Ocean 2')
                            <div class="ferryCard ferrySearch mb-3">
                                {{-- Green Ocean ferry card code --}}
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="alert alert-info">No ferries available for departure journey</div>
                @endif
            </div>
        </div>
    </div>

    {{-- RETURN TAB - ONLY ONE WITH CORRECT DATA --}}
    @if (request('trip_type') == 2)
        <div class="tab-pane fade" id="nav-extra" role="tabpanel" aria-labelledby="nav-extra-tab">
            <div class="row">
                <div class="col-12 searchResults px-0">
                    {{-- Return Journey Ferries --}}
                    @if (isset($apiScheduleData3) && !empty($apiScheduleData3))
                        @foreach ($apiScheduleData3 as $key => $shipSchedule)
                            {{-- NAUTIKA FERRY --}}
                            @if ($shipSchedule['ship_name'] == 'Nautika')
                                <div class="ferryCard ferrySearch mb-3">
                                    <div class="ferryImg" data-ferry-id="{{ $shipSchedule['id'] }}">
                                        <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}" alt="">
                                    </div>
                                    <div class="ferryDetails ms-3">
                                        <div class="ferryName">
                                            <h4 class="mb-3">{{ $shipSchedule['ship_name'] }}</h4>
                                            <p class="mb-3">Departure Time {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}</p>
                                            <p class="mb-3">Arrival Time {{ isset($shipSchedule['arrival_time']) ? date('H:i', strtotime($shipSchedule['arrival_time'])) : 'N/A' }}</p>
                                            <p class="mb-3">{{ $return_route_titles['from_location'] ?? 'N/A' }} - {{ $return_route_titles['to_location'] ?? 'N/A' }}</p>
                                        </div>
                                        <div class="classBtn">
                                            <a href="#" id="ferry_p_{{ $key + 1 }}" 
                                               data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                               data-trip_id="{{ $shipSchedule['tripId'] }}"
                                               data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                               data-from="{{ $return_route_titles['from_location'] ?? 'N/A' }}"
                                               data-to="{{ $return_route_titles['to_location'] ?? 'N/A' }}"
                                               data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                               data-arrival_time="{{ $shipSchedule['arrival_time'] ?? 'N/A' }}"
                                               data-class-title="Premium"
                                               data-class_id="pClass"
                                               data-price="{{ $shipSchedule['fares']->pBaseFare }}"
                                               data-psf="50"
                                               data-avl_seat="{{ $shipSchedule['p_class_seat_availibility'] }}"
                                               data-ship_name="Nautika"
                                               class="btn Premium ferry-btn3 mb-2"
                                               data-bs-toggle="modal"
                                               data-bs-target="#exampleModal">
                                                <p class="text-white mb-0">Premium</p>
                                                <p class="text-white mb-0" style="text-decoration: line-through;">₹{{ $shipSchedule['fares']->pBaseFare }}</p>
                                                <p class="text-white mb-0">₹{{ $shipSchedule['fares']->pBaseFare - 100 }}</p>
                                                <p class="text-white mb-0">Seat: {{ $shipSchedule['p_class_seat_availibility'] }}</p>
                                                <p class="bg-green-text-white mb-0">Book Now</p>
                                            </a>
                                            <a href="#" id="ferry_b_{{ $key + 1 }}"
                                               data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                               data-trip_id="{{ $shipSchedule['tripId'] }}"
                                               data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                               data-from="{{ $return_route_titles['from_location'] ?? 'N/A' }}"
                                               data-to="{{ $return_route_titles['to_location'] ?? 'N/A' }}"
                                               data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                               data-arrival_time="{{ $shipSchedule['arrival_time'] ?? 'N/A' }}"
                                               data-class-title="Business"
                                               data-class_id="bClass"
                                               data-price="{{ $shipSchedule['fares']->bBaseFare }}"
                                               data-psf="50"
                                               data-avl_seat="{{ $shipSchedule['b_class_seat_availibility'] }}"
                                               data-ship_name="Nautika"
                                               class="btn Business ferry-btn3 mb-2"
                                               data-bs-toggle="modal"
                                               data-bs-target="#exampleModal">
                                                <p class="text-white mb-0">Business</p>
                                                <p class="text-white mb-0" style="text-decoration: line-through;">₹{{ $shipSchedule['fares']->bBaseFare }}</p>
                                                <p class="text-white mb-0">₹{{ $shipSchedule['fares']->bBaseFare - 100 }}</p>
                                                <p class="text-white mb-0">Seat: {{ $shipSchedule['b_class_seat_availibility'] }}</p>
                                                <p class="bg-green-text-white mb-0">Book Now</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            {{-- ADMIN FERRY --}}
                            @elseif($shipSchedule['ship_name'] == 'Admin')
                                <div class="ferryCard ferrySearch mb-3">
                                    <div class="ferryImg" data-ferry-id="{{ $shipSchedule['id'] }}">
                                        <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship']['image'] }}" alt="">
                                    </div>
                                    <div class="ferryDetails ms-3">
                                        <div class="ferryName">
                                            <h4 class="mb-3">{{ $shipSchedule['ship']['title'] }}</h4>
                                            <p class="mb-3">Departure Time {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}</p>
                                            <p class="mb-3">Arrival Time {{ isset($shipSchedule['arrival_time']) ? date('H:i', strtotime($shipSchedule['arrival_time'])) : 'N/A' }}</p>
                                            <p class="mb-3">{{ $return_route_titles['from_location'] ?? 'N/A' }} - {{ $return_route_titles['to_location'] ?? 'N/A' }}</p>
                                        </div>
                                        <div class="classBtn">
                                            @foreach ($shipSchedule['ferry_prices'] as $adminFerry)
                                                <a href="#" id="ferry_{{ $adminFerry['class']['title'] }}_{{ $key + 1 }}"
                                                   data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                   data-from="{{ $return_route_titles['from_location'] ?? 'N/A' }}"
                                                   data-to="{{ $return_route_titles['to_location'] ?? 'N/A' }}"
                                                   data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                   data-arrival_time="{{ $shipSchedule['arrival_time'] ?? 'N/A' }}"
                                                   data-class-title="{{ $adminFerry['class']['title'] }}"
                                                   data-class_id="{{ $adminFerry['class']['id'] }}"
                                                   data-price="{{ $adminFerry['price'] }}"
                                                   data-psf="50"
                                                   data-ship_name="Admin"
                                                   class="btn {{ $adminFerry['class']['title'] }} ferry-btn3 mb-2">
                                                    <p class="text-white mb-0">{{ $adminFerry['class']['title'] }}</p>
                                                    <p class="text-white mb-0">₹{{ $adminFerry['price'] }}</p>
                                                    <p class="bg-green-text-white mb-0">Book Now</p>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            {{-- MAKRUZZ FERRY --}}
                            @elseif($shipSchedule['ship_name'] == 'Makruzz')
                                <div class="ferryCard ferrySearch mb-3">
                                    <div class="ferryImg" data-ferry-id="{{ $shipSchedule['id'] }}">
                                        <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}" alt="">
                                    </div>
                                    <div class="ferryDetails ms-3">
                                        <div class="ferryName">
                                            <h4 class="mb-3">{{ $shipSchedule['ship_name'] }}</h4>
                                            <p class="mb-3">Departure Time {{ date('H:i', strtotime($shipSchedule['ship_class'][0]->departure_time)) }}</p>
                                            <p class="mb-3">Arrival Time {{ isset($shipSchedule['ship_class'][0]->arrival_time) ? date('H:i', strtotime($shipSchedule['ship_class'][0]->arrival_time)) : 'N/A' }}</p>
                                            <p class="mb-3">{{ $return_route_titles['from_location'] ?? 'N/A' }} - {{ $return_route_titles['to_location'] ?? 'N/A' }}</p>
                                        </div>
                                        <div class="classBtn">
                                            @foreach ($shipSchedule['ship_class'] as $ferryPrice)
                                                <a href="#" id="ferry_{{ $ferryPrice->ship_class_title ?? 'Standard' }}_{{ $key + 1 }}"
                                                   data-ferryschedule-id="{{ $ferryPrice->id }}"
                                                   data-class_id="{{ $ferryPrice->ship_class_id ?? 'N/A' }}"
                                                   data-from="{{ $return_route_titles['from_location'] ?? 'N/A' }}"
                                                   data-to="{{ $return_route_titles['to_location'] ?? 'N/A' }}"
                                                   data-departure_time="{{ $ferryPrice->departure_time ?? 'N/A' }}"
                                                   data-arrival_time="{{ $ferryPrice->arrival_time ?? 'N/A' }}"
                                                   data-class-title="{{ $ferryPrice->ship_class_title ?? 'Standard' }}"
                                                   data-price="{{ $ferryPrice->ship_class_price ?? 0 }}"
                                                   data-psf="{{ $ferryPrice->psf ?? 0 }}"
                                                   data-avl_seat="{{ $ferryPrice->seat ?? 0 }}"
                                                   data-ship_name="Makruzz"
                                                   class="btn {{ $ferryPrice->ship_class_title ?? 'Standard' }} ferry-btn3 mb-2">
                                                    <p class="text-white mb-0">{{ $ferryPrice->ship_class_title ?? 'Standard' }}</p>
                                                    <p class="text-white mb-0" style="text-decoration: line-through;">₹{{ $ferryPrice->ship_class_price ?? 0 }}</p>
                                                    <p class="text-white mb-0">₹{{ ($ferryPrice->ship_class_price ?? 0) - 100 }}</p>
                                                    <p class="text-white mb-0">Seat: {{ $ferryPrice->seat ?? 0 }}</p>
                                                    <p class="bg-green-text-white mb-0">Book Now</p>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            {{-- GREEN OCEAN FERRY --}}
                            @elseif($shipSchedule['ship_name'] == 'Green Ocean 1' || $shipSchedule['ship_name'] == 'Green Ocean 2')
                                <div class="ferryCard ferrySearch mb-3">
                                    <div class="ferryImg" data-ferry-id="{{ $shipSchedule['id'] }}">
                                        <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}" alt="">
                                    </div>
                                    <div class="ferryDetails ms-3">
                                        <div class="ferryName">
                                            <h4 class="mb-3">{{ $shipSchedule['ship_name'] }}</h4>
                                            <p class="mb-3">Departure Time {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}</p>
                                            <p class="mb-3">Arrival Time {{ isset($shipSchedule['arrival_time']) ? date('H:i', strtotime($shipSchedule['arrival_time'])) : 'N/A' }}</p>
                                            <p class="mb-3">{{ $return_route_titles['from_location'] ?? 'N/A' }} - {{ $return_route_titles['to_location'] ?? 'N/A' }}</p>
                                        </div>
                                        <div class="classBtn">
                                            @foreach ($shipSchedule['ship_class'] as $ferryPrice)
                                                <a href="#" id="ferry_{{ $ferryPrice->class_name ?? 'Standard' }}_{{ $key + 1 }}"
                                                   data-ferryschedule-id="{{ $ferryPrice->route_id ?? 'N/A' }}"
                                                   data-class_id="{{ $ferryPrice->class_id ?? 'N/A' }}"
                                                   data-from="{{ $return_route_titles['from_location'] ?? 'N/A' }}"
                                                   data-to="{{ $return_route_titles['to_location'] ?? 'N/A' }}"
                                                   data-departure_time="{{ date('H:i', strtotime($shipSchedule['departure_time'])) }}"
                                                   data-arrival_time="{{ isset($shipSchedule['arrival_time']) ? date('H:i', strtotime($shipSchedule['arrival_time'])) : 'N/A' }}"
                                                   data-class-title="{{ $ferryPrice->class_name ?? 'Standard' }}"
                                                   data-price="{{ $ferryPrice->adult_seat_rate ?? 0 }}"
                                                   data-psf="{{ $ferryPrice->port_fee ?? 0 }}"
                                                   data-avl_seat="{{ $ferryPrice->seat_available ?? 0 }}"
                                                   data-ship_name="{{ $ferryPrice->ferry_name ?? 'Unknown' }}"
                                                   data-ship_id="{{ $ferryPrice->ferry_id ?? 'N/A' }}"
                                                   class="btn {{ $ferryPrice->class_name ?? 'Standard' }} ferry-btn3 mb-2">
                                                    <p class="text-white mb-0">{{ $ferryPrice->class_name ?? 'Standard' }}</p>
                                                    <p class="text-white mb-0">₹{{ $ferryPrice->adult_seat_rate ?? 0 }}</p>
                                                    <p class="text-white mb-0">Seat: {{ $ferryPrice->seat_available ?? 0 }}</p>
                                                    <p class="bg-green-text-white mb-0">Book Now</p>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="alert alert-info">No ferries available for return journey</div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
