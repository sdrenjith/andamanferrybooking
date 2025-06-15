

@extends('layouts.app')
@section('content')

<form method="POST" action="{{route('booking_details')}}">
@csrf
<div class="container">
    <div class="booking_details">
        <div class="row">
            <div class="col">
                <h5>{{$package_details->title}}</h5>
                <p class="p-0">(1 Room 2 Adults)</p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="left_side">
                    <h4>Travellers Details</h4>
                    <div class="row">
                            <div class="col-2">
                                <label style="text-decoration:underline;">SL No</label>
                            </div>
                            <div class="col-6 text-center">
                                <label>Name</label>
                            </div>
                            <div class="col-2">
                                <label>Gender</label>
                            </div>
                            <div class="col-2">
                                <label>Age</label>
                            </div>
                    </div>
                    <div class="row p-2">
                            <div class="col-2">
                                <label style="font-size:14px">Person 1</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" Name="full_name_per1">
                            </div>
                            <div class="col-2">
                                <select class="form-control" name="gender_person1">
                                    <option>Select Gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">female</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" Name="age_per1">
                            </div>
                    </div>
                    <div class="row p-2">
                            <div class="col-2">
                                <label style="font-size:14px">Person 2</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" Name="full_name_per2">
                            </div>
                            <div class="col-2">
                                <select class="form-control" name="gender_person2">
                                    <option>Select Gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">female</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" Name="age_per2">
                            </div>
                    </div>

                    <div class="contact_details">
                            <h4>Contact Details Enter</h4>
                        <div class="row">
                                <div class="col-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-3">
                                    <label>Mobile No</label>
                                </div>
                                <div class="col-3">
                                    <label>Journey Date</label>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" Name="email">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" Name="mobile_no" id="mobile_no" placeholder="Enter mobile number" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>

                                </div>
                                <div class="col-3">
                                    <input type="date" class="form-control" Name="date_of_journey">
                                </div>
                                <input type="hidden" value="{{$custom_package_id}}" name="package_id">
                        </div>
                    </div>
                    </div>
            </div>
            <div class="col-4 ">
                <div class="right_side">
                    <div class="text-center">
                        <h4 class="text-decoration-underline">Payment Details</h4>
                    </div>
                    <div>
                        <h6 style="color: #808080">GRAND TOTAL (2 Adults)</h6>
                    </div> 
                    <div class="amount">
                        <h5>Rs {{$total_price+$gst_price}} <span> (Inclusive of GST)</span></h5>
                    </div> 
                    <div class="fare_breakup pt-5">
                        <h6>Fare Breakup</h6>
                        <div class="row">
                            <div class="col-6">
                                <h5>Total Basic Cost</h5>
                                <h5>GST Price</h5>
                                <h5>Coupon discount <a href="">edit coupon</a></h5>
       
                            </div>
                            <div class="col-4">
                                <h5>Rs {{$total_price}}</h5>
                                <h5>Rs {{$gst_price}}</h5>
                                <h5>Rs. 0000</h5>
                            </div>
                            <div class="col-2">
                                <h5></h5>
                                <h5 </h5>
                            </div>
                            <div>
                                <hr>
                            </div>
                            <div class="row">
                               <div class="col-6">
                                    <h6>GRAND TOTAL</h6>
                               </div>
                               <div class="col-6">
                                    <h6>Rs. {{$total_price+$gst_price}}</h6>
                               </div>
                            </div>
                               
                        </div>
                    </div> 
                </div>
                <button type="submit" class="btn btn-primary mt-3" style="width:100%;">PAY NOW</button>

            </div>
        </div>

    </div>
</div>
</form>


        <!-- Modal -->
        <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="couponModalLabel">Enter Coupon Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                <div class="form-group">
                    <label for="couponCode">Coupon Code</label>
                    <input type="text" class="form-control" id="couponCode" placeholder="Enter coupon code">
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Apply Coupon</button>
            </div>
            </div>
        </div>
        </div>

</main>
@endsection

@push('scripts')

@endpush