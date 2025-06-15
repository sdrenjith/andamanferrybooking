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
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active indicators" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2" class="indicators"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3" class="indicators"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="comment">
                                    <p>"Our family was traveling via bullet train between cities in Japan with our
                                        luggage - the
                                        location for this hotel made that so easy. Agoda price was fantastic. "</p>
                                </div>
                                <div class="userInfo">
                                    <div class="profileImg">
                                        <img src="images/profile-pic-demo.png" alt="">
                                    </div>
                                    <div>
                                        <h3>Sayan Debnath</h3>
                                        <p>Rocket Scientist</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="comment">
                                    <p>"Our family was traveling via bullet train between cities in Japan with our
                                        luggage - the
                                        location for this hotel made that so easy. Agoda price was fantastic. "</p>
                                </div>
                                <div class="userInfo">
                                    <div class="profileImg">
                                        <img src="images/profile-pic-demo.png" alt="">
                                    </div>
                                    <div>
                                        <h3>Sayan Debnath</h3>
                                        <p>Nuclear Scientist</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="comment">
                                    <p>"Our family was traveling via bullet train between cities in Japan with our
                                        luggage - the
                                        location for this hotel made that so easy. Agoda price was fantastic. "</p>
                                </div>
                                <div class="userInfo">
                                    <div class="profileImg">
                                        <img src="images/profile-pic-demo.png" alt="">
                                    </div>
                                    <div>
                                        <h3>Sayan Debnath</h3>
                                        <p>Space Scientist</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
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