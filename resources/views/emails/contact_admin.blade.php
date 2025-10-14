<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f8f9fa; padding:20px;">
    <div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:8px;">
        <h2 style="color:#007BFF;">New Contact Message</h2>
        <p>You’ve received a new message via the contact form:</p>

        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        @if(!empty($data['phone']))
            <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
        @endif
        <p><strong>Message:</strong></p>
        <p>{{ $data['message'] }}</p>

        <p style="margin-top:20px;">--<br>Pure Aqua Tech Website</p>
    </div>
</body>
</html>
