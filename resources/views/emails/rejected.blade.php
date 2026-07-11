<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

<h2>Vendor Application Update</h2>

<p>Hello,</p>

<p>
Thank you for applying to become a vendor on <strong>CartZen</strong>.
</p>

<p>
Unfortunately, after reviewing your application for
<strong>{{ $shopName }}</strong>,
we're unable to approve it at this time.
</p>

@if($remarks)
<p>
<strong>Reason:</strong><br>
{{ $remarks }}
</p>
@endif

<p>
You may update your information and submit another application in the future.
</p>

<p>
Regards,<br>
CartZen Team
</p>

</body>
</html>