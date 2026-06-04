@extends('layouts.navbar')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Payment List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Transaction Payment</h2>
    <a href="{{ route('payments.create') }}" class="btn btn-primary mb-3">+ Add Payment</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
              
                <th>Date</th>
                <th>Paid Amount</th>
                <th>O/S Balance</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $i => $payment)
            <tr>
              
                <td>{{ $payment->transaction_date }}</td>
                <td>{{ number_format($payment->paid_amount, 2) }}</td>
                <td>{{ number_format($payment->os_balance, 2) }}</td>
                <td>
                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada data payment</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
@endsection