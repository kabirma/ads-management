<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px;">
        <h2>Hello, {{ $username }} 👋</h2>
        <p>Thank you for signing up. Please click the button below to verify your email address:</p>

        <p style="text-align: center;">
            <a href="{{ $verificationUrl }}" style="background-color: #4CAF50; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px;">
                Verify Email
            </a>
        </p>

        <p>If you didn't create an account, no further action is required.</p>

        <p>Thanks,<br>The Team</p>
    </div>
</body>
</html>
