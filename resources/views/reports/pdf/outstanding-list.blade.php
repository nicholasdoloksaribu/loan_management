<!DOCTYPE html>
<html>
<head>
    <title>Outstanding List Report</title>
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
    <h2>Outstanding List Report</h2>
    <p>Tanggal cetak: {{ date('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Currency</th>
                <th>Last Transaction</th>
                <th>O/S Balance</th>
            </tr>
        </thead>
        <tbody>
            @forelse($outstanding as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->customer_id }}</td>
                <td>{{ $item->customer_name }}</td>
                <td>{{ $item->currency_id }}</td>
                <td>{{ $item->last_date }}</td>
                <td class="text-right">{{ number_format($item->os_balance, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>