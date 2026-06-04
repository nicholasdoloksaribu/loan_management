@extends('layouts.navbar')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard</h2>
    <p>Selamat datang, {{ Auth::guard('admin')->user()->name }}!</p>
@endsection