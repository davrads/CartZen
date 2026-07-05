<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vendor Account Approved</title>
</head>
<body>

<h2>Congratulations {{ $vendor->owner_name }}!</h2>

<p>Your vendor application has been approved.</p>

<p><strong>Login URL:</strong></p>

<p>
    <a href="{{ url('/vendor/login') }}">
        {{ url('/vendor/login') }}
    </a>
</p>

<hr>

<p><strong>Email</strong></p>

<p>{{ $email }}</p>

<p><strong>Password</strong></p>

<p>{{ $password }}</p>

<hr>

<p>Please login and change your password immediately.</p>

<p>Thank you,<br>
CartZen Team</p>

</body>
</html>