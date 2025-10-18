{{-- SIMPLE FIXED VERSION - FOCUS ON RETURN TAB ONLY --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Search Results For Ferry</h2>
            
            {{-- Tab Navigation --}}
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="departure-tab" data-bs-toggle="tab" data-bs-target="#departure" type="button" role="tab">
                        Port Blair - Havelock
                    </button>
                </li>
                @if (request('trip_type') == 2)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="return-tab" data-bs-toggle="tab" data-bs-target="#return" type="button" role="tab">
                        Havelock - Port Blair
                    </button>
                </li>
                @endif
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content" id="myTabContent">
                {{-- Departure Tab --}}
                <div class="tab-pane fade show active" id="departure" role="tabpanel">
                    <div class="alert alert-info">
                        <strong>Departure Journey:</strong><br>
                        Total Ferries: {{ count($apiScheduleData ?? []) }}<br>
                        Route: {{ $route_titles['from_location'] ?? 'N/A' }} → {{ $route_titles['to_location'] ?? 'N/A' }}
                    </div>
                    @if (isset($apiScheduleData) && !empty($apiScheduleData))
                        @foreach ($apiScheduleData as $key => $shipSchedule)
                            <div class="ferryCard ferrySearch mb-3">
                                <div class="ferryImg" data-ferry-id="{{ $shipSchedule['id'] }}">
                                    <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}" alt="">
                                </div>
                                <div class="ferryDetails ms-3">
                                    <div class="ferryName">
                                        <h4 class="mb-3">{{ $shipSchedule['ship_name'] }}</h4>
                                        <p class="mb-3">Departure Time {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}</p>
                                        <p class="mb-3">Arrival Time {{ isset($shipSchedule['arrival_time']) ? date('H:i', strtotime($shipSchedule['arrival_time'])) : 'N/A' }}</p>
                                        <p class="mb-3">{{ $route_titles['from_location'] ?? 'N/A' }} - {{ $route_titles['to_location'] ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">No ferries available for departure journey</div>
                    @endif
                </div>

                {{-- Return Tab - FIXED VERSION --}}
                @if (request('trip_type') == 2)
                <div class="tab-pane fade" id="return" role="tabpanel">
                    <div class="alert alert-success">
                        <strong>✅ RETURN TAB IS WORKING!</strong><br>
                        Total Return Ferries: {{ count($apiScheduleData3 ?? []) }}<br>
                        Return Route: {{ $return_route_titles['from_location'] ?? 'N/A' }} → {{ $return_route_titles['to_location'] ?? 'N/A' }}<br>
                        Return Date: {{ request('return_date') ?? 'N/A' }}
                    </div>
                    
                    @if (isset($apiScheduleData3) && !empty($apiScheduleData3))
                        @foreach ($apiScheduleData3 as $key => $shipSchedule)
                            <div class="alert alert-warning mb-2">
                                <strong>🔍 Processing Ferry {{ $key + 1 }}:</strong><br>
                                Ship Name: {{ $shipSchedule['ship_name'] ?? 'N/A' }}<br>
                                Ship Title: {{ $shipSchedule['ship']['title'] ?? 'N/A' }}<br>
                                Admin Check: {{ $shipSchedule['ship_name'] == 'Admin' ? 'YES' : 'NO' }}
                            </div>
                            
                            {{-- ADMIN FERRY RENDERING --}}
                            @if($shipSchedule['ship_name'] == 'Admin')
                                <div class="ferryCard ferrySearch mb-3" style="border: 2px solid green; padding: 15px;">
                                    <div class="ferryImg" data-ferry-id="{{ $shipSchedule['id'] }}">
                                        <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship']['image'] }}" alt="" style="width: 200px; height: 150px;">
                                    </div>
                                    <div class="ferryDetails ms-3">
                                        <div class="ferryName">
                                            <h4 class="mb-3" style="color: green;">{{ $shipSchedule['ship']['title'] }}</h4>
                                            <p class="mb-3">Departure Time {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}</p>
                                            <p class="mb-3">Arrival Time {{ isset($shipSchedule['arrival_time']) ? date('H:i', strtotime($shipSchedule['arrival_time'])) : 'N/A' }}</p>
                                            <p class="mb-3">{{ $return_route_titles['from_location'] ?? 'N/A' }} - {{ $return_route_titles['to_location'] ?? 'N/A' }}</p>
                                        </div>
                                        <div class="classBtn">
                                            @if (isset($shipSchedule['ferry_prices']) && !empty($shipSchedule['ferry_prices']))
                                                @foreach ($shipSchedule['ferry_prices'] as $ferryPrice)
                                                    <a href="#" id="ferry_{{ $ferryPrice['class']['title'] }}_{{ $key + 1 }}"
                                                       data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                       data-from="{{ $return_route_titles['from_location'] ?? 'N/A' }}"
                                                       data-to="{{ $return_route_titles['to_location'] ?? 'N/A' }}"
                                                       data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                       data-arrival_time="{{ $shipSchedule['arrival_time'] ?? 'N/A' }}"
                                                       data-class-title="{{ $ferryPrice['class']['title'] }}"
                                                       data-class_id="{{ $ferryPrice['class']['id'] }}"
                                                       data-price="{{ $ferryPrice['price'] }}"
                                                       data-psf="50"
                                                       data-ship_name="Admin"
                                                       class="btn {{ $ferryPrice['class']['title'] }} ferry-btn3 mb-2"
                                                       style="background-color: green; color: white; padding: 10px; margin: 5px;">
                                                        <p class="text-white mb-0">{{ $ferryPrice['class']['title'] }}</p>
                                                        <p class="text-white mb-0">₹{{ $ferryPrice['price'] }}</p>
                                                        <p class="bg-green-text-white mb-0">Book Now</p>
                                                    </a>
                                                @endforeach
                                            @else
                                                <p class="text-muted">No pricing information available</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <strong>Other Ferry Type:</strong> {{ $shipSchedule['ship_name'] }} - {{ $shipSchedule['ship']['title'] }}
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="alert alert-danger">No ferries available for return journey</div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
