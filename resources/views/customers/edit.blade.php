<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Customer</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>User ID</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $customer->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->id }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="customer_name" class="form-control"
                   value="{{ $customer->customer_name }}" required>
        </div>
        <div class="mb-3">
            <label>Birth Place</label>
            <input type="text" name="birth_place" class="form-control"
                   value="{{ $customer->birth_place }}" required>
        </div>
        <div class="mb-3">
            <label>Birth Date</label>
            <input type="date" name="birth_date" class="form-control"
                   value="{{ $customer->birth_date }}" required>
        </div>
        <div class="mb-3">
            <label>No Identity</label>
            <input type="text" name="no_identity" class="form-control"
                   value="{{ $customer->no_identity }}" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" rows="3" required>{{ $customer->address }}</textarea>
        </div>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>
</body>
</html>