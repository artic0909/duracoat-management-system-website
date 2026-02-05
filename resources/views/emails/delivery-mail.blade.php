<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Delivery Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">
    <table width="700" align="center" cellpadding="0" cellspacing="0" style="background-color: #fff; border-radius: 6px; padding: 20px; border:1px solid #e0e0e0;">
        <tr>
            <td>
                <h2 style="color:#28a745;">✅ Jobcard Delivery Notification</h2>

                <p style="font-size:14px; color:#333;">
                    This is an automated notification regarding the delivery status of a Jobcard.
                </p>

                <h4 style="color:#17a2b8; margin-top:12px;">📋 Jobcard Details</h4>
                <table width="100%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; border-color: #ddd;">
                    <tr>
                        <td style="width:35%"><strong>Jobcard Number:</strong></td>
                        <td>{{ $jobcard->jobcard_number ?? 'N/A' }}</td>
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
                        <td><strong>Material:</strong></td>
                        <td>
                            {{-- example: show first material summary if available --}}
                            @php
                                $materials = $jobcard->order->client->material_details ?? null;
                                // If material_details stored as JSON string, attempt decode:
                                if (is_string($materials)) {
                                    $materials = json_decode($materials, true);
                                }
                            @endphp

                            @if(!empty($materials) && is_array($materials))
                                {{ $materials[0]['material_name'] ?? 'N/A' }} — Qty: {{ $materials[0]['quantity'] ?? 'N/A' }} {{ $materials[0]['unit'] ?? '' }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>

                    @if($jobcard->jobcard_status === 'delivered')
                    <tr>
                        <td><strong>Tax Invoice:</strong></td>
                        <td style="text-transform: capitalize;">{{ $jobcard->invoice ?? 'N/A' }}</td>
                    </tr>
                    @endif

                    <tr>
                        <td><strong>Current Status:</strong></td>
                        <td style="text-transform: capitalize;">{{ $jobcard->jobcard_status ?? 'N/A' }}</td>
                    </tr>

                    {{-- Delivery Statement Details --}}
                    @if(isset($mailData['billing_amount']) && isset($mailData['qty']))
                        <tr>
                            <td colspan="2" style="background-color: #f8f9fa; padding: 10px; font-weight: bold; color: #17a2b8;">
                                🚚 Delivery Statement Details
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Order Quantity Amount:</strong></td>
                            <td>{{ $jobcard->order->amount ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Delivery Date:</strong></td>
                            <td>{{ \Carbon\Carbon::parse($mailData['date'])->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Quantity Delivered:</strong></td>
                            <td>{{ $mailData['qty'] }} {{ $jobcard->material_unit ?? '' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Invoice No:</strong></td>
                            <td>{{ $mailData['invoice_no'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Billing Amount:</strong></td>
                            <td>{{ number_format($mailData['billing_amount'], 2) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Billing Amount (Order):</strong></td>
                            <td><strong>{{ number_format($mailData['total_billing_amount'] ?? 0, 2) }}</strong></td>
                        </tr>
                    @else
                        {{-- Fallback logic for basic delivery notification if any --}}
                        @if(!empty($jobcard->delivery_date))
                            <tr>
                                <td><strong>Delivery Date:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($jobcard->delivery_date)->format('d-m-Y') }}</td>
                            </tr>
                        @endif
                        
                        @if(!empty($jobcard->delivery_statement))
                        <tr>
                            <td><strong>Delivery Statement:</strong></td>
                            <td style="white-space: pre-line;">
                                {!! nl2br(e($jobcard->delivery_statement)) !!}
                            </td>
                        </tr>
                        @endif
                    @endif
                </table>

                <p style="margin-top:18px; color:#333;">
                    If you have any questions, please reply to this email.
                </p>

                <p style="font-size:12px; color:#777;">
                    This is an automated message from the Duracoat Management System.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
