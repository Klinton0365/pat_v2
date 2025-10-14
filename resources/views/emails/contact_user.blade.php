<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank You for Contacting Us</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; margin: 0; padding: 20px;">
    <div style="max-width:600px; background:white; margin:auto; border-radius:10px; padding:30px; box-shadow:0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color:#007BFF; text-align:center;">Thank You, {{ $data['name'] }}!</h2>
        <p style="font-size:16px; color:#333;">
            We’ve received your message and our support team will get back to you soon.
        </p>

        <h4 style="color:#555;">Here’s a copy of your message:</h4>
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        @if(!empty($data['phone']))
            <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
        @endif
        <p><strong>Message:</strong></p>
        <blockquote style="background:#f8f9fa; padding:15px; border-left:4px solid #007BFF; color:#555;">
            {{ $data['message'] }}
        </blockquote>

        <p style="font-size:15px; color:#333;">
            Warm regards,<br>
            <strong>Pure Aqua Tech Support Team</strong><br>
            <a href="https://pureaquatech.com" style="color:#007BFF; text-decoration:none;">pureaquatech.com</a>
        </p>
    </div>
</body>
</html>
