<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Vendor Application Approved</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; background:#f5f5f5; margin:0; padding:40px;">

    <table width="600" align="center" cellpadding="0" cellspacing="0"
        style="background:#ffffff; border-radius:10px; overflow:hidden;">

        <tr>
            <td style="background:#6d28d9; color:white; padding:25px; text-align:center;">
                <h1 style="margin:0;">🎉 Congratulations!</h1>
                <p style="margin-top:8px;">
                    Your Vendor Application has been Approved
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding:35px;">

                <p>Hello,</p>

                <p>
                    We're pleased to inform you that your application for
                    <strong>{{ $shopName }}</strong>
                    has been approved by the CartZen Team.
                </p>

                <h3>Vendor Login Credentials</h3>

                <table cellpadding="8" cellspacing="0" width="100%"
                    style="border:1px solid #ddd; border-collapse:collapse;">

                    <tr>
                        <td style="background:#f3f4f6;"><strong>Login URL</strong></td>
                        <td>
                            <a href="{{ url('/vendor/login') }}">
                                {{ url('/vendor/login') }}
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#f3f4f6;"><strong>Email</strong></td>
                        <td>{{ $email }}</td>
                    </tr>

                    <tr>
                        <td style="background:#f3f4f6;"><strong>Temporary Password</strong></td>
                        <td>{{ $password }}</td>
                    </tr>

                </table>

                <br>

                <p>
                    For security reasons, please log in and change your password
                    immediately after your first login.
                </p>

                <div style="text-align:center; margin-top:30px;">

                    <a href="{{ url('/vendor/login') }}"
                        style="
                            background:#6d28d9;
                            color:white;
                            text-decoration:none;
                            padding:14px 28px;
                            border-radius:6px;
                            display:inline-block;
                        ">
                        Login to Vendor Dashboard
                    </a>

                </div>

                <br><br>

                <p>
                    We look forward to seeing your products on CartZen.
                </p>

                <p>
                    Regards,<br>
                    <strong>CartZen Team</strong>
                </p>

            </td>
        </tr>

    </table>

</body>

</html>