@extends('layouts.app')

@section('content')
<main>
    <section class="mt-4">

        <div class="row mb-5">
            <div class="col-lg-12 p-0">
                <div class="pageHead innerPageBanner">
                    <h1>List of Activites in Andaman</h1>
                </div>
            </div>
        </div> 
        <div class="container">
            <div class="activityPage desktop">
                @if(!empty($data->data))
                @foreach($data->data as $key=>$val)

                <div class="row mb-4">
                    <div class="col-4">
                        <a href="{{ url('activity/'.$val->id) }}" class="text-decoration-none ">
                            <img src="{{ !empty($val->activityimage[0]->path)?config('app.img_base').$val->activityimage[0]->path:config('app.img_base').'noimage.jpg' }}" width="100%" alt="">
                        </a>
                    </div>

                    <div class="col-lg-8 blogInfo">
                        <h3>{{ $val->title }}</h3>
                        <p>{{ $val->subtitle }}</p>

                        <div class="row billingAndOffer activityCard   mt-3">
                            <div class="col-12 roomDetails">
                                <h4 class="mb-0 text-center">Book {{ $val->title }}</h4>
                            </div>
                            <div class="pt-4 pb-2">
                                <p class="fw-bold mb-0 ms-1">₹{{ $val->price }} per hour</p>
                                <span>Underwater photo and video included Complimentary pick up and drop from
                                    hotel.</span>
                            </div>
                            <div class="text-center pb-3 pt-2">
                                <a href="{{ url('activity/'.$val->id) }}" class="btn btn-primary">View Activity </a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                @endif
            </div>
        </div>
    </section>
</main>
@endsection
@push('scripts')
<!-- <script src="{{ asset('assets/js/index_page.js') }}"></script> -->
<script>
    function searchclear() {
        var search_txt = $("#search_txt").val();
        if ($.trim(search_txt) == '') {
            $("#search_form").submit();
        }
    }
</script>
@endpush