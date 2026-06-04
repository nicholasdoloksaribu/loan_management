<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Loan Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Loan Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                {{-- Master --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Master</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">User</a></li>
                        <li><a class="dropdown-item" href="{{ route('currencies.index') }}">Currency</a></li>
                        <li><a class="dropdown-item" href="{{ route('customers.index') }}">Customer</a></li>
                    </ul>
                </li>

                {{-- Transaction --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Transaction</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('loans.index') }}">Loan</a></li>
                        <li><a class="dropdown-item" href="{{ route('payments.index') }}">Payment</a></li>
                    </ul>
                </li>

                  {{-- Reports --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Reports</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('reports.loan-list') }}">Loan List</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.payment-list') }}">Payment List</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.outstanding-list') }}">Outstanding List</a></li>
                    </ul>
                </li>


            </ul>
             <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm mt-1">Logout</button>
        </form>
    </li>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>