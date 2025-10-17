<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ferry Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #0076ae;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .booking-details {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border-left: 4px solid #0076ae;
        }
        .passenger-details {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Ferry Booking Confirmation</h1>
        <p>Order ID: {{ $order_id }}</p>
    </div>
    
    <div class="content">
        <h2>Dear {{ $booking->c_name }},</h2>
        <p>Thank you for your ferry booking! Your payment has been successfully processed and your booking is confirmed.</p>
        
        <div class="booking-details">
            <h3>Booking Details</h3>
            <table>
                <tr>
                    <th>Order ID</th>
                    <td>{{ $order_id }}</td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $booking->c_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $booking->c_email }}</td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td>{{ $booking->c_mobile }}</td>
                </tr>
                <tr>
                    <th>Journey Date</th>
                    <td>{{ date('d-m-Y', strtotime($booking->date_of_jurney)) }}</td>
                </tr>
                <tr>
                    <th>Ship Name</th>
                    <td>{{ $booking->ship_name }}</td>
                </tr>
                <tr>
                    <th>Departure Time</th>
                    <td>{{ $booking->departure_time }}</td>
                </tr>
                <tr>
                    <th>Arrival Time</th>
                    <td>{{ $booking->arrival_time }}</td>
                </tr>
                <tr>
                    <th>Passengers</th>
                    <td>{{ $booking->no_of_passenger }}</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>₹{{ number_format($booking->amount, 2) }}</td>
                </tr>
            </table>
        </div>
        
        @if($passengerDetails->count() > 0)
        <div class="passenger-details">
            <h3>Passenger Details</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Fare</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($passengerDetails as $passenger)
                    <tr>
                        <td>{{ $passenger->title }} {{ $passenger->full_name }}</td>
                        <td>{{ $passenger->dob }}</td>
                        <td>{{ $passenger->gender }}</td>
                        <td>₹{{ number_format($passenger->fare, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        
        <div class="booking-details">
            <h3>Important Instructions</h3>
            <ul>
                <li>Please arrive at the ferry terminal at least 30 minutes before departure time.</li>
                <li>Carry a valid photo ID for verification.</li>
                <li>Keep this confirmation email for your records.</li>
                <li>In case of any queries, contact our customer support.</li>
            </ul>
        </div>
        
        <p>Thank you for choosing Andaman Ferry Booking. We wish you a pleasant journey!</p>
    </div>
    
    <div class="footer">
        <p>This is an automated email. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} Andaman Ferry Booking. All rights reserved.</p>
    </div>
</body>
</html>
