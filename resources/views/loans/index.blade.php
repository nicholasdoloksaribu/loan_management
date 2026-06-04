@extends('layouts.navbar')




@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Loan List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Transaction Loan</h2>
    <a href="{{ route('loans.create') }}" class="btn btn-primary mb-3">+ Add Loan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Loan No</th>
                <th>Transaction Date</th>
                <th>Customer Name</th>
                <th>Loan Amount</th>
                <th>Previous Balance</th>
                <th>Total Loan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $i => $loan)
            <tr>
                <td>{{ $loan->id }}</td>
                <td>{{ $loan->transaction_date }}</td>
                
                <td>{{ $loan->customer_name }}</td>
                <td>{{ number_format($loan->loan_amount, 2) }}</td>
                <td>{{ number_format($loan->previous_balance, 2) }}</td>
                <td>{{ number_format($loan->total_loan, 2) }}</td>
                <td>
                    <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Belum ada data loan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
@endsection