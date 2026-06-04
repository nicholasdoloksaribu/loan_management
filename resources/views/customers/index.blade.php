@extends('layouts.navbar')

@section('title', 'Currency List')


@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Master Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Customer List</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">+ Add Customer</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                
                <th>User ID</th>
                <th>Name User</th>
                <th>Birth Place / Date</th>
                <th>Address</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $i => $customer)
            <tr>
                <td>{{ $customer->user->id }}</td>
                <td>{{ $customer->customer_name }}</td>
                <td>{{ $customer->birth_place . " " . $customer->birth_date}}</td>
                <td>{{ $customer->address }}</td>
                <td>
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data customer</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
@endsection