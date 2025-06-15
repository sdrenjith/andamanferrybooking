@if(!empty($hotels))

            @foreach($hotels as $hotel)
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <div class="owl-carousel details_page">
                                @foreach ($hotel->hotel_images as $hotel_image)
                                <div class="item caro_image"><img
                                        src="{{env('ASSET_PATH') .($hotel_image->path)}}"
                                        height="100%" alt=""></div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-7 col-12 mt-2 mt-md-0">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge ">Hotels</span>
                                <div class="d-flex align-items-center">
                                    <button class="btn button select_hotel" style="padding:3px" id="select_hotel" data-itineraryday="{{$itenaryDay}}" data-location="{{$location_id}}" value="{{$hotel->id}}">Select Hotel</button>
                                </div>
                               
                            </div>
                            <div>
                                <h4 style="font-size:20px">{{$hotel->title}}</h4>
                                <span style="font-size:16px"> {{$hotel->subtitle}}</span>
                            </div>

                            <div class=" " style="position:relative">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="d-flex align-items-center mt-2 mb-1">
                                        <img src="{{asset('/images/person.png')}}"
                                            width="20px" height="20px" alt="">
                                            <p class="ms-2 pt-2"><strong>Max Person 2</strong></p>
                                    </div>
                                </div>
                                <div style="position:absolute; right:5px ">
                                    <span class="text-muted badge "
                                        style="background:#a83a7a; color:#FFF !important;">Base Price:
                                        {{$hotel->hotel_price->cp}}
                                    </span>
                                    <input type="hidden" name="hotel_price" id="hotel_price" value=" {{$hotel->hotel_price->cp}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
@endif


