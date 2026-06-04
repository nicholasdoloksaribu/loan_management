<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customers = Customer::with('user')->get();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::all();
        return view('customers.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_name' => 'required|string',
            'no_identity' => 'required|string|unique:customers,no_identity',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'address' => 'required|string',

        ]);
        Customer::create($request->all());
        return redirect()->route('customers.index')->with('success', 'customer success added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $customer = Customer::findOrFail($id);
        $users = User::all();
        return view('customers.edit', compact('customer', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_name' => 'required|string',
            'no_identity' => 'required|string|unique:customers,no_identity,' . $id,
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'address' => 'required|string',

        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'customer success updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Customer::findOrFail($id)->delete();
        return redirect()->route('customers.index')
            ->with('success', 'Customer success deleted');
    }
}
