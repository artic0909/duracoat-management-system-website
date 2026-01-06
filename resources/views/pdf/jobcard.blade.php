<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Job Card</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .jobcard-container {
            width: 100%;
            border: 2px solid #000;
            background-color: #d9ecfa;
            padding: 10px 15px;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header h2 {
            font-size: 20px;
            margin: 0;
            font-weight: bold;
        }

        .header .order-info {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        td {
            border: 1px dashed #000;
            padding: 6px;
            vertical-align: top;
        }

        .title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin: 8px 0;
        }

        .title span.red {
            color: red;
        }

        .title span.green {
            color: green;
        }

        .field-label {
            font-weight: bold;
            color: #000;
        }

        .signature-box {
            height: 25px;
        }

        .center-text {
            text-align: center;
        }

        .no-border td {
            border: none !important;
        }
    </style>
</head>

<body>
    <div class="jobcard-container">
        <div class="header">
            <div><span class="field-label">Date:</span> {{ \Carbon\Carbon::parse($jobcard->jobcard_creation_date)->format('d/m/Y') }}</div>
            <div class="order-info">Order no.: {{ $jobcard->order->order_number }}</div>
        </div>

        <div class="title">
            <span class="red">DURA</span> <span class="green">COAT</span> Powder Coater
        </div>

        <table>
            <tr>
                <td colspan="2">
                    <strong>
                        Job Card no.: {{ $jobcard->jobcard_number }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </strong>
                    MS
                    <span style="display:inline-block; width:15px; text-align:center; border:1px solid #000;">
                        @if(isset($jobcard->material_type) && strtoupper($jobcard->material_type) === 'MS') ✔️ @endif
                    </span>
                    &nbsp;&nbsp;/&nbsp;&nbsp;
                    ALU
                    <span style="display:inline-block; width:15px; text-align:center; border:1px solid #000;">
                        @if(isset($jobcard->material_type) && strtoupper($jobcard->material_type) === 'ALU') ✔️ @endif
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="2"><strong>Party Details</strong><br><br>{{ $jobcard->client->client_name }} / {{ $jobcard->client->email }} / {{ $jobcard->client->mobile }}</td>
            </tr>

            <tr>
                <td colspan="2">
                    <strong>Product short description</strong><br><br>
                    Item: {{ $jobcard->material_name }} / Qty: {{ $jobcard->material_quantity }} {{ $jobcard->material_unit }}
                    <br><br>
                    <strong>
                        Required Micron: {{ $jobcard->min_micron }} - {{ $jobcard->max_micron }} micron
                    </strong>
                </td>
            </tr>

            <tr>
                <td><strong>Pretreatment Date</strong><br><br>{{ \Carbon\Carbon::parse($jobcard->pre_treatment_date)->format('d/m/Y') }}</td>
                <td><strong>Supervisor Signature</strong><br>
                    <div class="signature-box"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <strong>Powder Name/ RAL Code</strong><br><br>
                    {{ $jobcard->paint->brand_name ?? '' }} - {{ $jobcard->paint->ral_code ?? $jobcard->ral_code }} - {{ $jobcard->paint->shade_name ?? '' }} - {{ $jobcard->paint->finish ?? '' }}
                </td>
                <td><strong>Used Powder</strong><br><br>{{ $jobcard->paint_used }} KG</td>
            </tr>
            <!-- 
            <tr>
                <td><strong>Micron</strong><br><br></td>
                <td><strong>QC Sign</strong><br><div class="signature-box"></div></td>
            </tr> -->

            <tr>
                <td><strong>Powder Apply Date</strong><br><br>{{ \Carbon\Carbon::parse($jobcard->powder_apply_date)->format('d/m/Y') }}</td>
                <td><strong>Mistree Signature</strong><br>
                    <div class="signature-box"></div>
                </td>
            </tr>

            <tr>
                <td><strong>Job Card Prepared By</strong><br><br></td>
                <td><strong>Material Delivery Date</strong><br><br>
                    @if(isset($jobcard->delivery_date))
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($jobcard->delivery_date)->format('d/m/Y') }}<br>
                    @endif

                    @if(!empty($jobcard->invoice))
                        <strong>Invoice No:</strong> {{ $jobcard->invoice }}<br>
                    @endif

                    @if(!empty($jobcard->delivery_statement))
                        <strong>Note:</strong> {!! nl2br(e($jobcard->delivery_statement)) !!}
                    @endif
                </td>
            </tr>
        </table>
    </div>
</body>

</html>