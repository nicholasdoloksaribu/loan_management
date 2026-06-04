<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Add User</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" 
                   value="{{ old('username') }}" required>
        </div>
        <div class="mb-3">
            <label>Birth Place</label>
            <input type="text" name="birth_place" class="form-control" 
                   value="{{ old('birth_place') }}" required>
        </div>
        <div class="mb-3">
            <label>Birth Date</label>
            <input type="date" name="birth_date" class="form-control" 
                   value="{{ old('birth_date') }}" required>
        </div>
        <div class="mb-3">
            <label>No Identity</label>
            <input type="text" name="no_identity" class="form-control" 
                   value="{{ old('no_identity') }}" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>