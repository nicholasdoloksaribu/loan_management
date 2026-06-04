<!DOCTYPE html>
<html>
<head>
    <title>Edit Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Payment</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Transaction Date</label>
            <input type="date" name="transaction_date" class="form-control"
                   value="{{ $payment->transaction_date }}" required>
        </div>

        <div class="mb-3">
            <label>Loan No</label>
            <select name="loan_id" id="loan_id" class="form-control" required>
                @foreach($loans as $loan)
                    <option value="{{ $loan->id }}" {{ $payment->loan_id == $loan->id ? 'selected' : '' }}>
                        {{ $loan->id }} 
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Customer ID</label>
            <input type="text" id="customer_id" class="form-control bg-light"
                   readonly value="{{ $payment->customer_id }}">
        </div>

        <div class="mb-3">
            <label>Customer Name</label>
            <input type="text" id="customer_name" class="form-control bg-light"
                   readonly value="{{ $payment->customer_name }}">
        </div>

        <div class="mb-3">
            <label>Currency</label>
            <input type="text" id="currency_id" class="form-control bg-light"
                   readonly value="{{ $payment->currency_id }}">
        </div>

        <div class="mb-3">
            <label>Currency Name</label>
            <input type="text" id="currency_name" class="form-control bg-light"
                   readonly value="{{ $payment->currency_name }}">
        </div>

        <div class="mb-3">
            <label>O/S Balance</label>
            <input type="text" id="os_balance_display" class="form-control bg-light"
                   readonly value="{{ $payment->os_balance }}">
        </div>

        <div class="mb-3">
            <label>Paid Amount</label>
            <input type="number" name="paid_amount" id="paid_amount"
                   class="form-control" value="{{ $payment->paid_amount }}" required>
        </div>

        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>

<script>
    document.getElementById('loan_id').addEventListener('change', function() {
        const id = this.value;
        if (!id) return;
        fetch(`/api/loans/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('customer_id').value = data.customer_id;
                document.getElementById('customer_name').value = data.customer_name;
                document.getElementById('currency_id').value = data.currency_id;
                document.getElementById('currency_name').value = data.currency_name;
                document.getElementById('os_balance_display').value = data.os_balance;
            });
    });
</script>
</body>
</html>