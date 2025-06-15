@extends('layouts.app')

@section('content')
<main>

    <div class="row mb-5">
        <div class="col-lg-12 p-0">
            <div class="pageHead innerPageBanner">
                <h1> Activity Details</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="sightSeeingBanner">
                    <img src="{{ !empty($data->data[0]->activityimage[0]->path)?config('app.img_base').$data->data[0]->activityimage[0]->path:config('app.img_base').'noimage.jpg' }}" width="100%" alt="">
                </div>
                <div class="aboutSight px-3">
                    <div class="pageHead">
                        <h1 class=" text-start">{{ $data->data[0]->title }}</h1>
                    </div>
                    <p>{{ $data->data[0]->subtitle }}</p>

                </div>
            </div>
            <div class="col-lg-3">
                <h3 class="subSecHead">Other Popular Blogs</h3>
                @php
                $i=0;
                @endphp
                @if(!empty($other_data->data))
                @foreach($other_data->data as $key=>$val)
                @if($val->id!=$data->data[0]->id && $i<2) @php $i++; @endphp <div class="mb-2">
                    <div class="card sightCard">
                        <img src="{{ !empty($val->path)?config('app.img_base').$val->path:config('app.img_base').'noimage.jpg' }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">{{ $val->title }}</h5>
                                </div>
                                <span class="tags">Recommended</span>
                            </div>
                            <div class="ratings mb-3 ">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="card-text">{{ $val->subtitle }}
                            </p>

                        </div>
                        <div class="text-center card-footer border-0 bg-transparent">
                            <a href="{{ url('activity/'.$val->id) }}" class="btn btn-primary">View More</a>
                        </div>
                    </div>

            </div>
            @endif
            @endforeach
            @endif
        </div>
    </div>
    </div>
    <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="pageHead">
                        <h1>FAQ</h1>
                    </div>
                    @foreach($faq as $key => $fa)
                    <div class="faqQuestions mt-4">
                        <div class="accordion" id="accordionExample{{$key}}">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                        {{$fa->questions}}
                                    </button>
                                </h2>
                                <div id="collapse{{$key}}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample{{$key}}">
                                    <div class="accordion-body">
                                        {{$fa->answers}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

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