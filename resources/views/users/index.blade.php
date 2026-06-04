@extends('layouts.navbar')



@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Master User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Master User</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">+ Add User</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>User ID</th>
                <th>Name User</th>
                <th>Birth Place / Date</th>
                <th>No Identity</th>
                <th>Address</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $i => $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->birth_place . " " . $user->birth_date}}</td>
                <td>{{ $user->no_identity }}</td>
                <td>{{ $user->address }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data user</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
@endsection