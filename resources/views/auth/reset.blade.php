<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Your Password</h1>
    <p>Hi,</p>
    <p>You requested to reset your password. Click the button below to reset it:</p>
    <a href="{{ $resetUrl }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Reset Password</a>
    <p>If you did not request this, please ignore this email.</p>
    <p>Thanks, <br> {{ config('app.name') }}</p>
</body>
</html>
