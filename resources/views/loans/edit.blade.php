<!DOCTYPE html>
<html>
<head>
    <title>Edit Loan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Loan</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('loans.update', $loan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Transaction Date</label>
            <input type="date" name="transaction_date" class="form-control"
                   value="{{ $loan->transaction_date }}" required>
        </div>

        <div class="mb-3">
            <label>Customer</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                @foreach($customers as $c)
                    <option value="{{ $c->id }}" {{ $loan->customer_id == $c->id ? 'selected' : '' }}>
                        {{ $c->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Customer Name</label>
            <input type="text" id="customer_name" class="form-control bg-light"
                   readonly value="{{ $loan->customer_name }}">
        </div>

        <div class="mb-3">
            <label>Currency</label>
            <select name="currency_id" id="currency_id" class="form-control" required>
                @foreach($currencies as $c)
                    <option value="{{ $c->currency_id }}" {{ $loan->currency_id == $c->currency_id ? 'selected' : '' }}>
                        {{ $c->currency_id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Currency Name</label>
            <input type="text" id="currency_name" class="form-control bg-light"
                   readonly value="{{ $loan->currency_name }}">
        </div>

        <div class="mb-3">
            <label>Loan Amount</label>
            <input type="number" name="loan_amount" id="loan_amount" class="form-control"
                   value="{{ $loan->loan_amount }}" required>
        </div>

        <div class="mb-3">
            <label>Previous Balance</label>
            <input type="text" id="previous_balance" class="form-control bg-light"
                   readonly value="{{ $loan->previous_balance }}">
        </div>

        <div class="mb-3">
            <label>Total Loan</label>
            <input type="text" id="total_loan" class="form-control bg-light"
                   readonly value="{{ $loan->total_loan }}">
        </div>

        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>

<script>
    document.getElementById('customer_id').addEventListener('change', function() {
        const id = this.value;
        if (!id) {
            document.getElementById('customer_name').value = '';
            document.getElementById('previous_balance').value = 0;
            hitungTotal();
            return;
        }
        fetch(`/api/customers/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('customer_name').value = data.name;
                document.getElementById('previous_balance').value = data.previous_balance;
                hitungTotal();
            });
    });

    document.getElementById('currency_id').addEventListener('change', function() {
        const id = this.value;
        if (!id) {
            document.getElementById('currency_name').value = '';
            return;
        }
        fetch(`/api/currencies/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('currency_name').value = data.name;
            });
    });

    document.getElementById('loan_amount').addEventListener('input', hitungTotal);

    function hitungTotal() {
        const loanAmount = parseFloat(document.getElementById('loan_amount').value) || 0;
        const previousBalance = parseFloat(document.getElementById('previous_balance').value) || 0;
        document.getElementById('total_loan').value = loanAmount + previousBalance;
    }
</script>
</body>
</html>