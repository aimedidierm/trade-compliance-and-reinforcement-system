<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
</head>

<body style="font-family: Arial, sans-serif; padding: 20px; font-size: 14px;">

    <h2 style="text-align: center; margin-bottom: 20px;">Sales Report</h2>

    <p><strong>Start Date:</strong> {{ $start_date }}</p>
    <p><strong>End Date:</strong> {{ $end_date }}</p>
    <p><strong>Printed On:</strong> {{ $printed_date }}</p>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px;">#</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Sale Name</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Status</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Product</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Description</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Price</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Seller</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Invoice</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Sale Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $index => $sale)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $sale->name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ ucfirst($sale->status) }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $sale->product->name ?? '-' }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $sale->product->description ?? '-' }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($sale->product->price ?? 0, 2) }} Rwf
                </td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $sale->product->user->name ?? '-' }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $sale->product->invoice ?? '-' }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{
                    \Carbon\Carbon::parse($sale->created_at)->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach

            @if($sales->isEmpty())
            <tr>
                <td colspan="9" style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                    No sales data available for the selected period.
                </td>
            </tr>
            @endif
        </tbody>
    </table>

</body>

</html>