<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    // Loan List
    public function loanList(Request $request)
    {
        $search   = $request->input('search');
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');

        $loans = Loan::when($search, function ($query) use ($search) {
            $query->where('customer_name', 'like', '%' . $search . '%')
                ->orWhere('currency_id', 'like', '%' . $search . '%');
        })
            ->when($dateFrom, function ($query) use ($dateFrom) {
                $query->where('transaction_date', '>=', $dateFrom);
            })
            ->when($dateTo, function ($query) use ($dateTo) {
                $query->where('transaction_date', '<=', $dateTo);
            })
            ->get();

        return view('reports.loan-list', compact('loans', 'search', 'dateFrom', 'dateTo'));
    }

    // Payment List
    public function paymentList(Request $request)
    {
        $search   = $request->input('search');
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');

        $payments = Payment::when($search, function ($query) use ($search) {
            $query->where('customer_name', 'like', '%' . $search . '%')
                ->orWhere('currency_id', 'like', '%' . $search . '%');
        })
            ->when($dateFrom, function ($query) use ($dateFrom) {
                $query->where('transaction_date', '>=', $dateFrom);
            })
            ->when($dateTo, function ($query) use ($dateTo) {
                $query->where('transaction_date', '<=', $dateTo);
            })
            ->get();

        return view('reports.payment-list', compact('payments', 'search', 'dateFrom', 'dateTo'));
    }

    // Outstanding List
    public function outstandingList(Request $request)
    {
        $search = $request->input('search');

        $outstanding = Payment::selectRaw('customer_id, customer_name, currency_id, currency_name, MAX(transaction_date) as last_date, MIN(os_balance) as os_balance')
            ->when($search, function ($query) use ($search) {
                $query->where('customer_name', 'like', '%' . $search . '%');
            })
            ->groupBy('customer_id', 'customer_name', 'currency_id', 'currency_name')
            ->having('os_balance', '>', 0)
            ->get();

        return view('reports.outstanding-list', compact('outstanding', 'search'));
    }


    // PDF Loan List
    public function loanListPdf(Request $request)
    {
        $search   = $request->input('search');
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');

        $loans = Loan::when($search, function ($query) use ($search) {
            $query->where('customer_name', 'like', '%' . $search . '%')
                ->orWhere('currency_id', 'like', '%' . $search . '%');
        })
            ->when($dateFrom, function ($query) use ($dateFrom) {
                $query->where('transaction_date', '>=', $dateFrom);
            })
            ->when($dateTo, function ($query) use ($dateTo) {
                $query->where('transaction_date', '<=', $dateTo);
            })
            ->get();

        $pdf = Pdf::loadView('reports.pdf.loan-list', compact('loans'))->setPaper('a4', 'landscape');
        return $pdf->download('loan-list.pdf');
    }

    // PDF Payment List
    public function paymentListPdf(Request $request)
    {
        $search   = $request->input('search');
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');

        $payments = Payment::when($search, function ($query) use ($search) {
            $query->where('customer_name', 'like', '%' . $search . '%')
                ->orWhere('currency_id', 'like', '%' . $search . '%');
        })
            ->when($dateFrom, function ($query) use ($dateFrom) {
                $query->where('transaction_date', '>=', $dateFrom);
            })
            ->when($dateTo, function ($query) use ($dateTo) {
                $query->where('transaction_date', '<=', $dateTo);
            })
            ->get();

        $pdf = Pdf::loadView('reports.pdf.payment-list', compact('payments'))->setPaper('a4', 'landscape');
        return $pdf->download('payment-list.pdf');
    }

    // PDF Outstanding List
    public function outstandingListPdf(Request $request)
    {
        $search = $request->input('search');

        $outstanding = Payment::selectRaw('customer_id, customer_name, currency_id, currency_name, MAX(transaction_date) as last_date, MIN(os_balance) as os_balance')
            ->when($search, function ($query) use ($search) {
                $query->where('customer_name', 'like', '%' . $search . '%');
            })
            ->groupBy('customer_id', 'customer_name', 'currency_id', 'currency_name')
            ->having('os_balance', '>', 0)
            ->get();

        $pdf = Pdf::loadView('reports.pdf.outstanding-list', compact('outstanding'))->setPaper('a4', 'landscape');
        return $pdf->download('outstanding-list.pdf');
    }
}
