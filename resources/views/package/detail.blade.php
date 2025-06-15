@extends('layouts.app')

<?php use App\Models\Sightseeing_location; ?>
@section('content')
<main>
   
    <section class="mb-5 ">
        <div class="container border-bottom pb-4">
            <div class="row">
                <div class="col-12">
                    <div class="pageHead">
                        <h1 class="text-start">{{ $data->data[0]->title }}</h1>
                    </div>
                    <div class="packageHead">
                        <span class="badge">{{ $data->data[0]->day }}D /{{ $data->data[0]->night }}N </span>
                        <p class="mb-0"></p>

                        @foreach($data->data[0]->packagestyle as $p_style)
                        <div class="blogInfo p-1">
                            <span class="badge economy ">{{$p_style->style_details->title}}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-6 col-12">
                        <div class="col-12 banner packageDetails">
                            <div id="carouselExampleCaptions" class="carousel slide">

                                <div class="carousel-inner ">
                                    @if(!empty($data->data[0]->packageimage))
                                    @foreach($data->data[0]->packageimage as $key => $val)
                                    <?php
                                    if ($key == 0) {
                                    ?>
                                    <div class="carousel-item active ">
                                        <img src="{{ !empty($data->data[0]->packageimage)?config('app.img_base').$val->path:config('app.img_base').'noimage.jpg' }}"
                                            width="100%" alt="">
                                    </div>
                                    <?php
                                    } else {
                                    ?>
                                    <div class="carousel-item  ">
                                        <img src="{{ !empty($data->data[0]->packageimage)?config('app.img_base').$val->path:config('app.img_base').'noimage.jpg' }}"
                                            width="100%" alt="">
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    @endforeach
                                    @endif
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 mt-2 mt-lg-0 packagdeInfo">
                        <div class="sectionHead ">
                            <h2 class="mt-0">Overview</h2>
                            <p class="">
                                {{ $data->data[0]->subtitle }}
                            </p>

                            <h3>Highlights</h3>
                            <ul>
                                <li>
                                    <div class="d-flex">

                                    </div>
                                </li>

                                <li>
                                    <div class="d-flex">
                                        @if($data->data[0]->packagefeature->night_stay == 1)
                                        <div class="">Night Stay &nbsp; </div>
                                        @endif
                                        @if($data->data[0]->packagefeature->transport == 1)
                                        <div class="">Transport &nbsp; </div>
                                        @endif
                                        @if($data->data[0]->packagefeature->activity == 1)
                                        <div class="">Activity &nbsp; </div>
                                        @endif
                                        @if($data->data[0]->packagefeature->ferry == 1)
                                        <div class="">Ferry &nbsp; </div>
                                        @endif
                                    </div>
                                </li>

                                <?php
                                foreach ($data->data[0]->packagesightseeing as $value) {
                                    //print_r($value->sightseeing->title);
                                ?>

                                <li>{{$value->sightseeing_pkg->title}}</li>

                                <?php }
                                // die();
                                ?>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 pkgNav">
                    <nav class=" mb-3  tabNav">
                        <div class="row w-100 m-0 nav nav-tabs justify-content-start border-0" id="nav-tab"
                            role="tablist">
                            <button class="nav-link active  col-lg-2 col-4 border-0" id="nav-itinerary-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-itinerary" type="button" role="tab"
                                aria-controls="nav-itinerary" aria-selected="false" tabindex="-1">ITINERARY</button>
                            <button class="nav-link  col-lg-2 col-4 border-0" id="nav-policies-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-policies" type="button" role="tab" aria-controls="nav-policies"
                                aria-selected="true">POLICIES</button>
                            <button class="nav-link col-lg-2 col-4 border-0" id="nav-summery-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-summery" type="button" role="tab" aria-controls="nav-summery"
                                aria-selected="true">SUMMARY</button>

                            <span id="activity-sum" data-activity_sum="{{ $activitySum }}"></span>
                           

                        </div>
                    </nav>
                </div>
                <div class="col-12">
                    <div class="tab-content border bg-white border-0" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-itinerary" role="tabpanel"
                            aria-labelledby="nav-itinerary-tab">
                            <div class="row itenarary">
                                <!-- <div class="col-3 ">
                                    <div class="dayList">
                                        <h3>Day Plan</h3>

                                        <div class="process-wrapper">
                                            <div id="progress-bar-container" class=" position-relative">
                                                <ul class="ps-0">
                                                    <li>
                                                        Day 1 <br>
                                                        <span>(21st Nov, Tuesday)</span>
                                                    </li>
                                                    <li>
                                                        Day 2 <br>
                                                        <span>(21st Nov, Tuesday)</span>
                                                    </li>
                                                    <li>
                                                        Day 3 <br>
                                                        <span>(21st Nov, Tuesday)</span>
                                                    </li>
                                                    <li>
                                                        Day 4 <br>
                                                        <span>(21st Nov, Tuesday)</span>
                                                    </li>

                                                </ul>
                                                <div id="line">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-12 col-lg-9 col-xl-9 col-xxl-9 p-0 ps-lg-0 ">
                                    <div class="accordion" id="accordionExample">
    @foreach($itinerarys as $key=> $itinerary)
                                       
                                    <input type="hidden" name="itinerary_days[]" value="{{$itinerary->itinerary_day}}">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button p-0 " type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    <div
                                                        class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                        <div class="pkgdate">
                                                            {{$itinerary->itinerary_day}} Day, Itinerary Details
                                                        </div>
                                                        <div class="includedList p-2 p-lg-0">
                                                            <h4 class="m-0 me-2">Included</h4>
                                                            <ul class="ps-0 d-flex mb-0 align-items-center">
                                                                <li class="list-unstyled">
                                                                    <img src="{{asset('/images/hotel.svg')}}"
                                                                        width="20px" height="20px" alt=""> 1 Hotel |
                                                                </li>
                                                                <li class="list-unstyled">
                                                                    <img src="{{asset('/images/cab.svg')}}"
                                                                        width="20px" height="20px" alt=""> 1 Cab |
                                                                </li>
                                                                <li class="list-unstyled">
                                                                    <img src="{{asset('/images/activities.svg')}}"
                                                                        width="20px" height="20px" alt=""> 1 Activity
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @if($key==0)
                                                    <div class="row" id="append_car_here">
                                                        <div class=" col-4 d-none d-md-block">
                                                            <img src="{{env('ASSET_PATH') .('uploads/cars/hatchback.jpeg')}}" width="100%"
                                                                alt="">
                                                        </div>
                                                        <div class=" col-10 col-md-8">
                                                            <div
                                                                class="d-flex  flex-wrap align-items-center justify-content-between">
                                                                <h4>Private Transfer</h4>
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn button" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_car">Change</button>
                                                                    <!-- <a href="#" class="btn btn-primary ms-2">Remove</a> -->
                                                                </div>
                                                            </div>
                                                            <span>HatchBack Car</span>
                                                            <p>Swift, Etios or Similar</p>
                                                            <p><span>Facilities:</span> 3 Seater |Non AC | 2 Luggage
                                                                Bags | First Aid</p>
                                                            
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            <div class="owl-carousel details_page">
                                                                @foreach($itinerary->sightseeingmodel->sight_images as $sight_images)
                                                                    <div class="item caro_image">
                                                                        <img src="{{env('ASSET_PATH') .($sight_images->path)}}" width="100%"
                                                                        alt="">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <div class="col-md-8 col-12 ">
                                                            <span class="badge m-2">Sightseeing</span>
                                                            <div
                                                                class="d-flex align-items-center flex-wrap justify-content-between">
                                                                <h4> {{$itinerary->sightseeingmodel->title}}</h4>
                                                                <!-- <div class="d-flex align-items-center">
                                                                    <button class="btn button" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_sightseeing{{$itinerary->sightseeingmodel->id}}">Change</button>
                                                                </div> -->

                                                               {{-- <!-- Modal Sightseeing -->
                                                                <div class="modal fade"
                                                                    id="modal_sightseeing{{$itinerary->sightseeingmodel->id}}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5"
                                                                                    id="staticBackdropLabel">Sightseeing
                                                                                </h1>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <form name="sightseeing_location_form"
                                                                                id="sightseeing_location_form"
                                                                                method="post"
                                                                                action="{{route('select_sightseeing')}}">
                                                                                @csrf
                                                                                @foreach($itinerary->sightseeing_place
                                                                                as $sight)
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-5 col-12">
                                                                                            <div
                                                                                                class="item caro_image">
                                                                                                <img src="{{'http://localhost/pristine-andaman-2023/public/'.($sight->path)}}"
                                                                                                    height="100%"
                                                                                                    alt=""></div>
                                                                                            
                                                                                </div>

                                                                                <div
                                                                                    class="col-md-7 col-12 mt-2 mt-md-0">
                                                                                    <div
                                                                                        class="d-flex align-items-center justify-content-between mb-2">
                                                                                        <span
                                                                                            class="badge ">Sightseeing</span>
                                                                                        <div
                                                                                            class="d-flex align-items-center">
                                                                                            <label class="btn button"
                                                                                                style="padding:3px">Select
                                                                                                Sightseeing</label>
                                                                                            <input type="checkbox"
                                                                                                class="m-2
                                    " name="select_places[]" value="{{$sight->id}}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <h4>{{$sight->title}}</h4>
                                                                                        <span>
                                                                                            {{$sight->subtitle}}</span>
                                                                                    </div>

                                                                                    <div class="d-flex m-2"
                                                                                        style="position:relative">
                                                                                        <div
                                                                                            class="d-flex flex-wrap align-items-center justify-content-between">
                                                                                            <div
                                                                                                class="d-flex align-items-center ">
                                                                                                <img src="{{URL::asset('/images/calendar-hotel-chekin.svg')}}"
                                                                                                    width="20px"
                                                                                                    height="20px"
                                                                                                    alt="">
                                                                                                <p class="m-0 ps-2">Tue
                                                                                                    21st Nov, 2023</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            style="position:absolute; right:5px">
                                                                                            <span
                                                                                                class="text-muted badge "
                                                                                                style="background:#a83a7a; color:#FFF !important;">Price:
                                                                                                {{$sight->price}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach

                                                                    <div class="modal-footer">
                                                                        <input type="submit" class="form-control button"
                                                                            name="sightseeing_place_submit">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <!-- <button type="button" class="btn btn-primary">Save</button> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                        <!--End Modal Sightseeing -->--}}



                                                    </div>
                                                    <span>{{$itinerary->sightseeingmodel->subtitle}}</span>
                                                    
                                                    <div class="">
                                                        <ul class="m-0">
                                                        @foreach($itinerary->sightseeing_place as $place)
                                                            @foreach ($place->sightseeing_location as $row)
                                                    <div id="">
                                                                <li style="background: linear-gradient(90deg, #954396, #DB2430); color:#FFF; padding: 2px 5px; border-radius: 10px;">{{$row->title}}</li>                                                               
                                                    </div>
                                                            
                                                            @endforeach
                                                            @endforeach
                                                    </ul>
                                                </div>

                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <p class="text-muted">Duration</p>
                                                        <?php $p=0;?>
                                                        @foreach($itinerary->sightseeing_place as $place)
                                                            @foreach ($place->sightseeing_location as $row)
                                                                <?php $p=$p+$row->duration ?>

                                                            @endforeach
                                                        @endforeach
                                                        <p class="fw-medium"> {{$p}} hour</p>
                                                    </div>
                                                    <div class="ms-3">
                                                        <p class="text-muted">Places Covered</p>
                                                        <p class="fw-medium text-center">
                                                            {{Count($itinerary->sightseeing_place)}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="sightseeing_id[{{$itinerary->itinerary_day}}][]" value="{{ $itinerary->sightseeingmodel->id}}">
                                    <!-- sightseeing price calculate -->
                                                                                            

                                    <input type="hidden" class="price" name="hatchback_price" id="sightseeing_price_{{ $itinerary->sightseeing_id }}" value="{{ $itinerary->sightseeing_price }}">
                                    <input type="hidden" id="package_id" value="{{ $itinerary->package_id }}">

                                    <!-- end sightseeing/car_fare calculate -->
                                    <div id="append_change_hotel_{{$itinerary->itinerary_day}}">       
                                        <div class="row" >
                                            <div class="col-md-4 col-12">
                                                <div class="owl-carousel details_page">
                                                    @foreach($itinerary->hotels->hotel_images as $hotel_image)
                                                        <div class="item caro_image"><img src="{{env('ASSET_PATH') .($hotel_image->path)}}" width="100%"
                                                        alt=""></div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-md-8 col-12 mt-2 mt-md-0">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <span class="badge">Hotel</span>
                                                    <div class="d-flex align-items-center">
                                                        <button class="btn button change_hotel" data-bs-toggle="modal"
                                                            data-bs-target="#modal_hotel" id="change_hotel" value="{{$itinerary->location_id}}" data-itinerary="{{ $itinerary->itinerary_day }}">
                                                            Change
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="hotel_id[{{$itinerary->itinerary_day}}][]"  value="{{$itinerary->hotels->id}}">
                                                </div>

                                                <div>
                                                    <h4>{{$itinerary->hotels->title}}</h4>
                                                   
                                                </div>
                                                <span class="text-muted">{{$itinerary->hotels->subtitle}}</span>
                                                <div class=" flex-wrap align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center mt-2 mb-1">
                                                        <img src="{{asset('/images/person.png')}}"
                                                            width="20px" height="20px" alt="">
                                                            <p class="ms-2"><strong>Max Person 2</strong></p>

                                                    </div>
                                                    {{-- <div class="pkgRating">
                                                        <img src="{{asset('/images/stars.svg')}}" width="16px"
                                                            height="16px" alt="">
                                                        <p><span>4.5</span>/5</p>
                                                    </div> --}}

                                                    <div>
                                                        <span class="text-muted badge mt-2"
                                                            style="background:#a83a7a; color:#FFF !important;">Base Price:
                                                            {{$itinerary->hotels->hotel_price->cp}}
                                                        </span>
                                                        <input type="hidden" name="hotel_price" class="price hotel-price" value=" {{$itinerary->hotels->hotel_price->cp}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-3 roomDetails">
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="text-decoration-underline mb-3">Choose Extra Facilities </h4>
                                                    <div class="d-flex align-items-center">
                                                        <a href="#"
                                                            class="btn btn-primary ms-md-2 ms-0 py-2 py-md-0">Hotel
                                                            Facilities</a>
                                                    </div>
                                                </div>
                                                <span>  </span>
                                                <div class="d-flex pb-2" style="justify-content: space-around">
                                                    <div>
                                                        <p class="ms-2"><span>Extra Person With Mattress :</span> <input type="checkbox" name="extra_person_with_mat[{{$itinerary->itinerary_day}}][]" id="extra_person_with_mat" class="price-ckeckbox hotel_facility" value="{{$itinerary->hotels->hotel_facility->extra_person_with_mattres}}"> </p>
                                                    </div>
                                                    <div>
                                                        <p class="ms-2"><span>Extra Person Without Mattress :</span> <input type="checkbox" name="extra_person_without_mat[{{$itinerary->itinerary_day}}][]" id="extra_person_without_mat" class="price-ckeckbox hotel_facility" value="{{$itinerary->hotels->hotel_facility->extra_person_without_mattres}}"> </p>
                                                    </div>
                                                   
                                                </div>                                                
                                                <div class="d-flex ms-2">
                                                    <div>
                                                        <p class="ms-2"><span>Meal(Lunch+Dinner) :</span> <input type="checkbox" name="meal[{{$itinerary->itinerary_day}}][]" id="meal" class="price-ckeckbox hotel_facility" value="{{$itinerary->hotels->hotel_facility->meal_price}}"> </p>
                                                    </div>
                                                    <div>
                                                        <p class="ms-5"><span>Flower Bed Decoration :</span> <input type="checkbox" name="flower_bed[{{$itinerary->itinerary_day}}][]" id="flower_bed" class="price-ckeckbox hotel_facility" value="{{$itinerary->hotels->hotel_facility->flower_bed_price}}"> </p>
                                                    </div>
                                                    <div>
                                                        <p class="ms-5"><span>Candle Light Dinner :</span> <input type="checkbox" name="candle_light[{{$itinerary->itinerary_day}}][]"  id="candle_light" class="price-ckeckbox hotel_facility" value="{{$itinerary->hotels->hotel_facility->candle_light_dinner_price}}"> </p>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="append_activity_here_{{$itinerary->itinerary_day}}" data-activity_id="{{ $itinerary->activity->id }}">
                                  
                                        <div class="itinerary-activity d-flex append_div"  data-activity_id="{{ $itinerary->activity->id }}">
                                            <div class="col-md-4 col-12 itinerary-activity-img">
                                                <div class="owl-carousel details_page">
                                                    @foreach($itinerary->activity->activity_images as $activity_image)
                                                        <div class="item caro_image"><img src="{{env('ASSET_PATH') .($activity_image->path)}}" width="100%"
                                                        alt=""></div>
                                                    @endforeach
                                                </div>
                                            </div>

                                      

                                            <div class="col-md-8 col-12 ms-2 mt-2 mt-md-0">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <span class="badge">Activity</span>
                                                    <div class="d-flex align-items-center">
                                                    <input type="hidden" name="activity_id[{{$itinerary->itinerary_day}}][]" value="{{ $itinerary->activity->id }}">
                                                        <button class="btn btn-danger" id="remove_activity" data-activity_price="{{$itinerary->activity->price}}" data-activity_id="{{$itinerary->activity->id}}"
                                                            value="{{$itinerary->activity->id}}">Remove</button>

                                                        <button class="btn button add_activity ms-2" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop" id="add_activity" data-itinerary_day="{{ $itinerary->itinerary_day }}"  value=" {{$itinerary->activity->id}}" data-activity_price="{{$itinerary->activity->price}}">Add Activity</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4>{{$itinerary->activity->title}}</h4>
                                                    <span> {{$itinerary->activity->subtitle}}</span>
                                                </div>
                                                 <span class="text-muted badge mt-2"
                                                    style="background:#a83a7a; color:#FFF !important">Price:
                                                    {{$itinerary->activity->price}}</span> 

                                                    <input type="hidden" class="price activity-price" value="{{$itinerary->activity->price}}">
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{asset('/images/person.png')}}"
                                                            width="20px" height="20px" alt="">
                                                        <p class="ms-2">Per Person</p>
                                                    </div>
                                                    {{-- <div class="pkgRating">
                                                        <img src="{{asset('/images/stars.svg')}}" width="16px"
                                                            height="16px" alt="">
                                                        <p><span>4.5</span>/5</p>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-end">
                            <!-- <button class="btn btn-secondary" type="submit" value="" id="book_now">Book Now</button> -->
                        </div>
                        
                    </div>
                    <div class="col-3 pe-0">
                        <div class="dayList" id="mobileBillSlider">
                            <div class="row d-block d-lg-none">
                                <div class="col-12 pb-2">
                                    <button id="mobileBill"
                                        class="btn  d-flex align-items-center justify-content-between w-100">
                                        <h4 class="mb-0 text-white">₹16,000 <span>per person*</span></h4>
                                        <i class="bi bi-chevron-up text-white fs-3"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row billingAndOffer w-100 m-auto">
                                <div class="col-12 roomDetails">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="d-flex align-items-center">
                                            <div href="#" class="badge">50% OFF</div>
                                        </div>
                                    </div>
                                    <span><strike>₹32,000</strike></span>
                                    <h4 class="mb-0">₹16,000 <span>per person*</span></h4>
                                    <span>*Excluding applicable taxes</span>
                                </div>
                                <div class="py-3 border-bottom">
                                    <div class="col-12 ">
                                        <h6 class="mb-0">Coupon & Offers</h6>
                                    </div>
                                    <div class="pt-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center ">
                                                <img src="{{asset('/images/ticket.png')}}" width="20px" alt="">
                                                <!-- <p class="fw-bold mb-0 ms-1"></p> -->
                                                <input type="text" name="" class="form-control ms-1"
                                                    placeholder="ANDAMAN" id="">
                                            </div>
                                            <a href="" class="text-decoration-none ms-2">Apply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6 class="mb-0">Package Total</h6>
                                </div>
                                <div class="py-4 border-bottom">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="text-dark">Price Per Person</span>
                                        <p class="fw-medium m-0 text-end"> <span  style="font-weight:600; font-size:18px">₹ </span> <input type="Text" id="total_price_input" name="total_price" value="{{  $activitySum}}" style="text-align: left; font-size: 17px; font-weight:600; width: 82px; border: none;"readonly></p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="text-dark">GST 18%</span>
                                        <?php $with_gst_total=$activitySum*18/100; ?>
                                        <p class="fw-medium m-0" style="font-size: 15px;"><span  style="font-weight:500; font-size:14px">₹ </span> <input type="number" id="gst_amount" name="gst_amount" value="{{$with_gst_total}}" style="text-align: left; font-size: 15px;  width: 82px; border: none;"readonly> </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between border-bottom py-2">
                                    <span class="text-dark fw-medium">Grand Total</span>
                                    <p class="fw-medium m-0"><span  style="font-weight:600; font-size:18px">₹ </span>  </span> <input type="number" id="total_amount" name="total_amount" value="{{$with_gst_total+$activitySum}}" style="text-align: left; font-size: 17px; font-weight:600; width: 82px; border: none;"readonly></p>
                                </div>
                                
                                <!-- <div class="text-center py-3">
                                <a href="{{url('new_booking')}}" class="btn button" id="book_now">Proceed to Book Online</a>
                                </div> -->

                                <div class="text-center py-3">
                                <a href="{{url('new_booking')}}" class="btn button" id="book_now" data-bs-toggle="modal" data-bs-target="#phoneVerificationModal" ">Proceed to Book Online</a>
                                </div>
                                <input type="hidden" value="" id="get_user_id">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane societyList fade  " id="nav-policies" role="tabpanel"
                aria-labelledby="nav-policies-tab">
                <div>
                    <h3 class="text-center">Cancellation Policy</h3>
                    <p class="text-decoration-underline"><strong>If You Cancel Your Holiday:</strong></p>
                    <p>You may cancel your travel arrangements at any time. Written notification or an e-mail to that
                        effect from the person who made the booking must be received at our office. The applicable
                        cancellation charges are as per the published cancellation policy below:</p>
                    <p class="text-decoration-underline"><strong>Cancellation charges per person:</strong></p>
                    <table border="1" class="table">
                        <tr>
                            <th>Tenure (If canceled from)</th>
                            <th>Amount to be charged</th>
                        </tr>
                        <tr>
                            <td>0 days to 15 days before the arrival</td>
                            <td>100% of the booking amount</td>
                        </tr>
                        <tr>
                            <td>15 days to 30 days before the arrival date</td>
                            <td>50% of the booking amount</td>
                        </tr>
                        <tr>
                            <td>30 days or more before the arrival date</td>
                            <td>25% of the booking amount</td>
                        </tr>
                    </table>
                    <p class="m-0 pt-2"><strong>Important:</strong></p>
                    <ul>
                        <li>No refund for cancellation received on bookings from 15th Dec to 15th Jan.</li>
                        <li>No refunds for unused nights or early departure.</li>
                        <li>The above may vary based on any specific cancellation charges as charged by the third party
                            service provider.</li>
                    </ul>
                    <p class="text-decoration-underline"><strong>COVID Cancellation Policy:</strong></p>
                    <ul>
                        <li>
                            Please note that in the unfortunate scenario if the guest who has a confirmed booking
                            and is unable to travel due to COVID related exigencies, please be rest assured the
                            amount is safe and will not be forfeited. The amount paid will be adjusted for the future
                            travel for the same guest only. Request you to kindly intimate the same to us at least 03
                            days prior to the date of check-in to prevent a No-Show. The booking can be
                            rescheduled within 6 months from the date of cancellation. Please note that changes to
                            existing reservations will be subjected to availability and to any rate differences.
                            Request you to kindly check with us the availability before booking the flight tickets.
                        </li>
                        <li>
                            Complete Lockdown in your city (Weekend lockdown / night curfew will not be
                            considered).
                        </li>
                        <li>
                            Couple Trip - In case any one of the traveling member is found to be Covid Positive.
                            Subjected to mandatory submission of valid RTPCR Test Report from approved ICMR
                            Testing Lab only
                        </li>
                        <li>
                            Family Trip (Max 04 Members) - In case when two or more traveling members is found
                            to be Covid Positive. Subjected to mandatory submission of valid RTPCR Test Report
                            from approved ICMR Testing Lab only.
                        </li>
                        <li>
                            Convenience fees will be applicable on cruise tickets.
                        </li>
                        <p>
                            Important: Above Covid related cancellation policy is only applicable on our selected
                            hotels / resorts.
                        </P>
                    </ul>

                    <h5 class="text-center text-decoration-underline">Terms & Conditions:</h5>
                    <ul>
                        <li>Hotels once confirmed cannot be changed. Guests are requested to check the reviews, pictures
                            and hotel websites before confirming the hotel and advise any change at the time of booking
                            confirmation.</li>
                        <li>The Check-in and check-out time of the hotel is 12:00 PM at Port Blair and 08:00 AM at
                            Swaraj Dweep (Havelock Island); stay beyond the check-out time is purely at the discretion
                            of the hotels. In Swaraj Dweep (Havelock Island), there may be a time gap between check out
                            and ferry timings, guests are advised to leave their luggage in the hotel and venture out
                            for some optional activity till the ferry timing). For early check in and late check out the
                            payment is to be settled directly by the guest.</li>
                        <li>Numbers of meals are always corresponding to the number of nights booked. Breakfast is not
                            provided on the day of arrival.</li>
                        <li>Cost of additional services availed by the guest which are not part of our package
                            inclusions are to be settled directly at the hotel.</li>
                        <li>Suggested hotels are subject to availability at the time of booking. In case the same is not
                            available, then a similar category hotel will be provided. Hotel once finalized cannot be
                            changed.</li>
                        <li>Operator reserves the right to re-arrange itinerary to suit hotel availability without
                            changing the total number of nights in each destination and without compromising any
                            services</li>
                        <li>Ferry timings are subject to change at the government's discretion, and we assume no
                            liability for disruption in the tour owing to climatic conditions or any such events beyond
                            our control. Rest assured, we will do our best to implement your itinerary to the fullest
                            and provide you with commensurate back-up options. The cost of the same will need to be
                            borne by the guest.</li>
                        <li>The tour guide reserves the rights to make changes / detour or omit any place of visit, if
                            it becomes necessary due to bad weather, road blockage or security reason.</li>
                        <li>The vehicle used (A/C or Non-A/C) is available for point to point services only and is not
                            at disposal. Guests are requested to follow the timings in the program. Dinner / Shopping
                            trips will be charged ₹ 350 extra (depending on distance).</li>
                        <li>It is mandatory to carry the age proof of children and infant (below 02yrs) along with other
                            travel documents. Child without address proof shall be considered for an adult cost.</li>
                        <li>The boats to Elephant Beach are managed by a boat association who need individual guest to
                            fill a consent form after which boats are allotted based on rotation and sharing basis.</li>
                        <li>Due to limited boats guest may have to wait until their boat is allotted and we have no
                            control over the wait time.</li>
                        <li>Ferry services & timings are subjected to weather condition. Ferry Operation is purely
                            subjected to Govt. clearance.</li>
                        <li>Entry to Cellular jail and Museum closes by 04:00 PM and light and sound show is open every
                            day 05:30 PM. Light and sound is subjected to weather conditions and tickets issued are
                            nonrefundable by Andaman & Nicobar administration.</li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane societyList fade  " id="nav-summery" role="tabpanel" aria-labelledby="nav-summery-tab">
                Summary content will be there
            </div>
        </div>
        </div>

        </div>
        </div>
    </section>


    <!-- Modal Cars -->
    <div class="modal fade" id="modal_car" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cars</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                </div>
                @foreach($cars as $car)
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <div class="owl-carousel details_page">
                                <div class="item caro_image"><img
                                        src="{{env('ASSET_PATH') .($car->car_image)}}"
                                        height="100%" alt=""></div>
                            </div>
                        </div>

                        <div class="col-md-7 col-12 mt-2 mt-md-0">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge ">car</span>
                                <div class="d-flex align-items-center">
                                    <button class="btn button" style="padding:5px; width:180px;" id="select_car" value="{{$car->id}}">Select Car</button>
                                </div>
                            </div>
                            <div>
                                <h4>{{$car->title}}</h4>
                                <span> {{$car->subtitle}}</span>
                            </div>

                            <div class="d-flex">
                                <div>
                                    <span class="badge economy" style="margin-right:15px"> {{$car->seater}} Seater
                                    </span>
                                </div>
                                <div>
                                    @if($car->ac==0)
                                    <span class=" badge economy"> Non AC</span>
                                    @else ($car->ac==1)
                                    <span class=" badge economy"> AC </span>
                                    @endif

                                </div>
                            </div>

                            <div class="d-flex m-2" style="position:relative">
                                <div style="position:absolute; right:5px">
                                    <span class="text-muted badge "
                                        style="background:#a83a7a; color:#FFF !important;">Price Per Hour:
                                        {{$car->price_per_hour}}</span>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="d-flex align-items-center ">
                                    <img src="{{asset('/images/calendar-hotel-chekin.svg')}}" width="20px"
                                        height="20px" alt="">
                                    <p class="m-0 ps-2">Luggage/Bags/First Aid</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save</button> -->
                </div>
            </div>
        </div>
    </div> 
    <!--End Modal Cars -->


    <!-- Modal Hotels -->
    <div class="modal fade" id="modal_hotel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hotels</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="append_hotel">
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save</button> -->
                </div>
            </div>
        </div>
    </div>
    <!--End Modal hotels -->

 <!-- Modal Activity -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Activity</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              
                <div class="modal-body" id="append_activity">
                   
                </div>
             
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save</button> -->
                </div>
            </div>
        </div>
    </div>
    <!--End Modal Activity -->

              
    <!-- Phone Login Modal -->

    <!-- The Modal -->
    <div class="modal fade" id="phoneVerificationModal" tabindex="-1" aria-labelledby="phoneVerificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(90deg, #954396, #DB2430);">
                    <h5 class="modal-title" id="phoneVerificationModalLabel" >Register to Procced</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Mobile Number Input -->
                    <div class="mb-3">
                        <label for="mobileNumber" class="form-label">Mobile Number</label>

                        <input type="text" class="form-control" id="mobileNumber" placeholder="Enter mobile number" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>
                        <div class="invalid-feedback">
                            Please enter a valid 10-digit mobile number.
                        </div>
                    </div>
                    <!-- OTP Input -->
                    <div class="mb-3" id="otpInput" style="display: none;">
                        <label for="otp" class="form-label">OTP</label>
                        <input type="text" class="form-control" id="otp" placeholder="Enter OTP">
                    </div>

                    <div class="mb-3" id="not_matched" style="display: none;">
                        <label  class="form-label" style="color:#FF0000">OTP does not matched</label>
                    </div>
                      
                    <div class="mb-3" id="otp_matched" style="display: none;">
                        <label for="otp" class="form-label" style=" color: #008000; border: 1px solid #008000; padding: 4px;
    border-radius: 3px">OTP Matched</label>
                    </div>
                    <button type="button" class="btn btn-primary" id="sendOTPButton">Send OTP</button>
                    <button type="button" class="btn btn-primary" id="verifyOTPButton" style="display: none;">Verify OTP</button>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Save</button> -->
                    <div class="btn " id="procced_button" style="display: none;">
                        <button type="button" id="procced_button" style="background: linear-gradient(90deg, #954396, #DB2430);    padding: 5px 25px; border-radius: 5px;">Procced</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
@push('scripts')
<!-- <script src="{{ asset('assets/js/index_page.js') }}"></script> -->
<script>
 // Custom JavaScript for OTP Sending and Verification

        var user_id='';        
        var otp='';        
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('sendOTPButton').addEventListener('click', function () {
                var mobileNumber = document.getElementById('mobileNumber').value;
                // Simulate sending OTP
                // You should replace this with your actual OTP sending logic
                // For demonstration purposes, we're just logging the mobile number and a generated OTP

                    var car_id = $(this).val();
                    
                    if (!/^\d{10}$/.test(mobileNumber)) {
                    alert('Please enter a valid 10-digit mobile number.');
                    return;
                    }

                    $.ajax({
                        url: "{{ route('user_register') }}",
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            mobile_no: mobileNumber,
                        },
                        cache: false,
                        success: function(data) {
                            if (data) { 
                                user_id = data.user_id; 
                                otp = data.otp; 
                                $('#get_user_id').val(user_id);
                                
                            } else {
                                alert('User ID not found in the response');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX request failed:", status, error);
                        }
                    });
            
                
                // Show OTP input field
                document.getElementById('otpInput').style.display = 'block';
                // Hide Send OTP button
                document.getElementById('sendOTPButton').style.display = 'none';
                // Show Verify OTP button
                document.getElementById('verifyOTPButton').style.display = 'block';
            });

            document.getElementById('verifyOTPButton').addEventListener('click', function () {
                var mobile_no = document.getElementById('mobileNumber').value;
                var enteredOTP = document.getElementById('otp').value;
          
                $.ajax({
                        url: "{{ route('verify_otp') }}",
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            mobile_no: mobile_no,
                            enteredOTP: enteredOTP,
                        },
                        cache: false,
                        success: function(data) {
                            if (data.success) {
                                console.log('OTP verified successfully.');
                                    document.getElementById('otpInput').style.display = 'none';
                                    document.getElementById('verifyOTPButton').style.display = 'none';
                                    document.getElementById('not_matched').style.display = 'none';
                                    document.getElementById('otp_matched').style.display = 'block';
                                    document.getElementById('procced_button').style.display = 'block';
                                
                            } else {
                                // Handle errors returned from the server
                                console.log('Error:', data.error);
                                document.getElementById('not_matched').style.display = 'block';
                                
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX request failed:", status, error);
                        }
                    });
            });
        });

     //phone login modal 



$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
});


