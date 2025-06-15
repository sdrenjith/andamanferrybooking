@extends('layouts.app')

@section('content')
    <style>
        tbody tr {
            border-bottom: 1px solid #d8d8d8;

        }

        tbody tr:nth-child(even) {
            background: #f3f3f3;
        }

        td,
        th {
            padding: 10px;
        }

        th {
            font-size: 18px;
            font-weight: 600;
            color: #fff;
        }
    </style>
    @php
        use Carbon\Carbon;
        // print_r($boat_details);
        // die();
    @endphp

    <div class="row secHead my-5w-100 p-0 mx-0">
        <div class="col-12 text-center subPage">
            <h2>Cancel Ticket Preview</h2>
        </div>
    </div>
<form action="{{url('/ticket-cenceled-details-boat')}}" method="POST"> 
    @csrf
    <div class="container ">
        <div class="row w-100 p-0 m-0 bg-white">
            <div class="px-2 col-12 py-1 tripDirection">
                <p class=" m-0 ">Date of Journey : <span
                        class="departing-txt-date d-inline-block">{{$boat_details[0]->date_of_jurney}}</span>
                </p>
            </div>
             <input type="hidden" name="type" value="{{$boat_details[0]->type}}">
            {{-- <input type="hidden" name="booking_id" value="{{$boat_details->id}}">  --}}

            <div class="col-md-12 mt-2">
                <div class="departing-box-main">

                    <div class="departing-txt">
                        <span class="departing-txt-date"></span>
                    </div>
                    <div class="row w-100 p-0 m-0 departing-destination">
                        <div class="col-sm-6 destination-time px-0">
                        </div>
                        <div class="col-sm-6 destination-time px-0">
                        </div>
                    </div>
                    <div class="row w-100 p-0 m-0 mt-2">
                        <div class="departing-txt m-0 col-2 p-0">
                            <p class="departing-txt-date m-0">Boat Title </p>
                        </div>

                   
                        <div class="col-6 p-0 departing-txt">
                            <p class="departing-txt-date d-inline-block m-0">
                              {{$boat_details[0]->ship_name}}  
                            </p>
                        </div>
                    </div>
                    {{-- <div class="row w-100 p-0 m-0 mt-2">
                        <div class="departing-txt m-0 col-6 p-0">
                            <p class="departing-txt-date m-0">No of Passenger</p>
                        </div>
                        <div class="col-6 p-0 departing-txt">
                            <p class="departing-txt-date d-inline-block m-0">{{ $boat_details->no_of_passenger }}
                            </p>
                        </div>
                    </div> --}}

                </div>
            </div>
            <div class="table-responsive px-0">
                <table class="w-100">
                    <thead>
                        <tr>
                            <th class="totalFare" colspan="5">
                                Passenger Details
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($boat_details as $passenger_detail )
                        @php
                            $fullName = $passenger_detail->full_name;
                        @endphp
                        <tr>
                            <td>{{$fullName}}</td>
                            <td>{{$passenger_detail->dob}} Age</td>
                            <td>{{$passenger_detail->gender}}</td>
                            <td>{{$passenger_detail->resident}}</td>
                            <td>{{$passenger_detail->trip_type}}</td>
                            <td><input type="checkbox" name="passenger_ids[]" id="" value="{{$passenger_detail->id}}"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="departing-box-main totalFare">
            <div class="row w-100 p-0 m-0 py-2 px-3 align-items-center">
                <div class="col-6 p-0">
                    <div class="departing-txt">
                        <p class="departing-txt-date m-0 text-white">Total fare
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 destination-time p-0 text-white text-end">{{$boat_details->amount}}
                </div>
            </div>
        </div> --}}

        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-8 col-lg-4 bannerBtns d-block text-center ">
                <a href="{{url('/ticket-cancellation-request')}}" class="btn m-auto bg-danger text-white" style="width: 140px; height: 40px; border-radius:8px">Cancel</a>
            </div>
            
            <div class="col-12 col-md-8 col-lg-4 bannerBtns d-block text-center">
                <button type="submit" class="btn m-auto bg-success text-white" style="width: 140px; height: 40px;">Confirm</button>
            </div>
       
        </div>
    </div>
</form>
@endsection
