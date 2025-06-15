@extends('layouts.app')

@section('content')
{{-- <?php
echo $booking_id;
echo $return_booking_id;
die();
?> --}}

<style>
    body {
      text-align: center;
      padding: 20px 0;
      background: #EBF0F5;
    }
  
    h1 {
      color: #88B04B;
      font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
      font-weight: 900;
      font-size: 40px;
      margin-bottom: 10px;
    }
  
    p {
      color: #404F5E;
      font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
      font-size: 20px;
      margin: 0;
    }
  
    i {
      color: #9ABC66;
      font-size: 100px;
      line-height: 200px;
      margin-left: -15px;
    }
  
    .card {
      background: white;
      padding: 40px;
      border-radius: 4px;
      box-shadow: 0 2px 3px #C8D0D8;
      display: inline-block;
      margin: 2 auto;
    }
</style>

<form action="{{ url('/ticket_generate') }}" method="post" target="_blank">
  @csrf

  <input type="hidden" name="booking_id" id="booking_id" value="{{$booking_id}}">
  <input type="hidden" name="trip2_booking_id" id="return_booking_id" value="{{$trip2_booking_id}}">
  <input type="hidden" name="trip3_booking_id" id="return_booking_id" value="{{$trip3_booking_id}}">

    <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
      <h1>Success</h1>
      <p>We received your purchase request Thank You <br />{{$order_id}}</p>
      <div class="mt-5">
        <button class="btn btn-success" type="submit" target="_blank"> Print </button> 
      </div>
    </div>
    
</form>
   
@endsection