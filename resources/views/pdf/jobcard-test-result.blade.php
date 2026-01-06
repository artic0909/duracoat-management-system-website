<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Powder Coating Test Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            border: 2px solid #000;
        }

        .header-section {
            border-bottom: 2px solid #000;
            padding: 15px;
            text-align: center;
            position: relative;
        }

        .logo {
            position: absolute;
            left: 15px;
            top: 10px;
            width: 80px;
        }

        .company-name {
            font-size: 36px;
            font-weight: bold;
            margin: 0;
        }

        .company-name .dura {
            color: #e74c3c;
        }

        .company-name .coat {
            color: #27ae60;
        }

        .subtitle {
            font-size: 14px;
            font-weight: bold;
            margin-top: 5px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        .contact-bar {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            padding: 8px 15px;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
        }

        .report-title {
            border-bottom: 2px solid #000;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }

        .report-info {
            border-bottom: 2px solid #000;
            padding: 8px 15px;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
        }

        .certification-text {
            padding: 15px;
            font-size: 11px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px 10px;
            font-size: 11px;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        td {
            text-align: left;
        }

        .sl-no {
            text-align: center;
            width: 50px;
        }

        .footer-note {
            padding: 15px;
            font-size: 10px;
            border-top: 2px solid #000;
        }

        .address-section {
            border-top: 2px solid #000;
            padding: 10px 15px;
            font-size: 10px;
            text-align: center;
            line-height: 1.5;
        }

        .color-bar {
            height: 8px;
            display: flex;
        }

        .color-bar .red {
            flex: 1;
            background-color: #e74c3c;
        }

        .color-bar .green {
            flex: 1;
            background-color: #27ae60;
        }

        .highlight {
            background-color: #ffff99;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header with Logo and Company Name -->
        <div class="header-section">
            <h1 class="company-name">
                <span class="dura">DURA</span><span class="coat">COAT</span>
            </h1>
            <div class="subtitle">POWDER COATER</div>
        </div>

        <!-- Contact Bar -->
        <div class="contact-bar">
            <span><strong>Mobile No :</strong> +91 9088242431</span>
            <span><strong>E-Mail:</strong> duracoat40@gmail.com</span>
        </div>

        <!-- Report Title -->
        <div class="report-title">POWDER COATING TEST REPORT</div>

        <!-- Report Info -->
        <div class="report-info">
            <span><strong>Order No:</strong> {{ isset($test) ? $jobcard->order->order_number : '.......' }}</span>
            <span><strong>Job No:</strong> {{ isset($test) ? $jobcard->jobcard_number : '.......'}}</span>
            <span><strong>Date:</strong> {{ isset($test) ? \Carbon\Carbon::parse($test->test_date)->format('d/m/Y') : '.......' }}</span>
        </div>

        <!-- Certification Text -->
        <div class="certification-text">
            This is to Certified that <strong>M/S: {{ $jobcard->client->client_name ?? 'ABC COMPANY PVT LTD' }}, {{ $jobcard->client->address ?? '' }}</strong> Supplied us different <strong>M S Profile/Aluminium Profile</strong> For <strong>{{ $jobcard->min_micron ?? '' }}-{{ $jobcard->max_micron ?? '' }} Micron Powder coating, {{ $jobcard->paint->brand_name ?? '' }} - {{ $jobcard->paint->ral_code ?? $jobcard->ral_code }} - {{ $jobcard->paint->shade_name ?? '' }} - {{ $jobcard->paint->finish ?? '' }}</strong> and <strong>Tested</strong> by us ,that are confirm to the following specification:
        </div>

        <!-- Test Results Table -->
        <table>
            <thead>
                <tr>
                    <th class="sl-no">Sl. No</th>
                    <th>Properties</th>
                    <th>Specifications</th>
                    <th>Test Results</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1. Substrate -->
                <tr>
                    <td class="sl-no">1</td>
                    <td>Substrate</td>
                    <td>Aluminium Profile/M S Profile</td>
                    <td>{{ $testing[0]['test_value'] ?? '-' }}</td>
                    <td>{{ $testing[0]['test_result'] ?? '-' }}</td>
                </tr>

                <!-- 2. Dry film Thickness -->
                <tr>
                    <td class="sl-no">2</td>
                    <td>Dry film Thickness</td>
                    <td>{{ $jobcard->min_micron ?? 60 }}-{{ $jobcard->max_micron ?? 80 }} micron</td>
                    <td>{{ $testing[1]['test_value'] ?? '-' }} micron</td>
                    <td>{{ $testing[1]['test_result'] ?? '-' }}</td>
                </tr>

                <!-- 3. Baking Temperature -->
                <tr>
                    <td class="sl-no">3</td>
                    <td>Baking Temperature</td>
                    <td>200°C</td>
                    <td>{{ $testing[2]['test_value'] ?? '-' }} °C</td>
                    <td>{{ $testing[2]['test_result'] ?? '-' }}</td>
                </tr>

                <!-- 4. Baking Time -->
                <tr>
                    <td class="sl-no">4</td>
                    <td>Baking Time</td>
                    <td>10 Minutes</td>
                    <td>{{ $testing[3]['test_value'] ?? '-' }} Minutes</td>
                    <td>{{ $testing[3]['test_result'] ?? '-' }}</td>
                </tr>

                <!-- 5. Colour Uniformity Test -->
                <tr>
                    <td class="sl-no">5</td>
                    <td>Colouruniformity Test</td>
                    <td>Close to standard</td>
                    <td>{{ $testing[4]['test_value'] ?? '-' }}</td>
                    <td>{{ $testing[4]['test_result'] ?? '-' }}</td>
                </tr>

                <!-- 6. M E K Test -->
                <tr>
                    <td class="sl-no">6</td>
                    <td>M E K Test</td>
                    <td>Check the Curing ( 30 rubs)</td>
                    <td>
                        @if(($testing[5]['test_result'] ?? '') == 'No Peel off')
                            Pass ({{ $testing[5]['rubs_value'] ?? '-' }} rubs)
                        @else
                           {{ $testing[5]['test_result'] ?? '-' }}
                        @endif
                    </td>
                    <td>{{ $testing[5]['test_result'] ?? '-' }}</td>
                </tr>

                <!-- 7. Cross Hatch Test -->
                <tr>
                    <td class="sl-no">7</td>
                    <td>Cross Hatch Test</td>
                    <td>11 x 1mm Cross Cut</td>
                    <td>
                         @if(($testing[6]['test_result'] ?? '') == 'No Peel off')
                            Pass
                        @else
                           {{ $testing[6]['test_result'] ?? '-' }}
                        @endif
                    </td>
                    <td>{{ $testing[6]['test_result'] ?? '-' }}</td>
                </tr>

                <!-- 8. Conical Mandrel Test -->
                <tr>
                    <td class="sl-no">8</td>
                    <td>Conical Mandrel Test</td>
                    <td>Check Bonding</td>
                    <td>
                        @if(($testing[7]['test_result'] ?? '') == 'No Crack')
                            Pass
                        @else
                           {{ $testing[7]['test_result'] ?? '-' }}
                        @endif
                    </td>
                    <td>{{ $testing[7]['test_result'] ?? '-' }}</td>
                </tr>

                <!-- 9. Pencil Hardness Test -->
                <tr>
                    <td class="sl-no">9</td>
                    <td>Pencil Hardness Test</td>
                    <td>H Grade, No rupture on film</td>
                    <td>{{ $testing[8]['test_value'] ?? '-' }}</td>
                    <td>{{ $testing[8]['test_result'] ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Footer Note -->
        <div class="footer-note">
            The above tests have been carried out by M/s. Ranihati Construction Pvt Ltd. and constitute a quality control pass based
            <br><br>
            <em>*This is a computer generated Test certificate. No signature required</em>
        </div>

        <!-- Color Bar -->
        <div class="color-bar">
            <div class="red"></div>
            <div class="green"></div>
        </div>

        <!-- Address Section -->
        <div class="address-section">
            <strong>Factory:</strong> Sankrail Industrial Park, Dhulagori, Sankarail, Howrah, W.B-711302<br>
            <strong>Regd. Office:</strong> Shop No-13,M Plaza,Ranihati,Joynagar,Panchla,Howrah-711302 (WB)<br>
            <strong>Power By Ranihati Construction Pvt Ltd</strong>
        </div>
    </div>

</body>

</html>