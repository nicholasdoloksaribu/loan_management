<!DOCTYPE html>
<html>
<head>
    <title>Loan List Report</title>
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
    <h2>Loan List Report</h2>
    <p>Tanggal cetak: {{ date('d/m/Y H:i') }}</p>
    <p>Di print oleh {{ auth('admin')->user()->name }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Transaction Date</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Currency</th>
                <th>Loan Amount</th>
                <th>Previous Balance</th>
                <th>Total Loan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $i => $loan)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $loan->transaction_date }}</td>
                <td>{{ $loan->customer_id }}</td>
                <td>{{ $loan->customer_name }}</td>
                <td>{{ $loan->currency_id }}</td>
                <td class="text-right">{{ number_format($loan->loan_amount, 2) }}</td>
                <td class="text-right">{{ number_format($loan->previous_balance, 2) }}</td>
                <td class="text-right">{{ number_format($loan->total_loan, 2) }}</td>
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