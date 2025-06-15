<div class="carousel-indicators">
    @if(!empty($data->data))
    @foreach($data->data as $key=>$val)
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ ($key==0)?'active':'' }} indicators" aria-current="true" aria-label="Slide {{ $key+1 }}"></button>
    @endforeach
    @endif
</div>
<div class="carousel-inner">
    @if(!empty($data->data))
    @foreach($data->data as $key=>$val)
    <div class="carousel-item {{ ($key==0)?'active':'' }}">
        <div class="comment">
        <p>{{$val->subtitle }}</p>
        </div>
        <div class="userInfo">
            <div class="profileImg">
                <img src="{{url('images/profile-pic-demo.png')}}" alt="">
            </div>
            <div>
                <h3>Sayan Debnath</h3>
                <p>Rocket Scientist</p>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>
<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({

            loop: true,
            margin: 30,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: true
                },
                1000: {
                    items: 3,
                    nav: true,

                }
            }
        })
    });
</script>