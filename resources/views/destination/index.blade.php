@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pageHead">
                    <h1>Testimonials</h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-11 col-md-8 col-lg-6">
                <img src="images/quote.svg" width="60px" alt="">
                <div id="carouselExampleIndicators" class="carousel testimonials slide">
                    <div class="carousel-indicators">
                        @if(!empty($data->data))
                        @foreach($data->data as $key=>$val)
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key==0?'active':'' }} indicators" aria-current="true" aria-label="Slide {{ $key+1 }}"></button>
                        @endforeach
                        @endif
                    </div>
                    <div class="carousel-inner">
                        @if(!empty($data->data))
                        @foreach($data->data as $key=>$val)
                        <div class="carousel-item {{ $key==0?'active':'' }}">
                            <div class="comment">
                                <p>{{ $val->subtitle }}</p>
                            </div>
                            <div class="userInfo">
                                <h3>Sayan Debnath</h3>
                                <p>Rocket Scientist</p>
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
                </div>

            </div>
        </div>
    </div>
</main>
@endsection
@push('scripts')
<!-- <script src="{{ asset('assets/js/index_page.js') }}"></script> -->
<script>

</script>
@endpush