@if (!empty($package->data))
@foreach ($package->data as $key => $val)

<a href="{{ url('package/'.$val->id) }}" class="text-decoration-none card">
<div class="packageCardContainer">
    <div class="packageCardSlider owl-carousel owl-theme" id="home_package">
        <div class="packageCard item">
            <div class="cardImg overflow-hidden">
                <img src="{{ !empty($val->packageimage[0]->path) ? config('app.img_base') . $val->packageimage[0]->path : config('app.img_base') . 'noimage.jpg' }}"
                    alt="">
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
                    <p>
                        @php
                        $get_minimum_package_price =
                        DB::table('type_prices')->where('package_id', $val->id
                        )->orderBy('actual_price')->limit(1)->get()->toArray();
                        @endphp
                        {!! !empty($get_minimum_package_price[0]->actual_price) ?
                        $get_minimum_package_price[0]->actual_price : '' !!}
                        <span>per night</span>
                    </p>
                </div>
                <div class="text-end bookBtn">
                    <button class="btn button">Book Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
</a>

@endforeach
@endif

<script>
$(document).ready(function() {
$("#home_package").owlCarousel({
    loop: true,
                margin: 30,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 4,
                        nav: true
                    },

                }

});
});
</script>