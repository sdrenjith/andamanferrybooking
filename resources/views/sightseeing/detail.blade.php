@extends('layouts.app')
 
@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="pageHead">
                    <h1>{{ $data->data[0]->title." In ".$data->data[0]->location->name }}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">

                <div class="sightSeeingBanner">
                    <img src="{{ !empty($data->data[0]->sightseeingimage[0]->path)?config('app.img_base').$data->data[0]->sightseeingimage[0]->path:config('app.img_base').'noimage.jpg' }}" width="100%" alt="">
                </div>
                <div class="aboutSight px-3 mt-5">
                    <p>{{ $data->data[0]->subtitle }}</p>
                    <button class="btn mt-4 button">BOOK</button>
                </div>
            </div>
            <div class="col-lg-3">
                <h3 class="subSecHead">{{ "Other places in ".$data->data[0]->location->name }} </h3>
                @php
                $i=0;
                @endphp
                @if(!empty($other_data->data))
                @foreach($other_data->data as $key=>$val)
                @if($val->id!=$data->data[0]->id && $i<2) 
                @php $i++; @endphp 
                <div class="mb-2">
                    <div class="card sightCard">
                        <img src="{{ !empty($val->sightseeingimage[0]->path)?config('app.img_base').$val->sightseeingimage[0]->path:config('app.img_base').'noimage.jpg' }}" class="card-img-top" alt="">
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
                            <a href="{{ url('sightseeing/'.$val->id) }}" class="btn btn-primary">View More</a>
                        </div>
                    </div>

            </div>
            @endif
            @endforeach
            @endif
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