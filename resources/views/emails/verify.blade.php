<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>

<body>
    <h2>Hello {{ $user->first_name }},</h2>
    <p>Thank you for registering! Please click the link below to verify your email address:</p>

    <p>
        <a href="{{ url('/verify-email/' . $token) }}">
            Verify Email Address
        </a>
    </p>

    <p>If you did not create an account, no further action is required.</p>

    <p>Best regards,<br>Your Application Team</p>
</body>

</html>
