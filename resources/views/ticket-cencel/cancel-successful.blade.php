@extends('layouts.app')

@section('content')

<div class="container ">
    <div class="row secHead mt-5 py-3">
        <div class="col-12 text-center">
            <i class="bi bi-check2-circle text-success" style="font-size: 80px;"></i>
        </div>
        <div class="col-12 text-center">
            <h2> Cancelled Successfully</h2>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-8 col-lg-4 bannerBtns text-center">
            <a href="{{url('/')}}" class="btn m-auto" style="width: 140px; height: 40px; background:rgb(133, 196, 133)">Done</a>
        </div>

    </div>
</div>
@endsection