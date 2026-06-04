<!DOCTYPE html>
<html>
<head>
    <title>Payment List Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #343a40; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h2>Payment List Report</h2>
    <p>Tanggal cetak: {{ date('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Transaction Date</th>
                <th>Loan ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Currency</th>
                <th>Paid Amount</th>
                <th>O/S Balance</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $i => $payment)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $payment->transaction_date }}</td>
                <td>{{ $payment->loan_id }}</td>
                <td>{{ $payment->customer_id }}</td>
                <td>{{ $payment->customer_name }}</td>
                <td>{{ $payment->currency_id }}</td>
                <td class="text-right">{{ number_format($payment->paid_amount, 2) }}</td>
                <td class="text-right">{{ number_format($payment->os_balance, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>