@if(!empty($hotels))

<div>
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="owl-carousel details_page">
                @foreach($hotels->hotel_images as $hotel_image)
                        <div class="item caro_image"><img src="{{ env('ASSET_PATH') . $hotel_image->path }}" width="100%"
                        alt=""></div>
                @endforeach
            </div>
        </div>

        <div class="col-md-8 col-12 mt-2 mt-md-0">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="badge">Hotel</span>
                <div class="d-flex align-items-center">
                    <button class="btn button change_hotel" data-bs-toggle="modal" data-bs-target="#modal_hotel" id="change_hotel"
                        value="{{ $location_id }}" data-itinerary="{{ $itineraryday }}">Change</button>
                </div>
                <input type="hidden" name="hotel_id[{{$itineraryday}}][]"  value="{{$hotels->id}}">
            </div>
            <div>
                <h4>{{$hotels->title}}</h4>
                <span class="text-muted">{{$hotels->subtitle}}</span>
            </div>
           
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center mt-2 mb-1">
                    <img src="{{asset('/images/person.png')}}"
                        width="20px" height="20px" alt="">
                        <p class="ms-2"><strong>Max Person 2</strong></p>
                </div>
            
                {{-- <div class="pkgRating">
                    <img src="{{asset('/images/stars.svg')}}" width="16px" height="16px" alt="">
                    <p><span>4.5</span>/5</p>
                </div> --}}

                <div>
                    <span class="text-muted badge "
                        style="background:#a83a7a; color:#FFF !important;">Base Price:
                        {{$hotels->hotel_price->cp}}
                    </span>
                    <input type="hidden" class="price hotel-price" name="hote_price" id="" value=" {{$hotels->hotel_price->cp}}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-3 roomDetails">
            <div
                class="d-flex flex-wrap align-items-center justify-content-between">
                <h4 class="text-decoration-underline mb-3">Choose Extra Facilities</h4>
                <div class="d-flex align-items-center">
                    <a href="#"
                        class="btn btn-primary ms-md-2 ms-0 py-2 py-md-0">Hotel
                        Facilities</a>
                </div>
            </div>
            <span>  </span>
            <div class="d-flex pb-2" style="justify-content: space-around">
                <div>
                    <p class="ms-2"><span>Extra Person With Mattress :</span> <input type="checkbox" name="extra_person_with_mat[{{$itineraryday}}][]" id="extra_person_with_mat" class="price-ckeckbox hotel_facility" value="{{$hotels->hotel_facility->extra_person_with_mattres}}"> </p>
                </div>
                <div>
                    <p class="ms-2"><span>Extra Person Without Mattress :</span> <input type="checkbox" name="extra_person_without_mat[{{$itineraryday}}][]" id="extra_person_without_mat" class="price-ckeckbox hotel_facility" value="{{$hotels->hotel_facility->extra_person_without_mattres}}"> </p>
                </div>
                
            </div>                                                
            <div class="d-flex ms-2">
                <div>
                    <p class="ms-2"><span>Meal(Lunch+Dinner) :</span> <input type="checkbox" name="meal[{{$itineraryday}}][]" id="meal" class="price-ckeckbox hotel_facility" value="{{$hotels->hotel_facility->meal_price}}"> </p>
                </div>
                <div>
                    <p class="ms-5"><span>Flower Bed Decoration :</span> <input type="checkbox" name="flower_bed[{{$itineraryday}}][]" id="flower_bed" class="price-ckeckbox hotel_facility" value="{{$hotels->hotel_facility->flower_bed_price}}"> </p>
                </div>
                <div>
                    <p class="ms-5"><span>Candle Light Dinner :</span> <input type="checkbox" name="candle_light[{{$itineraryday}}][]"  id="candle_light" class="price-ckeckbox hotel_facility" value="{{$hotels->hotel_facility->candle_light_dinner_price}}"> </p>
                </div>
            </div>                                                
        </div>
    </div>
</div>
@endif