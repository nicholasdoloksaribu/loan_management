<!DOCTYPE html>
<html>
<head>
    <title>Add Currency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Add Currency</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('currencies.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Currency ID</label>
            <input type="text" name="currency_id" class="form-control" 
                   placeholder="Contoh: IDR, USD, EUR" value="{{ old('currency_id') }}" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="currency_name" class="form-control" 
                   placeholder="Contoh: Rupiah, US Dollar" value="{{ old('name') }}" required>
        </div>
        
        <a href="{{ route('currencies.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
</body>
</html>