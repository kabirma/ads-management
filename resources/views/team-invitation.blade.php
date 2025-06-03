<!DOCTYPE html>
<html>

<head>
    <title>Team Invitation</title>
</head>

<body>
    <h2>Hello!</h2>
    <p>You’ve been invited to join our team on {{ config('app.name') }}.</p>
    <p>Please click the link below to accept the invitation:</p>
    <a href="{{ url('/register') }}">Join Now</a>
</body>

</html>
