<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Declarations Report</title>
</head>

<body style="font-family: Arial, sans-serif; padding: 20px; font-size: 14px;">

    <h2 style="text-align: center; margin-bottom: 20px;">Declarations Report</h2>

    <p><strong>Start Date:</strong> {{ $start_date }}</p>
    <p><strong>End Date:</strong> {{ $end_date }}</p>
    <p><strong>Printed On:</strong> {{ $printed_date }}</p>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px;">#</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Address</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Quantity</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Price</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Weight (kg)</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Status</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Shipment Via</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Tracking #</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Product</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Seller</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Declaration Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($declarations as $index => $declaration)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $declaration->address }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $declaration->quantity }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($declaration->price, 2) }} Rwf</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $declaration->weight }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ ucfirst($declaration->status) }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $declaration->shipment->ship_via ?? '-' }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $declaration->shipment->tracking_number ?? '-' }}
                </td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $declaration->shipment->sale->product->name ?? '-'
                    }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $declaration->shipment->sale->product->user->name
                    ?? '-' }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{
                    \Carbon\Carbon::parse($declaration->created_at)->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach

            @if($declarations->isEmpty())
            <tr>
                <td colspan="11" style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                    No declaration records available for the selected date range.
                </td>
            </tr>
            @endif
        </tbody>
    </table>

</body>

</html>