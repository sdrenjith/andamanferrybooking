<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book My Ferry - Ticket Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        h2 { color: #4CAF50; }
        .section { margin-bottom: 20px; }
        .footer { font-size: 12px; color: #666; }
        .btn { background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
        .details, .passenger-details { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .details th, .details td, .passenger-details th, .passenger-details td { padding: 8px; border: 1px solid #ddd; }
        .details th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Book My Ferry</h2>
        <div style="text-align: center;"><img src="http://uat.bookmyferry.in/assets/images/Capture.PNG" alt=""></div>
        <p>We Are Processing Your Ticket Booking Request</p>
        <p>Hi {{ $booking_data->c_name}},</p>
        <p>Thank you for choosing <a href="http://bookmyferry.in">bookmyferry.in</a> for your ferry journey! We are pleased to inform you that we have received your order. Our team is now working on processing your booking. Once confirmed, your ferry tickets will be emailed to you. This usually happens within 4 working hours (between 7 AM and 11 PM IST). We appreciate your patience during this time.</p>
        <p>In case of any changes, our team will reach out to you via email, phone, or WhatsApp.</p>

        <div class="section">
            <strong>Order:</strong> 5960271670 {{ date("M d, Y", strtotime($booking_data->created_at)) }}
        </div>

        <table class="details">
            <tr>
                <th>Booking For</th>
                <th>Boat/Vessel</th>
                <th>From Location</th>
                <th>To Location</th>
                <th>Date of Journey</th>
                <th>Departure Time</th>
                <th>Arrival Time</th>
                <th>No. of Passengers</th>
                <th>Class Type</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>Ferry</td>
                <td>{{ $booking_data->ship_name }}</td>
                <td>{{ $booking_data->from_location }}</td>
                <td>{{ $booking_data->to_location }}</td>
                <td>{{ $booking_data->date_of_jurney }}</td>
                <td>{{ $booking_data->departure_time }}</td>
                <td>{{ $booking_data->arrival_time }}</td>
                <td>{{ count($booking_data->passengers) }}</td>
                <td>{{ $booking_data->ferry_class }}</td>
                <td>{{ $booking_data->amount }}</td>
            </tr>
        </table>

        <p><strong>Subtotal:</strong> {{ $booking_data->amount }}</p>
        <p><strong>Payment method:</strong> {{ $booking_data->payment_method }}</p>
        <p><strong>Total:</strong> {{ $booking_data->amount }}</p>
        
        <p>Please download your ticket from the link below:</p>
        <a href="http://uat.bookmyferry.in/green-ocean-ticket/{{ $booking_data->pnr_id }}">http://uat.bookmyferry.in/green-ocean-ticket/{{ $booking_data->pnr_id }}</a>

        <h3>Passenger Details</h3>
        <table class="passenger-details">
            <tr>
                <th>Sl.</th>
                <th>Title</th>
                <th>Passenger Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Country</th>
                <th>Passport ID</th>
                <th>Expiry Date</th>
            </tr>
            @forelse($booking_data->passengers as $key => $passenger)
            <tr>
                <td style="text-align: start; padding-top:0px; font-size: 18px;">{{$key +1}}</td>
                <td style="text-align: start; padding-top:0px; font-size: 18px;">{{$passenger->title}}</td>
                <td style="text-align: start; padding-top:0px; font-size: 18px;">{{$passenger->full_name}}</td>
                <td style="text-align: start; padding-top:0px; font-size: 18px;">{{$passenger->gender}}</td>
                <td style="text-align: start; padding-top:0px; font-size: 18px;">{{$passenger->dob}}</td>
                <td style="text-align: start; padding-top:0px; font-size: 18px;">{{$passenger->resident}}</td>
                <td style="text-align: start; padding-top:0px; font-size: 18px;">{{$passenger->passport_id}}</td>
                <td style="text-align: start; padding-top:0px; font-size: 18px;">{{ !empty($passenger->expiry_date)? date("d-m-Y", strtotime($passenger->expiry_date)) : ''; }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: start; padding-top:0px; font-size: 18px;">No Passenger</td>
            </tr>
            @endforelse
        </table>

        <h3>Boarding & Drop Points</h3>
        <ul>
            <li><strong>Port Blair:</strong> Haddo Jetty</li>
            <li><strong>Havelock/Swarajdweep:</strong> Havelock Jetty</li>
            <li><strong>Neil Island/Shaheed Dweep:</strong> Neil Island Jetty</li>
        </ul>

        <div class="section">
            <h3>Change Booking</h3>
            <p>If you need to modify or cancel your booking, please reply to this email or contact us at <a href="mailto:bookmyferry@gmail.com">bookmyferry@gmail.com</a>. Please note that any modifications or cancellations will be subject to our refund and cancellation policy available on our website.</p>
        </div>

        <div class="section">
            <h3>Help</h3>
            <p>If you have any questions or need further assistance, please contact us at <a href="mailto:bookmyferry@gmail.com">bookmyferry@gmail.com</a> or call 09933752444. You can also reach us via <a href="https://wa.me/9933752444">WhatsApp</a>.</p>
        </div>

        <div class="footer">
            <p>Thank you for using <a href="http://www.bookmyferry.in">www.bookmyferry.in</a></p>
            <p><strong>Billing Address:</strong> Subham, 8926562084, subham@xgenmedia.com</p>
            <p><strong>Contact Details:</strong> Vijya Sagar, <a href="mailto:bookmyferry@gmail.com">bookmyferry@gmail.com</a>, 9933752444</p>
        </div>
    </div>
</body>
</html>
