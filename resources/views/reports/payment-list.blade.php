@extends('layouts.navbar')

@section('title', 'Payment List Report')

@section('content')
    <h2>Payment List Report</h2>

    <form action="{{ route('reports.payment-list') }}" method="GET" class="row mb-3">
        <div class="col">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari customer / currency..." value="{{ $search }}">
        </div>
        <div class="col">
            <input type="date" name="date_from" class="form-control" value="{{ $dateFrom }}">
        </div>
        <div class="col">
            <input type="date" name="date_to" class="form-control" value="{{ $dateTo }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('reports.payment-list.pdf', request()->query()) }}" class="btn btn-danger">
    🖨️ Print PDF
</a>
            <a href="{{ route('reports.payment-list') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
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
                <td>{{ number_format($payment->paid_amount, 2) }}</td>
                <td>{{ number_format($payment->os_balance, 2) }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection