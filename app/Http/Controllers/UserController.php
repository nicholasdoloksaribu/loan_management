<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'username' => 'required|string',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'no_identity' => 'required|unique:users,no_identity',
            'address' => 'required|string'
        ]);

        User::create($request->all());
        return redirect()->route('users.index')->with('success', 'user iD : ' . User::latest()->first()->id  .  ' succes added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'username' => 'required|string',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'no_identity' => 'required|unique:users,no_identity, ' . $id,
            'address' => 'required|string'
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'updated user success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User success deleted');
    }
}
