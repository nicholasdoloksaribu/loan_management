<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $loans = Loan::all();
        return view('payments.create', compact('loans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'loan_id'          => 'required|exists:loans,id',
            'transaction_date' => 'required|date',
            'paid_amount'      => 'required|numeric',
        ]);

        $loan = Loan::findOrFail($request->loan_id);

        // Hitung total yang sudah dibayar sebelumnya
        $totalPaid = Payment::where('loan_id', $loan->id)->sum('paid_amount');

        // Hitung os_balance
        $osBalance = $loan->total_loan - $totalPaid - $request->paid_amount;

        Payment::create([
            'loan_id'          => $loan->id,
            'transaction_date' => $request->transaction_date,
            'customer_id'      => $loan->customer_id,
            'customer_name'    => $loan->customer_name,
            'currency_id'      => $loan->currency_id,
            'currency_name'    => $loan->currency_name,
            'paid_amount'      => $request->paid_amount,
            'os_balance'       => $osBalance,
        ]);

        return redirect()->route('payments.index')
            ->with('success', 'Payment berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $payment = Payment::findOrFail($id);
        $loans = Loan::all();
        return view('payments.edit', compact('payment', 'loans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'loan_id'          => 'required|exists:loans,id',
            'transaction_date' => 'required|date',
            'paid_amount'      => 'required|numeric',
        ]);

        $payment = Payment::findOrFail($id);
        $loan = Loan::findOrFail($request->loan_id);

        // Hitung total paid exclude payment yang sedang diedit
        $totalPaid = Payment::where('loan_id', $loan->id)
            ->where('id', '!=', $id)
            ->sum('paid_amount');

        $osBalance = $loan->total_loan - $totalPaid - $request->paid_amount;

        $payment->update([
            'loan_id'          => $loan->id,
            'transaction_date' => $request->transaction_date,
            'customer_id'      => $loan->customer_id,
            'customer_name'    => $loan->customer_name,
            'currency_id'      => $loan->currency_id,
            'currency_name'    => $loan->currency_name,
            'paid_amount'      => $request->paid_amount,
            'os_balance'       => $osBalance,
        ]);

        return redirect()->route('payments.index')
            ->with('success', 'Payment berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Payment::findOrFail($id)->delete();
        return redirect()->route('payments.index')
            ->with('success', 'Payment berhasil dihapus!');
    }

    public function getLoan($id)
    {
        $loan = Loan::findOrFail($id);

        $totalPaid = Payment::where('loan_id', $id)->sum('paid_amount');
        $osBalance = $loan->total_loan - $totalPaid;

        return response()->json([
            'customer_id'   => $loan->customer_id,
            'customer_name' => $loan->customer_name,
            'currency_id'   => $loan->currency_id,
            'currency_name' => $loan->currency_name,
            'os_balance'    => $osBalance,
        ]);
    }
}
