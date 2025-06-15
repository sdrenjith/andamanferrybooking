@extends('layouts.app')

@section('content')
<main>
    <div class="container">

        <form class="row " id="contactus_form" name="contactus_form" method="POST" action="{{ route('enquery.store') }}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="pageHead">

                        <div class="text-center">
                            @if (session()->has('success'))
                            <span class="bg-success text-center p-2" style="color:#FFF; border-radius:5px">
                                {{(session()->get('success'))}}
                            </span>

                            @endif
                        </div>

                        <h1>Enquiry Now</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="row contactCard enqueryNow">
                        <div class="col-12 mb-4">
                            <div class="sectionHead ">
                                <h2 class="my-0">Your Trip</h2>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="" class="form-label">When would you like to go?</label>
                            <select name="travel_month" id="" class="form-select">
                                <option value="">Select a month</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="March">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="" class="form-label">How long you would like to go for?</label>
                            <input type="number" class="form-control" name="travel_duration" placeholder="(Days)">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="" class="form-label">How many people are travelltravelling?</label>
                            </i><input type="number" class="form-control" name="travel_person">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="" class="form-label">How much would you like to spend per person?</label>
                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <label for="from" class="form-label">Price from</label>
                                    <div class="position-relative">
                                        <i class="bi bi-currency-rupee position-absolute top-50 translate-middle-y
                                        "></i> <input type="text" class="form-control ps-3" inputmode="numeric" placeholder=" Starting Price" name="travel_starting_price" id="travel_starting_price">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="to" class="form-label">Price to</label>
                                    <div class="position-relative">
                                        <i class="bi bi-currency-rupee position-absolute top-50 translate-middle-y
                                        "></i><input type="text" class="form-control ps-3" inputmode="numeric" name="travel_ending_price" id="travel_ending_price" placeholder=" Starting Price">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="" class="form-label">Any other comments or quesquestions?</label>
                            <textarea id="" class="form-control" name="comments" placeholder="Write Here..." cols="30" rows="5"></textarea>
                        </div>
                        <!-- <div class="col-12 col-md-6 mb-3">
                            <label for="" class="from-label">Activites</label>
                            <select name="" id="" class="form-select">
                                <option value="">Select an activity</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="" class="from-label">Travel Style</label>
                            <select name="" id="" class="form-select">
                                <option value=""> Select a travel style</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>Travel Style
                            </select>
                        </div> -->
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="row contactCard ">
                        <div class="col-12 enqueryNow">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="sectionHead ">
                                        <h2 class="my-0">Your Trip</h2>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="name" class="from-label">Your Name(required)<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Write Here..." >
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="email" class="from-label">Your Email(required)<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Write Here..." >
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="mobile" class="from-label">Your Mobile(required)<span class="text-danger">*</span></label>
                                    <input type="tel" name="mobile" class="form-control" id="mobile" placeholder="Write Here..." >
                                </div>
                                <div class="col-12 mt-5">
                                    <p class="fw-medium text-muted">All details provided by you will be held by Pristine
                                        Andaman and used in accordance with our <a href="">Privacy Policies</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12  text-center ">
                   <label style="border: 1px solid; padding:2px 10px; ">{{$captcha}}</label> <br>
                   <input type="text" name="captcha_value" id="captcha_value" placeholder="Enter The Captcha" class="mt-3 text-center">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12 mt-4 text-center ">
                    <button class="btn button " type="button" id="submit_button" style="width:30%">Request my trailor Made Trip</button>
                    <p class="text-muted mt-2">(You will hear back from us within 2 business hours)</p>
                </div>
            </div>
    </div>
    </form>
</main>
@endsection