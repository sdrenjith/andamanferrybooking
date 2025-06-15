@extends('layouts.app')

@section('content')
<main>
    <section class="my-5">

        <div class="row package">
            <div class="col-12 px-0">
                <div class="pageHead mt-0 r mb-3 innerPageBanner">
                    <div class="d-flex align-items-center justify-content-center justify-content-start">
                        <p class="mb-0 me-1">PACKAGES</p>

                    </div>
                    <h1 class="mb-0 text-center  mt-0">Best Selling
                        andaman</h1>
                    <p class="text-center ">Book best sellers with flexible
                        Cancellation Policy</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <form  id="filter_form" name="package_filter_form[]" method="GET" action="{{route('package')}}">
                        @csrf
                        <div class="row mb-5" style="border: 1px solid #ccc; padding: 20px; border-radius: 10px; background-color: #eee;">
                            <div class="col-3">
                                <div class="sd-multiSelect form-group">
                                    <label for="current-job-role" style="font-weight: 700"> Select Package Type</label>
                                    <select multiple id="current-job-role" class=" sd-CustomSelect" name="style_type[]" id="style_type">
                                        @foreach($package_style as $p_style)
                                        <?php  $isChecked = isset($_GET['style_type']) && in_array($p_style->id, $_GET['style_type']); ?>
                                            <option value="{{ $p_style->id }}" {{ ($p_style->id == $isChecked) ? 'selected' : '' }}>
                                                {{ $p_style->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="current-job-role" style="font-weight: 700"> Travelling Date</label>
                                <input type="text" class="form-control my_date_picker"  id="my_date_picker"  name="travel_date" placeholder="Select Date">
                            </div>

                            <div class="col-3">
                                <label for="current-job-role" style="font-weight: 700"> Days</label>
                                    <input type="number" class="form-control" id="no_of_days" name="no_of_days" placeholder="No. of Days" max="99">
                            </div>

                            <div class="col-3 text-end">
                                <button type="submit" class="btn button" style="margin-top: 20px; width:80%;">Filter</button>
                            </div>


                        </div>

                        </form>
                    </div>
                </div>
                <div class="col-12  p-0">
                    <div class="packageCardContainer pkgListPage">
                        <div class="packageCardSlider packageList desktop row">
                            @if(!empty($data['package']->data))
                            @foreach($data['package']->data as $key => $val)
                            @php
                            $get_minimum_package_price = array();
                            @endphp

                            <div class="packageCard col-xl-3 col-md-4 col-12 mb-4">
                                <a href="{{ url('package/'.$val->id) }}" class="text-decoration-none card">
                                    <div class="card-body">
                                        <div class="cardImg overflow-hidden">
                                            <img src="{{ !empty($val->packageimage[0]->path) ? config('app.img_base') . $val->packageimage[0]->path : config('app.img_base') . 'noimage.jpg' }}" alt="">
                                            <div class="badge text-uppercase">BEST SELLER</div>
                                        </div>
                                        <div class="cardInfo">
                                            <p class="location">Diglipur, Andaman</p>
                                            <div class="packageName">
                                                <h3>{{ $val->title }}</h3>
                                                <p>{{ $val->day }} Day <span></span> {{ $val->night }} Night </p>
                                            </div>
                                            <div class="packageTags ">
                                            @foreach($val->packagestyle as $p_style)
                                            <div class="badge economy">{{$p_style->style_details->title}}</div>
                                                 
                                            @endforeach

                                            </div>
                                            <div class="ratingReview d-flex align-items-center mt-3">
                                                <p class="rating">4.8</p>
                                                <p class="review">Exceptional <span>3,014 reviews</span></p>
                                            </div>
                                            <div class="price">
                                                <i class="bi bi-currency-rupee"></i>
                                                <p> @php
                                                    $get_minimum_package_price =
                                                    DB::table('type_prices')->where('package_id', $val->id
                                                    )->orderBy('actual_price')->limit(1)->get()->toArray();
                                                    @endphp
                                                <p>{!! !empty($get_minimum_package_price[0]->actual_price) ?
                                                    $get_minimum_package_price[0]->actual_price : '' !!}
                                                    <span>per night</span>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="text-end bookBtn card-footer">
                                        <button class="btn button">Book Now</button>

                                    </div>
                                </a>
                            </div>

                            @endforeach
                            @endif
                        </div>
                        
                        <div class="packageCardSlider packageList mobile  owl-carousel owl-theme row" id="">
                        @if(!empty($data['package']->data))
                            @foreach($data['package']->data as $key => $val)
                            @php
                            $get_minimum_package_price = array();
                            @endphp
                            <div class="packageCard col-xl-3 col-md-4 col-12 mb-4">
                                <a href="{{ url('package/'.$val->id) }}" class="text-decoration-none card">
                                    <div class="card-body">
                                        <div class="cardImg overflow-hidden">
                                            <img src="{{ !empty($val->packageimage[0]->path) ? config('app.img_base') . $val->packageimage[0]->path : config('app.img_base') . 'noimage.jpg' }}" alt="">
                                            <div class="badge text-uppercase">BEST SELLER</div>
                                        </div>
                                        <div class="cardInfo">
                                            <p class="location">Diglipur, Andaman</p>
                                            <div class="packageName">
                                                <h3>{{ $val->title }}</h3>
                                                <p>{{ $val->day }} Day <span></span> {{ $val->night }} Night </p>
                                            </div>
                                            <div class="packageTags">

                                            

                                            </div>
                                            <div class="ratingReview d-flex align-items-center mt-3">
                                                <p class="rating">4.8</p>
                                                <p class="review">Exceptional <span>3,014 reviews</span></p>
                                            </div>
                                            <div class="price">
                                                <i class="bi bi-currency-rupee"></i>
                                                <p> @php
                                                    $get_minimum_package_price =
                                                    DB::table('type_prices')->where('package_id', $val->id
                                                    )->orderBy('actual_price')->limit(1)->get()->toArray();
                                                    @endphp
                                                <p>{!! !empty($get_minimum_package_price[0]->actual_price) ?
                                                    $get_minimum_package_price[0]->actual_price : '' !!}
                                                    <span>per night</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end bookBtn card-footer">
                                        <button class="btn button">Book Now</button>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            @endif
                         </div>
                           
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.packageList.mobile').owlCarousel({

                loop: true,
                margin: 30,
                responsiveClass: true,
                responsive: {
                    1000: {
                        items: 3,
                        nav: true,

                    },
                    600: {
                        items: 2,
                        nav: true
                    },
                    0: {
                        items: 1,
                        nav: true
                    },

                }
            })

        })
    </script>