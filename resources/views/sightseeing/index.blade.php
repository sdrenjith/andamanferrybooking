@extends('layouts.app')

@section('content')
<main>

    <div class="pageHead innerPageBanner">
        <h1>Sight Seeing Places</h1>
    </div>
    <div class="container">
        <div class="selectSight mt-4">
            <h4>Select Your Location</h4>
            <form id="loc_form" name="loc_form" method="GET">
                <select name="location" id="location" class="form-select" onchange="$('#loc_form').submit();">
                    <option value='0'>All</option>
                    @if(!empty($loc_data->data))
                    @foreach($loc_data->data as $loc)
                    <option value="{{ $loc->id }}" {{ (!empty($_GET['location']) && ($loc->id==$_GET['location']))?'selected':'' }}>{{ $loc->name }}</option>
                    @endforeach
                    @endif
                </select>
            </form>
        </div>


        <div class="sectionHead">
            <h2>{{ (!empty($_GET['location']))?"You Must-See Places In ".$data->data[0]->location->name:"You Must-See Places In Andaman" }}</h2>
        </div>
        <div class="sightCards mt-3">
            <div class="row">
                @if(!empty($data->data))
                @foreach($data->data as $key=>$val)
                <div class="col-lg-3 col-12 col-md-3 col-sm-2 mb-3">
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
                            <p class="card-text">{{ $val->subtitle }}</p>
                        </div>
                        <div class="text-center card-footer border-0 bg-transparent">
                            <a href="{{ url('sightseeing/'.$val->id) }}" class="btn btn-primary">View More</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-lg-3 col-12 col-md-3 col-sm-2 mb-3">
                    <div class="">
                        <p class="card-text">No Data Found</p>
                    </div>
                </div>
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