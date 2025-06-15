@extends('layouts.app')
@section('content')

<style>
.payment_success {
    border: 1px solid #ccc;
    border-radius: 10px;
    display: inline-block;
    padding: 15px;
    width: 50%;
    text-align: center;
}
.payment_success h5 {
    font-weight: 800;
    color: #4caf50;
    padding-top: 15px;
}
.payment_success .right_col h6 {
    font-weight: 400;
    color: #808080;
}
 
</style>
<main>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <div class="payment_success">
                <div>
                    <img src="{{ asset('images/tick.png') }}" class="img-fluid">
                    <h5> Payment Successfull<h5>
                </div>
                <div>
                    <div class="row">
                        <div class="col-6 left_col">
                            <h6>Payment Type</h6>
                            <h6>Bank</h6>
                            <h6>Mobile</h6>
                            <h6>Email</h6>
                            <h6>Paid Amount</h6>
                        </div>
                        <div class="col-6 right_col">
                            <h6>Debit Card</h6>
                            <h6>IDFC Bank</h6>
                            <h6>8825207634</h6>
                            <h6>Test@gmail.com</h6>
                            <h6>RS. 25700.00</h6>
                        </div>
                        <div>
                            <button class="btn btn-primary mt-5">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- invoice --}}

<style>
    table tr td {
        border: 1px solid #000;
        border-collapse: collapse;
    }
    table th {
        border: 1px solid #000;
        border-collapse: collapse;
    }
</style>

