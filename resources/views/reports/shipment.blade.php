<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shipment Report</title>
</head>

<body style="font-family: Arial, sans-serif; padding: 20px; font-size: 14px;">

    <h2 style="text-align: center; margin-bottom: 20px;">Shipment Report</h2>

    <p><strong>Start Date:</strong> {{ $start_date }}</p>
    <p><strong>End Date:</strong> {{ $end_date }}</p>
    <p><strong>Printed On:</strong> {{ $printed_date }}</p>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px;">#</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Packaging #</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Courier</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Ship Via</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Tracking #</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Address</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Shipment Date</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Status</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Product</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Price</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Seller</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Sale Ref</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shipments as $index => $shipment)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $shipment->packaging_number }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $shipment->currier }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $shipment->ship_via }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $shipment->tracking_number }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $shipment->address }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{
                    \Carbon\Carbon::parse($shipment->date)->format('Y-m-d') }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ ucfirst($shipment->status) }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $shipment->sale->product->name ?? '-' }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($shipment->sale->product->price ??
                    0, 2) }} rwf</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $shipment->sale->product->user->name ?? '-' }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $shipment->sale->name ?? '-' }}</td>
            </tr>
            @endforeach

            @if($shipments->isEmpty())
            <tr>
                <td colspan="12" style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                    No shipment records found for this date range.
                </td>
            </tr>
            @endif
        </tbody>
    </table>

</body>

</html>