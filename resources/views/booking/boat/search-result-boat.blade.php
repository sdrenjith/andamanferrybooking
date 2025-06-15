@extends('layouts.app')

@section('content')
<main>
    <section class="searchResultsPage  ">
        <div class="ferryBanner ">
            <div class="container">
                <div class="bookingConsole ">
                    <div class="position-relative tabContainer">
                        <form action="{{ url('/search-result-boat') }}" method="GET">
                            <div class="tabs opacity-100 row mx-0">
                                <div class="col-12 col-md-6 col-lg-4 mb-2 mb-lg-0 border-end">
                                    <label for="location">Boat Name</label>
                                    <select name="id" class="form-select border-0 p-0" id="">
                                        {{-- <option value="select">Select</option> --}}
                                        @foreach ($boat_lists as $boat_list)
                                        <option value="{{ $boat_list->id }}" {{ old('id', request('id')) == $boat_list->id ? 'selected' : '' }}>
                                            {{ $boat_list->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                    <label for="date">Date</label>
                                    <input type="date" class="my_date_picker" placeholder="Select Date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" value="{{ old('date', request('date')) }}">

                                </div>
                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 border-end">
                                    <label for="location">Passengers</label>
                                    <input type="number" class="form-control" id="passenger" name="passengers" placeholder=1 value="{{ old('passengers', request('passengers')) }}" oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);" required>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0 ">
                                    <label for="location">Infants</label>
                                    <input type="number" name="infants" maxlength="2" inputmode="numeric" id="infants" placeholder="No. of Infant" value="{{ old('infants', request('infants')) }}" oninput="this.value = this.value.replace(/[^1-2]/g, '').slice(0, 1);">
                                </div>
                                <div class="col-12 col-md-6 col-lg-2 mb-2 mb-lg-0">
                                    <button type="submit" class="btn button w-100"><i class="bi bi-search"></i>
                                        Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5 pt-3 searchResultsPage">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="row secHead mb-4">
                        <div class="col-12 text-center">
                            <h2>Search Results For Boat</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 searchResults">
                            @if(!empty($boat_datas))
                            <div class="ferryCard boatCard ferrySearch mb-3">
                                <div class="ferryImg">
                                    <img src="{{ env('UPLOADED_ASSETS') . 'uploads/boat/' . $boat_list->image }}" alt="">
                                </div>
                                <div class="ferryDetails  ">
                                    <div>
                                        <h4 class="mb-3">{{$boat_datas->title}}</h4>
                                        {{-- <p class="mb-3">4.5 - 5 hour NaPali Tour</p> --}}
                                            <p class="mb-3">8 Seats Availabel</p>
                                        <p class="fw-semibold ">₹ {{$boat_price}}</p>

                                    </div>
                                    <div>
                                        <button type="button" class="btn boat-book-btn mt-3 ms-0" data-boatschedule-id="{{ $boat_datas->id }}">Book Now</button>
                                    </div>

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('js')
<script>
      $(document).ready(function() {
            $('#date').flatpickr({
                dateFormat: 'Y-m-d',
               
            });
            $('#tr_date').flatpickr({
                dateFormat: 'Y-m-d',
               
            });
            $('#return_date_of_journey').flatpickr({
                dateFormat: 'Y-m-d',
               
            });
    });
    
    // $(document).ready(function() {
    //     $('.boat-book-btn').on('click', function() {
    //         var boatScheduleId = $(this).data('boatschedule-id');

    //         $.ajax({
    //             url: '{{ url('login-check') }}', // Route to handle the request
    //             method: 'GET',
    //            // data: formData,
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             success: function(response) {
    //                 var res = JSON.parse(response);

    //                 if(res.status == false){
    //                     $('#boatScheduleId').val(boatScheduleId);
    //                     $('#loginModal').modal('show');
    //                 }
    //             },
    //             error: function(xhr, status, error) {
    //                 alert('An error occurred');
    //                 console.log(xhr.responseText);
    //             }
    //         });
    //     });
    // });


    // $('.get-otp').on('click', function() {
    //     var mobileNo = $("#mobile_no").val();
    //     var boatScheduleId = $('#boatScheduleId').val()
    //     $.ajax({
    //         url: '{{ url('get-login-otp') }}',
    //         method: 'POST',
    //         data: {mobileNo: mobileNo},
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(response) {
    //             var res = JSON.parse(response);
    //             if(res.status == true){
    //                 $("#otp_display").css('display', 'block');
    //                 $(".get-otp").css('display', 'none');
    //                 $(".login-in-btn").css('display', 'block');
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             alert('An error occurred');
    //             console.log(textStatus, errorThrown);
    //         }
    //     });
    // });


    // $('.boat-book-btn').on('click', function() {

    //     //var boatScheduleId = $('#boatScheduleId').val();

    //     var boatScheduleId = $(this).data('boatschedule-id');
    //     var date = $('#date').val();
    //     var passengers = $('#passenger').val();
    //     var infants   = $('#infants').val();



    //     var newUrl = "{{ route('booking_boat_search') }}";
    //                 newUrl += '?boatScheduleId=' + encodeURIComponent(boatScheduleId);
    //                 newUrl += '&date=' + encodeURIComponent(date);
    //                 newUrl += '&passengers=' + encodeURIComponent(passengers);
    //                 newurl += '&infants=' + encodeURIComponent(infants);  

    //                 window.location.href = newUrl;
    // });

    $('.boat-book-btn').on('click', function() {
        var boatScheduleId = $(this).data('boatschedule-id');
        var date = $('#date').val();
        var passengers = $('#passenger').val();
        var infants = $('#infants').val();

        var newUrl = "{{ route('booking_boat_search') }}";
        newUrl += '?boatScheduleId=' + encodeURIComponent(boatScheduleId);
        newUrl += '&date=' + encodeURIComponent(date);
        newUrl += '&passengers=' + encodeURIComponent(passengers);
        newUrl += '&infants=' + encodeURIComponent(infants);

        window.location.href = newUrl;
    });
</script>
@endpush