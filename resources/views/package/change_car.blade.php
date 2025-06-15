                    <div class="row">
                        <div class="col-md-5 col-12">
                            <div class="owl-carousel details_page">
                                <div class="item caro_image">
                                    <img src="{{env('ASSET_PATH') .($car->car_image)}}"
                                        height="100%" alt=""></div>
                                        
                            </div>
                        </div>

                        <div class="col-md-7 col-12 mt-2 mt-md-0">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge ">car</span>
                                <div class="d-flex align-items-center">
                                    <button class="btn button" data-bs-toggle="modal"
                                        data-bs-target="#modal_car">Change</button>
                                    <!-- <a href="#" class="btn btn-primary ms-2">Remove</a> -->
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