<div style="margin-top: 45px;">
    <h5 style="font-weight:800; text-align:center;">Tax Invoice</h5>
    <div style= "width: 825px;  margin: auto; ">
        <table style="width: 100%;">
            <tr style="width: 100%;">
                <td style="width: 49%;">
                    <table>
                        <tr>
                            <td style="width: 25%">
                                <img src="{{ asset('images/logo_new.png') }}" class="img-fluid" width="100px">
                            </td>
                            <td style="text-align: left">
                                <h6 style="margin: 0; font-weight:700">Pristine Andaman</h6>
                                <h6 style="margin: 0">Ward No. 24, Bathu Basti</h6>
                                <h6 style="margin: 0">Port Blair, South Andaman - 744105</h6>
                                <h6 style="margin: 0">GSTIN/UIN: 35AFRPK9849M1ZD</h6>
                                <h6 style="margin: 0; font-size:13px; font-weight:400 ">State Name : Andaman & Nicobar Islands, Code : 35</h6>
                                <h6 style="margin: 0; font-size:15px; font-weight:400">Email: pristineandaman@gmail.com</h6>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; padding-bottom:10px" colspan="2">
                                <h6 style="margin: 0; font-size:15px; font-weight:500">Buyer (Bill to)</h6>
                                <h6 style="margin: 2px 0; font-weight:700 ">Payyan Valapil Santosh Kumar</h6>
                                <h6 style="margin: 0; font-size:15px; font-weight:500">State Name   : Andaman & Nicobar Islands, Code : 35</h6>
                                <br>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="width:52%;">
                    <table style=" width:100%;">
                        <tr>
                            <td> 
                                <h6>Invoice No.</h6>
                                <h6 style=" font-size:15px; font-weight:500">PAO/2024-25/004</h6>
                            </td>
                            <td>
                                <h6 style=" font-size:15px; font-weight:400">Delivery Note</h6>
                                <h6 style=" font-size:15px; font-weight:400">Dummy Text</h6>
                            </td>
                        </tr>

                        <tr>
                            <td> 
                                <h6 style="margin:0; padding-bottom:17px; font-size:15px; font-weight:400">Delivery Note</h6>
                            </td>
                            <td>
                                <h6 style="margin:0; padding-bottom:17px; font-size:15px; font-weight:400">Dated</h6>
                            </td>
                        </tr>

                        <tr>
                            <td> 
                                <h6 style="margin:0; padding-bottom:16px; font-size:15px; font-weight:400">Reference No. & Date.</h6>
                            </td>
                            <td>
                                <h6 style="margin:0; padding-bottom:16px; font-size:15px; font-weight:400">Other References</h6>
                            </td>
                        </tr>

                        <tr >
                            <td> 
                                <h6 style="margin:0; padding-bottom:16px; font-size:15px; font-weight:400">Buyer's Order No</h6>
                            </td>
                            <td>
                                <h6 style="margin:0; padding-bottom:16px; font-size:15px; font-weight:400">Dated</h6>
                            </td>
                        </tr>

                        <tr>
                            <td> 
                                <h6 style="margin:0; padding-bottom:16px; font-size:15px; font-weight:400">Dispatch Doc No</h6>
                            </td>
                            <td>
                                <h6 style="margin:0; padding-bottom:16px; font-size:15px; font-weight:400">Delivery Note Date</h6>
                            </td>
                        </tr>
                        <tr>
                            <td> 
                                <h6 style="margin:0; padding-bottom:16px; font-size:15px; font-weight:400">Dispatched through</h6>
                            </td>
                            <td>
                                <h6 style="margin:0; padding-bottom:16px; font-size:15px; font-weight:400">Destination</h6>
                            </td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
            <tr style="width: 100%; ">
                <table>
                    <thead>
                        <tr style="text-align:center;">
                            <th style="width:3%; font-size:15px">SL</th>
                            <th style="width:38%;font-size:15px">Description of Service</th>
                            <th style="width:10%; font-size:15px">HSN/SAC</th>
                            <th style="width:10%; font-size:15px">Quantity</th>
                            <th style="width:8%; font-size:15px">Rate (Incl. of Tax)</th>
                            <th style="width:8%; font-size:15px">Rate</th>
                            <th style="width:5%; font-size:15px">Per</th>
                            <th style="width:10%; font-size:15px">Amount</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px">
                        <tr style="text-align:center;">
                            <td style="width:3%;">1</td>
                            <td style="width:38%; text-align:left;">
                                <h6 style="margin: 0; font-size:15px; font-weight:500"> Tour Operator 5% </h6>
                                <p style="margin: 0">Andaman Tour Package Bill </p>
                                <p style="margin: 0">From 12-05-2024 to 16-05-2024</p>
                            </td>
                            <td style="width:10%; font-size:15px">998555</td>
                            <td style="width:10%; ">1.00 Nos</td>
                            <td style="width:8%; ">54,500.00</td>
                            <td style="width:8%;">51,904.76</td>
                            <td style="width:5%;">Nos</td>
                            <td style="width:10%;">51,904.76</td>
                        </tr>
                        <tr style="text-align:center; height:71vh;">
                            <td style="width:3%;"> </td>
                            <td style="width:38%; text-align:right; font-weight:700"></td>
                            <td style="width:10%; font-size:15px"></td>
                            <td style="width:10%; font-weight:700"></td>
                            <td style="width:8%; "></td>
                            <td style="width:8%;"></td>
                            <td style="width:5%;"></td>
                            <td style="width:10%; font-weight:700"></td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="width:3%;"> </td>
                            <td style="width:38%; text-align:right; font-weight:700">Total</td>
                            <td style="width:10%; font-size:15px"></td>
                            <td style="width:10%; font-weight:700">1.00 Nos</td>
                            <td style="width:8%; "></td>
                            <td style="width:8%;"></td>
                            <td style="width:5%;"></td>
                            <td style="width:10%; font-weight:700">₹ 54,500.00</td>
                        </tr>
                    </tbody>
                    <tr>
                        <td colspan="8">Amount Chargeable (in words)
                            <h6>INR Fifty Four Thousand Five Hundred Only</h6>
                        </td>
                    </tr>
                    <tr>
                        <table style="width: 100%">
                            <tr style="text-align: center;">
                                <td style="width: 42%" rowspan="2">HSN/SAC</td>
                                <td style="width: 10%" rowspan="2">Taxable Value</td>
                                <td colspan="2">CGST</td>
                                <td colspan="2">SGST/UTGST</td>
                                <td style="width: 10%" rowspan="2" >Total Tax Amount</td>
                            </tr>
                            <tr>
                                <td>Rate</td>
                                <td>Amount</td>
                                <td>Rate</td>
                                <td>Amount</td>
                               
                            </tr>
                            <tr>
                                <td style="width: 42%">998555</td>
                                <td style="width: 10%" >51,904.76</td>
                                <td>2.50%</td>
                                <td>1,297.62</td>
                                <td style="width: 10%">2.50%</td>
                                <td>1,297.62</td>
                                <td>2,595.24</td>
                            </tr>
                            <tr style="font-weight: 700">
                                <td style="width: 42% ; text-align:right">Total</td>
                                <td style="width: 10%" >51,904.76</td>
                                <td></td>
                                <td>1,297.62</td>
                                <td style="width: 10%">2.50%</td>
                                <td></td>
                                <td>2,595.24</td>
                            </tr>

                            <tr>
                                <td colspan="8">
                                    Tax Amount (in words) : <span style="font-weight: 700"> Two Thousand Five Hundred Ninety Five and Twenty Four 0 Only</span>
                                </td>
                            </tr>

                            <tr>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 50%; border-bottom:none; vertical-align: bottom;">
                                            Company's PAN : <span style="font-weight: 700">&nbsp; &nbsp; AFRPK9849M </span>
                                        </td>
                                        <td style="width: 50%;">
                                            <table style="width: 100%; ">
                                                <tr>
                                                    <td colspan="2" style="border: none;">
                                                        <h6 style="margin: 0">Company's Bank Details</h6>
                                                    </td>
                                                    
                                                </tr>

                                                <tr style="border: none;">
                                                    <td style="border: none;"> 
                                                        <h6 style="margin: 0">Bank Name </h6>
                                                    </td>
                                                    <td style="border: none;">
                                                        <h6 style="font-size: 13px; margin:0; font-weight:700"> : State Bank of India</h6>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="border: none;">
                                                        <h6 style="margin: 0">A/c No. </h6>
                                                    </td>
                                                    <td style="border: none;">
                                                        <h6 style="font-size: 13px; margin:0; font-weight:700"> : 39107866379</h6>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="border: none;">
                                                        <h6 style="margin: 0">Branch & IFS Code </h6>
                                                    </td>
                                                    <td style="border: none;">
                                                        <h6 style="font-size: 13px; margin:0; font-weight:700"> : SME MICR: 744002999 & SBIN0061250</h6>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr style="border: none;">
                                        <td style="border-top:none;">
                                            <h6 style="font-size: 14px; margin:0; text-decoration:underline;">Declaration</h6>
                                            <h6 style="font-size: 14px; margin:0">We declare that this invoice shows the actual price of
                                                the goods described and that all particulars are true and
                                                correct</h6>
                                        </td>
                                        <td style="text-align: end;">
                                            <h6 style="padding-bottom: 15px;">for Pristine Andaman</h6>
                                            <h6>Authorised Signatory</h6>
                                        </td>
                                    </tr>
                                </table>
                            </tr>
                        </table>
                    </tr>
                </table>               
            </tr>
        </table>
                                             <h6 style="text-align: center"> This is a System Generated Invoice</h6>
    </div>                       
</div>

</main>
@endsection

@push('scripts')
@endpush