//change hotels dropdown
$(document).ready(function() {
    $(document).on('click', ".change_hotel", function(e) {
        var get_location_id = $(this).val();
        var itenaryDay = $(this).data('itinerary');
        console.log(itenaryDay);

        $.ajax({
            url: "{{ route('location_wise_hotel_dropdown')}}",
            type: 'GET',
            dataType: 'json',
            data: {
                get_location_id: get_location_id,
                itenaryDay: itenaryDay
            },
            cache: false,
            success: function(data) {
                console.log(data);
                if (data.html && $(data.html).length > 0) {
                    $('#append_hotel').html($(data.html));
                        $('.owl-carousel').owlCarousel({
                            loop: true,
                            margin: 10,
                            nav: true,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 1
                                },
                                1000: {
                                    items: 1
                                }
                            }
                        });

                } else {
                    console.error("No HTML data returned or invalid HTML structure.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    });
});

//select hotel append
$(document).ready(function() {
    $(document).on('click', ".select_hotel", function(e) {
        var select_hotel = $(this).val();
        var itineraryday = $(this).data('itineraryday');
        var get_location_id = $(this).data('location');
        $.ajax({
            url: "{{ route('change_hotel') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                hotel_id: select_hotel,
                get_location_id: get_location_id,
                itineraryday: itineraryday
            },
            cache: false,
            success: function(data) {
                console.log(data);
                if (data.html && $(data.html).length > 0) {
                    $('#append_change_hotel_' + itineraryday).empty();
                    $('#append_change_hotel_' + itineraryday).append($(data.html));
                    $('#modal_hotel').modal('hide');
                    calculation();
                    $('.owl-carousel').owlCarousel({
                            loop: true,
                            margin: 10,
                            nav: true,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 1
                                },
                                1000: {
                                    items: 1
                                }
                            }
                        });
                } else {
                    console.error("No HTML data returned or invalid HTML structure.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    });
});

//activity add/remove
$(document).ready(function() {
    $(document).on('click', ".select_activity", function(e) {
        var actv_id = $(this).val();
        var itinerary_day = $(this).data('itinerary_day');
        var location_id = $(this).data('location_id');
       
        $.ajax({
            url: "{{ route('change_activity') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                actv_id: actv_id,
                itinerary_day:itinerary_day,
                get_location_id:location_id
            },
            cache: false,
            success: function(data) {
                console.log(data);
                if (data.html && $(data.html).length > 0) {
                    $('#append_activity_here_' + itinerary_day).append($(data.html));
                    $('#staticBackdrop').modal('hide');
                    calculation();
                } else {
                    console.error("No HTML data returned or invalid HTML structure.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    });
    $(document).on('click', "#remove_activity", function(e) {
        var activity_disable_id = $(this).data('activity_id');
        e.preventDefault();
        // $(this).parent('div').parent('div').parent('div').prev('div').remove(); 
        //$(this).closest('div').parent().parent().prev('div').remove();
        //alert(activity_disable_id);
        //$('.act_disable' + activity_disable_id).prop('disabled', false);
        $(this).closest('.itinerary-activity').remove(); // Remove the closest parent row of the clicked button
    });
});


//change activity dropdown
$(document).ready(function() {
    $(document).on('click', ".add_activity", function(e) {
        var get_location_id = $(this).val();
        var itinerary_day = $(this).data('itinerary_day');
        // var active_activity_id = $('.append_div').data('activity_id');
        var activity_ids = [];
        $(".accordion-item").find('.append_div').each(function (index) {
            activity_ids[index] = $(this).data('activity_id');

        });

        $.ajax({
            url: "{{route('location_wise_activity_dropdown')}}",
            type: 'GET',
            dataType: 'json',
            data: {
                get_location_id: get_location_id,
                itinerary_day:itinerary_day,
                active_activity_id:activity_ids
            },
            cache: false,
            success: function(data) {
                console.log(data);
                if (data.html && $(data.html).length > 0) {
                    $('#append_activity').html($(data.html));
                        $('.owl-carousel').owlCarousel({
                            loop: true,
                            margin: 10,
                            nav: true,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 1
                                },
                                1000: {
                                    items: 1
                                }
                            }
                        });

                } else {
                    console.error("No HTML data returned or invalid HTML structure.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    });
});



$(document).ready(function () {
    
    $(document).on('click', ".hotel_facility", function() {
        calculation();
    });
    
    calculation();
});


$(document).ready(function() {
     $(document).on('click', "#remove_activity", function() {
        calculation();
 });
 });

function calculation()
{
    var sum = 0;
    $('.price').each(function(){
        sum = parseInt(sum) + parseInt(this.value);
    });

    $('.price-ckeckbox').each(function(){
        if ($(this).is(":checked")) {
            console.log('Is checked');
            sum = parseInt(sum) + parseInt(this.value);
        }
    });
    gst_amount= sum*18/100;
    grand_total= sum+gst_amount;

    $("#total_price_input").val(sum);
    $("#gst_amount").val(gst_amount);
    $("#total_amount").val(grand_total);
}


//car append html
$(document).ready(function() {
    $(document).on('click', "#select_car", function(e) {
        var car_id = $(this).val();

        $.ajax({
            url: "{{ route('change_car') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                car_id: car_id,
                package_id: $("#package_id").val()
            },
            cache: false,
            success: function(data) {
                if (data.html && $(data.html).length > 0) {
                    $('#append_car_here').empty();
                    $('#append_car_here').append($(data.html));
                    $('#modal_car').modal('hide');

                    var price = data.sightessing_price;
                    jQuery.each(price, function(sightseeing_id, sightseeing_price) {
                        $("#sightseeing_price_" + sightseeing_id).val(sightseeing_price.price);
                    });

                    calculation();

                    $('.owl-carousel').owlCarousel({
                            loop: true,
                            margin: 10,
                            nav: true,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 1
                                },
                                1000: {
                                    items: 1
                                }
                            }
                        });
                        
                } else {
                    console.error("No HTML data returned or invalid HTML structure.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    });
});


$(document).on('click', "#procced_button", function(e) {
    var car_id = $('#select_car').val(); 
    var package_id = $('#package_id').val(); 

    var hotel_ids = {};
    var sightseeing_ids = {};
    var activity_ids = {};

    e.preventDefault();

    $('input[name^="hotel_id["]').each(function() {
        var name = $(this).attr("name");
        var value = $(this).val();
        var indices = name.match(/\d+/g).map(Number);

        if (!indices || indices.length === 0) {
            console.error("Invalid input name:", name);
            return;
        }
        var obj = hotel_ids;
        for (var i = 0; i < indices.length - 1; i++) {
            obj[indices[i]] = obj[indices[i]] || {};
            obj = obj[indices[i]];
        }
        obj[indices[indices.length - 1]] = value;
    });


        $('input[name^="sightseeing_id["]').each(function() {
        var name = $(this).attr("name");
        var value = $(this).val();
        var indices = name.match(/\d+/g).map(Number);

        if (!indices || indices.length === 0) {
            console.error("Invalid input name:", name);
            return;
        }

        var obj = sightseeing_ids;
        for (var i = 0; i < indices.length - 1; i++) {
            obj[indices[i]] = obj[indices[i]] || {};
            obj = obj[indices[i]];
        }
        obj[indices[indices.length - 1]] = value;
    });


    var activity_ids = {};

    $('input[name^="activity_id["]').each(function() {

        var name = $(this).attr("name");
        var value = $(this).val();
        var day = name.match(/\d+/);  // Extract the day index from the name

        if (!day) {
            console.error("Invalid input name:", name);
            return;
        }

        day = day[0];  

        if (!activity_ids[day]) {
            activity_ids[day] = [];
        }

        activity_ids[day].push(value);
    });

    console.log(activity_ids);


    var itinerary_days = [];
    $('input[name="itinerary_days[]"]').each(function() {
        itinerary_days.push($(this).val());
    }); 
  
    var mealSelection = {};
    $('input[name^="meal["]').each(function() {
        var name = $(this).attr("name");
        var value = $(this).val();
        var isChecked = $(this).is(":checked");
        var day = name.match(/\d+/)[0]; 
        if (!mealSelection[day]) {
            mealSelection[day] = [];
        }
        if (isChecked) {
            mealSelection[day].push(value);
        }
    });

    var flowerBedSelection = {};
    $('input[name^="flower_bed["]').each(function() {
        var name = $(this).attr("name");
        var value = $(this).val();
        var isChecked = $(this).is(":checked");
        var day = name.match(/\d+/)[0]; 
        if (!flowerBedSelection[day]) {
            flowerBedSelection[day] = [];
        }
        if (isChecked) {
            flowerBedSelection[day].push(value);
        }
    });

    var candleLightSelection = {};
    $('input[name^="candle_light["]').each(function() {
        var name = $(this).attr("name");
        var value = $(this).val();
        var isChecked = $(this).is(":checked");
        var day = name.match(/\d+/)[0]; 
        if (!candleLightSelection[day]) {
            candleLightSelection[day] = [];
        }
        if (isChecked) {
            candleLightSelection[day].push(value);
        }
    });
    var extra_person_with_mat = {};
    $('input[name^="extra_person_with_mat["]').each(function() {
        var name = $(this).attr("name");
        var value = $(this).val();
        var isChecked = $(this).is(":checked");
        var day = name.match(/\d+/)[0]; 
        if (!extra_person_with_mat[day]) {
            extra_person_with_mat[day] = [];
        }
        if (isChecked) {
            extra_person_with_mat[day].push(value);
        }
    });
    var extra_person_without_mat = {};
    $('input[name^="extra_person_without_mat["]').each(function() {
        var name = $(this).attr("name");
        var value = $(this).val();
        var isChecked = $(this).is(":checked");
        var day = name.match(/\d+/)[0]; 
        if (!extra_person_without_mat[day]) {
            extra_person_without_mat[day] = [];
        }
        if (isChecked) {
            extra_person_without_mat[day].push(value);
        }
    });

    $.ajax({
        url: "{{ route('create_custom_package') }}",
        type: 'GET',
        dataType: 'json',
        data: {
            car_id: car_id, 
            package_id: package_id,
            sightseeing_ids:sightseeing_ids,
            hotel_ids:hotel_ids,
            itinerary_days:itinerary_days,
            meal:mealSelection ,
            flower_bed:flowerBedSelection,
            candle_light:candleLightSelection,
            extra_person_with_mat:extra_person_with_mat,
            extra_person_without_mat:extra_person_without_mat,
            activity_ids:activity_ids,
        },
        cache: false, 
        success: function(data) {
            console.log(data);
            if (data.success) {
                var custom_package_id = data.custom_package_id;
                 var href = $('#book_now').attr('href');
                 href = href + '?custom_package_id=' + custom_package_id;
                // // $('#book_now').attr('href', href);
                // // console.log( href);
                // // alert( href);
                 window.location.href = href;

            } 
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
});

</script>
@endpush