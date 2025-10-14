<!DOCTYPE html>
<html>
<head>
    <title>Saved Emails - Localhost Testing</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Saved Emails (Localhost Testing)</h1>
    <p>These are emails that would have been sent in production but are saved to files for localhost testing.</p>
    
    <table>
        <thead>
            <tr>
                <th>Filename</th>
                <th>Size</th>
                <th>Modified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emails as $email)
            <tr>
                <td>{{ $email['filename'] }}</td>
                <td>{{ number_format($email['size']) }} bytes</td>
                <td>{{ $email['modified'] }}</td>
                <td><a href="{{ $email['url'] }}" target="_blank">View Email</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <p><a href="/send-latest-booking-email">Send Latest Booking Email</a> | <a href="/debug-email/1085">Debug Booking 1085</a></p>
</body>
</html>
