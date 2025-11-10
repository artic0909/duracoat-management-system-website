<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Powder Application Delay Alert</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">
    <table width="600" align="center" cellpadding="0" cellspacing="0" style="background-color: #fff; border-radius: 8px; padding: 20px;">
        <tr>
            <td>
                <h2 style="color: #d9534f;">⚠️ Powder Application Delay Alert</h2>
                <!-- <p style="font-size: 15px; color: #333;">
                    Hello Admin,<br><br>
                    This is to notify you that the following Jobcard has been delayed for <strong style="color: red;">{{ $diffDays }} days</strong>
                    since the pre-treatment was completed, and powder application has not yet been marked.
                </p> -->

                <p style="font-size: 15px; color: #333;">
                    I am <strong>{{ $jobcard->order->client->client_name ?? 'N/A' }},</strong> my material was pre-treated on <strong>{{ \Carbon\Carbon::parse($jobcard->pre_treatment_date)->format('d-m-Y') }}</strong>.
                    The powder coating is still pending and has been delayed by about
                    <strong style="color: red;">{{ $diffDays }} days</strong>.
                </p>



                <h4 style="color: #17a2b8; margin-top: 20px;">📋 Jobcard Details</h4>
                <table width="100%" border="1" cellspacing="0" cellpadding="6" style="border-collapse: collapse; border-color: #ddd;">
                    <tr>
                        <td><strong>Jobcard Number:</strong></td>
                        <td>{{ $jobcard->jobcard_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Order Number:</strong></td>
                        <td>{{ $jobcard->order->order_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Party Name:</strong></td>
                        <td>{{ $jobcard->order->client->client_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Party Email:</strong></td>
                        <td>{{ $jobcard->order->client->email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Party Mobile:</strong></td>
                        <td>{{ $jobcard->order->client->mobile ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <td><strong>Pre-Treatment Date:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($jobcard->pre_treatment_date)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Current Status:</strong></td>
                        <td style="text-transform: capitalize;">{{ $jobcard->jobcard_status }}</td>
                    </tr>
                    <tr>
                        <td><strong>Days Delayed:</strong></td>
                        <td style="color: #d9534f; font-weight: bold;">{{ $diffDays }} Days</td>
                    </tr>
                </table>

                <p style="margin-top: 25px; color: #333;">
                    Please take necessary action to ensure the powder application process is completed.
                </p>

                <p style="font-size: 13px; color: #777;">
                    This is an automated alert from the Duracoat Management System - <a href="http://www.duracoat.co.in/">Duracoat</a>.
                </p>
            </td>
        </tr>
    </table>
</body>

</html>