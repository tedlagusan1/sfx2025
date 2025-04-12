<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }

        .container {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Hello {{ $user->first_name }},</h2>
        <p>Thank you for registering! To complete your registration, please verify your email address by clicking the
            button below:</p>

        <a href="{{ url('/verify-email/' . $token) }}" class="button">
            Verify Email Address
        </a>

        <p>After verification, you will be able to log in to your account.</p>

        <p>If you did not create an account, please ignore this email.</p>

        <p>Best regards,<br>Your Application Team</p>
    </div>
</body>

</html>
