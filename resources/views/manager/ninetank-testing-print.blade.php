<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>9-Tank Test Report — {{ \Carbon\Carbon::parse($record->testing_date)->format('d/m/Y') }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 12px;
            color: #1a1a2e;
            padding: 30px;
        }

        h1 {
            font-size: 18px;
            font-weight: 800;
            color: #1e3a8a;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .subtitle {
            font-size: 11px;
            color: #5e6e9a;
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            gap: 30px;
            margin-bottom: 20px;
        }

        .info-box {
            background: #f4f6fb;
            border: 1px solid #dde3f0;
            border-radius: 8px;
            padding: 10px 16px;
        }

        .info-box label {
            font-size: 10px;
            font-weight: 700;
            color: #8896bb;
            text-transform: uppercase;
            display: block;
            margin-bottom: 2px;
        }

        .info-box span {
            font-size: 13px;
            font-weight: 700;
            color: #232b4e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead tr {
            background: #1e3a8a;
            color: #fff;
        }

        thead th {
            padding: 8px 10px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background: #f4f6fb;
        }

        tbody td {
            padding: 8px 10px;
            border-bottom: 1px solid #eaedf5;
            font-size: 11px;
        }

        .tank-label {
            font-weight: 700;
            color: #1e3a8a;
        }

        .badge-pass {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 10px;
            border: 1px solid #6ee7b7;
        }

        .badge-failed {
            display: inline-block;
            background: #fee2e2;
            color: #991b1b;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 10px;
            border: 1px solid #fca5a5;
        }

        .need-ok {
            color: #065f46;
            font-weight: 700;
        }

        .need-high {
            color: #991b1b;
            font-weight: 700;
        }

        .need-low {
            color: #854d0e;
            font-weight: 700;
        }

        .need-warn {
            color: #b45309;
            font-weight: 700;
        }

        .footer-note {
            margin-top: 20px;
            font-size: 10px;
            color: #8896bb;
            text-align: center;
            border-top: 1px solid #eaedf5;
            padding-top: 10px;
        }

        @media print {
            body {
                padding: 10mm;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <h1><i>&#x1F9EA;</i> DURACOAT — 9 Tank Chemical Pre-Treatment Test Report</h1>
    <p class="subtitle">Printed on {{ now()->format('d/m/Y H:i') }}</p>

    <div class="info-row">
        <div class="info-box">
            <label>Testing Date</label>
            <span>{{ \Carbon\Carbon::parse($record->testing_date)->format('d M Y') }}</span>
        </div>
        <div class="info-box">
            <label>Record ID</label>
            <span>#{{ $record->id }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tank</th>
                <th>Chemical</th>
                <th>Testing Value</th>
                <th>Result</th>
                <th>Need Chemical / Attention</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tanks = [
                    ['label' => 'Tank 1', 'chem' => 'Apdeg-60', 'val' => $record->t1_testing_value . ' ml', 'res' => $record->t1_result, 'need' => $record->t1_need_chemical],
                    ['label' => 'Tank 2', 'chem' => 'Water', 'val' => $record->t2_testing_value . ' ph', 'res' => $record->t2_result, 'need' => $record->t2_need_attention],
                    ['label' => 'Tank 3', 'chem' => 'Aprust-21', 'val' => $record->t3_testing_value . ' ml', 'res' => $record->t3_result, 'need' => $record->t3_need_chemical],
                    ['label' => 'Tank 4', 'chem' => 'Water', 'val' => $record->t4_testing_value . ' ph', 'res' => $record->t4_result, 'need' => $record->t4_need_attention],
                    ['label' => 'Tank 5', 'chem' => 'S-101', 'val' => $record->t5_testing_value . ' ph', 'res' => $record->t5_result, 'need' => $record->t5_need_attention],
                    ['label' => 'Tank 6', 'chem' => 'Act-505', 'val' => $record->t6_testing_value . ' ph', 'res' => $record->t6_result, 'need' => $record->t6_need_attention],
                    ['label' => 'Tank 7', 'chem' => 'Aphox-ZC', 'val' => $record->t7_testing_value . ' ml' . ($record->t7_need_level ? ' | Need: ' . $record->t7_need_level . ' ml' : ''), 'res' => $record->t7_result, 'need' => $record->t7_need_chemical],
                    ['label' => 'Tank 8', 'chem' => 'Water', 'val' => $record->t8_testing_value . ' ph', 'res' => $record->t8_result, 'need' => $record->t8_need_attention],
                    ['label' => 'Tank 9', 'chem' => 'Passeal-1', 'val' => $record->t9_testing_value . ' ph', 'res' => $record->t9_result, 'need' => $record->t9_need_attention],
                ];
                $nc = function ($v) {
                    $l = strtolower($v ?? '');
                    if ($l === 'pass' || str_contains($l, 'no need'))
                        return 'need-ok';
                    if ($l === 'high')
                        return 'need-high';
                    if ($l === 'low')
                        return 'need-low';
                    return 'need-warn';
                };
            @endphp
            @foreach($tanks as $t)
                <tr>
                    <td class="tank-label">{{ $t['label'] }}</td>
                    <td>{{ $t['chem'] }}</td>
                    <td><strong>{{ $t['val'] }}</strong></td>
                    <td>
                        <span class="{{ strtolower($t['res'] ?? '') === 'pass' ? 'badge-pass' : 'badge-failed' }}">
                            {{ $t['res'] ?? '—' }}
                        </span>
                    </td>
                    <td><span class="{{ $nc($t['need']) }}">{{ $t['need'] ?? '—' }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="footer-note">Duracoat Management System &bull; 9-Tank Chemical Pre-Treatment Testing Module</p>

    <script>window.onload = function () { window.print(); };</script>
</body>

</html>