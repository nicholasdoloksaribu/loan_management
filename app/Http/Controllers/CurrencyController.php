<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $currencies = Currency::all();
        return view('currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'currency_id' => 'required|string|unique:currencies,currency_id',
            'currency_name' => 'required|string'
        ]);

        Currency::create($request->all());
        return redirect()->route('currencies.index')->with('success', $request->currency_id .  ' Currency  success added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $currency = Currency::findOrFail($id);
        return view('currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'currency_id' => 'required|unique:currencies,currency_id, ' . $id,
            'currency_name' => 'required'
        ]);

        $currency = Currency::findOrFail($id);
        $currency->update($request->all());
        return redirect()->route('currencies.index')->with('success', 'Currency success updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Currency::findOrFail($id)->delete();
        return redirect()->route('currencies.index')->with('succes', 'Currency success deleted');
    }
}
