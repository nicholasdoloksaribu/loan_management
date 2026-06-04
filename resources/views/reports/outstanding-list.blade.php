@extends('layouts.navbar')

@section('title', 'Outstanding List Report')

@section('content')
    <h2>Outstanding List Report</h2>

    <form action="{{ route('reports.outstanding-list') }}" method="GET" class="row mb-3">
        <div class="col">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari customer..." value="{{ $search }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('reports.outstanding-list.pdf', request()->query()) }}" class="btn btn-danger">
    🖨️ Print PDF
</a>
            <a href="{{ route('reports.outstanding-list') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
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
                <td>{{ number_format($item->os_balance, 2) }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data outstanding</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection