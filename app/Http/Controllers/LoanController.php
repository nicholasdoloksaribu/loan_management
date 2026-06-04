<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $loans = Loan::all();
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customers = Customer::all();
        $currencies = Currency::all();
        return view('loans.create', compact('customers', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'customer_id'      => 'required|exists:customers,id',
            'currency_id'      => 'required|exists:currencies,currency_id',
            'loan_amount'      => 'required|numeric',
            'transaction_date' => 'required|date',
        ]);

        $customer = Customer::findOrFail($request->customer_id);
        $currency = Currency::where('currency_id', $request->currency_id)->first();

        // Hitung previous balance
        $totalLoan = Loan::where('customer_id', $request->customer_id)->sum('total_loan');

        $totalPaid = Payment::whereIn(
            'loan_id',
            Loan::where('customer_id', $request->customer_id)
                ->pluck('id')
        )
            ->sum('paid_amount');

        $previousBalance = $totalLoan - $totalPaid;
        $totalLoan = $request->loan_amount + $previousBalance;

        Loan::create([
            'customer_id'      => $customer->id,
            'customer_name'    => $customer->customer_name,
            'currency_id'      => $currency->currency_id,
            'currency_name'    => $currency->currency_name,
            'transaction_date' => $request->transaction_date,
            'loan_amount'      => $request->loan_amount,
            'previous_balance' => $previousBalance,
            'total_loan'       => $totalLoan,
        ]);

        return redirect()->route('loans.index')
            ->with('success', 'Loan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $loan = Loan::findOrFail($id);
        $customers = Customer::all();
        $currencies = Currency::all();
        return view('loans.edit', compact('loan', 'customers', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'customer_id'      => 'required|exists:customers,id',
            'currency_id'      => 'required|exists:currencies,currency_id',
            'loan_amount'      => 'required|numeric',
            'transaction_date' => 'required|date',
        ]);

        $loan = Loan::findOrFail($id);
        $customer = Customer::findOrFail($request->customer_id);
        $currency = Currency::where('currency_id', $request->currency_id)->first();

        // Hitung previous balance
        $totalLoan = Loan::where('customer_id', $request->customer_id)
            ->where('id', '!=', $id) // exclude loan yang sedang diedit
            ->sum('total_loan');

        $totalPaid = Payment::whereIn(
            'loan_id',
            Loan::where('customer_id', $request->customer_id)
                ->pluck('id')
        )
            ->sum('paid_amount');

        $previousBalance = $totalLoan - $totalPaid;
        $totalLoan = $request->loan_amount + $previousBalance;

        $loan->update([
            'customer_id'      => $customer->id,
            'customer_name'    => $customer->customer_name,
            'currency_id'      => $currency->currency_id,
            'currency_name'    => $currency->currency_name,
            'transaction_date' => $request->transaction_date,
            'loan_amount'      => $request->loan_amount,
            'previous_balance' => $previousBalance,
            'total_loan'       => $totalLoan,
        ]);

        return redirect()->route('loans.index')
            ->with('success', 'Loan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Loan::findOrFail($id)->delete();
        return redirect()->route('loans.index')->with('success', 'loan success deleted');
    }

    // API untuk AJAX
    public function getCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        $totalLoan = Loan::where('customer_id', $id)->sum('total_loan');

        $totalPaid = Payment::whereIn(
            'loan_id',
            Loan::where('customer_id', $id)->pluck('id')
        )
            ->sum('paid_amount');

        $previousBalance = $totalLoan - $totalPaid;

        return response()->json([
            'name'             => $customer->customer_name,
            'previous_balance' => $previousBalance,
        ]);
    }

    public function getCurrency($currency_id)
    {
        $currency = Currency::where('currency_id', $currency_id)->first();
        return response()->json($currency);
    }
}
