@extends('layouts.navbar')

@section('title', 'Loan List Report')

@section('content')
    <h2>Loan List Report</h2>

    <form action="{{ route('reports.loan-list') }}" method="GET" class="row mb-3">
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
            <a href="{{ route('reports.loan-list.pdf', request()->query()) }}" class="btn btn-danger">
    🖨️ Print PDF
</a>
            <a href="{{ route('reports.loan-list') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
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
                <td>{{ number_format($loan->loan_amount, 2) }}</td>
                <td>{{ number_format($loan->previous_balance, 2) }}</td>
                <td>{{ number_format($loan->total_loan, 2) }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection