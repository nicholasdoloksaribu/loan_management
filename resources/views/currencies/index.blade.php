@extends('layouts.navbar')

@section('title', 'Currency List')


@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Currency List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Mastery Currency</h2>
    <a href="{{ route('currencies.create') }}" class="btn btn-primary mb-3">+ Add Currency</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                
                <th>Currency ID</th>
                <th>Currency Name</th>
                <th>Action</th>
              
            </tr>
        </thead>
        <tbody>
            @forelse($currencies as $i => $currency)
            <tr>
            
                <td>{{ $currency->currency_id }}</td>
                <td>{{ $currency->currency_name }}</td>
                <td>
                    <a href="{{ route('currencies.edit', $currency->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('currencies.destroy', $currency->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data currency</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
@endsection