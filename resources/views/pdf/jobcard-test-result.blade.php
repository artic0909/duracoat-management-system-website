<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>QC Test Result - {{ $jobcard->jobcard_number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        .header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #444;
        }

        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            color: #fff;
            font-size: 12px;
        }

        .bg-success {
            background-color: #28a745;
        }

        .bg-danger {
            background-color: #dc3545;
        }

        .bg-warning {
            background-color: #ffc107;
            color: #000;
        }

        .bg-secondary {
            background-color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="header">DURA COAT - QC TEST RESULT</div>
    <p><strong>Order No:</strong> {{ $jobcard->order->order_number }}</p>
    <p><strong>Jobcard No:</strong> {{ $jobcard->jobcard_number }}</p>
    <p><strong>Client Details:</strong></p>
    <p><strong>Name:</strong> {{ $jobcard->client->client_name }}</p>
    <p><strong>Email:</strong> {{ $jobcard->client->email }}</p>
    <p><strong>Mobile:</strong> {{ $jobcard->client->mobile }}</p>
    <br>
    <p><strong>Test Date:</strong> {{ \Carbon\Carbon::parse($test->test_date)->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Test Name</th>
                <th>Observation</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testing as $index => $item)
            @php
            $result = strtoupper($item['test_result'] ?? 'N/A');
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    {{ $item['test_name'] ?? '-' }}
                    @if(isset($item['gloss_type']) && $item['gloss_type'])
                    <span>({{ $item['gloss_type'] }})</span>
                    @endif
                </td>
                <td>{{ $item['test_value'] ?? '-' }}</td>
                <td>{{ $result }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

</body>

</html>