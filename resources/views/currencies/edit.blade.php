<!DOCTYPE html>
<html>
<head>
    <title>Edit Currency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Currency</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('currencies.update', $currency->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Currency ID</label>
            <input type="text" name="currency_id" class="form-control" 
                   value="{{ $currency->currency_id }}" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="currency_name" class="form-control" 
                   value="{{ $currency->currency_name }}" required>
        </div>
       
        <a href="{{ route('currencies.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>
</body>
</html>