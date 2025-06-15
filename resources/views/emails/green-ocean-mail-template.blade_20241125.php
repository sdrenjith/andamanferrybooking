<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book My Ferry - Ticket Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; color: #000; line-height: 1.4; }
        .container { max-width: 700px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        /* h2 { color: #4CAF50; } */
        .section { margin-bottom: 10px; }
        .footer { font-size: 12px; color: #666; }
        .btn { background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
        .details, .passenger-details { width: 100%; border-collapse: collapse; margin-top: 10px; }

        .details th,
        .details td,
        .passenger-details th,
        .passenger-details td,
        .passenger-details th {
            font-size: 14px;
            padding: 5px;
            border: 1px solid #ddd;
        }
        .details th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center; color: #4d90fe">Book My Ferry</h2>
        <div style="text-align: center;"><img style="width: 100px;" src="http://bookmyferry.in/assets/images/logo.png" alt=""></div>
        <p style="text-align: center; color:#7f7f7f">We Are Processing Your Ticket Booking Request</p>
        <p>Hi {{ $booking_data->c_name}},</p>
        <p>Thank you for choosing <a href="http://bookmyferry.in">bookmyferry.in</a> for your ferry journey! We are pleased to inform you that we have received your order. Our team is now working on processing your booking. Once confirmed, your ferry tickets will be emailed to you. This usually happens within 4 working hours (between 7 AM and 11 PM IST). We appreciate your patience during this time.</p>
        <p>In case of any changes, our team will reach out to you via email, phone, or WhatsApp.</p>

        <div class="section">
            <strong>Order:[{{ $booking_data->order_id }}] ({{ date("M d, Y", strtotime($booking_data->created_at)) }})</strong>
        </div>

        <table class="details">
            <thead>
                <tr>
                    <td style="width: 60%">Product</td>
                    <td>No of Passenger</td>
                    <td>Price</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div style="margin: 5px"><span style="margin-right: 10px;">Booking For:</span> Ferry</div>
                        <div style="margin: 5px"><span style="margin-right: 10px;">Boat/Vessel:</span> {{ $booking_data->ship_name }}</div>
                        <div style="margin: 5px"><span style="margin-right: 10px;">From Location:</span> {{ $booking_data->from_location }}</div>
                        <div style="margin: 5px"><span style="margin-right: 10px;">To Location:</span>{{ $booking_data->to_location }}</div>
                        <div style="margin: 5px"><span style="margin-right: 10px;">Date of Journey:</span>{{ $booking_data->date_of_jurney }}</div>
                        <div style="margin: 5px"><span style="margin-right: 10px;">Departure Time:</span>{{ $booking_data->departure_time }}</div>
                        <div style="margin: 5px"><span style="margin-right: 10px;">Arrival Time:</span>{{ $booking_data->arrival_time }}</div>
                        <div style="margin: 5px"><span style="margin-right: 10px;">No. of Passengers:</span>{{ count($booking_data->passengers) }}</div>
                        <div style="margin: 5px"><span style="margin-right: 10px;">Class Type:</span>{{ $booking_data->ferry_class }}</div>
                    </td>
                    <td style="text-align: center">{{ count($booking_data->passengers) }}</td>
                    <td style="text-align: right">{{ $booking_data->amount }}</td>
                </tr>
                <tr>
                    <td>Subtotal</td>
                    <td></td>
                    <td style="text-align: right">{{ $booking_data->amount }}</td>
                </tr>
                <tr>
                    <td>Payment mode</td>
                    <td></td>
                    <td>{{ $booking_data->payment_method }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">Total:</td>
                    <td style="text-align: right">{{ $booking_data->amount }}</td>
                </tr>
            </tbody>
        </table>

        <p style="margin-bottom: 2px;">Please download your ticket from the link below:</p>
        <a href="http://uat.bookmyferry.in/green-ocean-ticket/{{ $booking_data->pnr_id }}">http://uat.bookmyferry.in/green-ocean-ticket/{{ $booking_data->pnr_id }}</a>

        <h3 class="section">Passenger Details</h3>
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
                <td>{{$key +1}}</td>
                <td>{{$passenger->title}}</td>
                <td>{{$passenger->full_name}}</td>
                <td>{{ucfirst($passenger->gender)}}</td>
                <td>{{$passenger->dob}}</td>
                <td>{{ucfirst($passenger->resident)}}</td>
                <td>{{$passenger->passport_id}}</td>
                <td>{{ !empty($passenger->expiry_date)? date("d-m-Y", strtotime($passenger->expiry_date)) : ''; }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No Passenger</td>
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
