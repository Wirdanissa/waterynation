@extends('layouts.admin')
@section('adminDashboard', 'active')
@section('title', 'Dashboard | Admin Dangau Studio')

@section('admin-content')
    <div class="space-y-6">
        {{-- Judul & Selamat Datang --}}
        <div>
            <h1 class="text-xl lg:text-2xl font-semibold text-gray-800">Dashboard</h1>
            <p class="text-sm lg:text-base text-gray-600">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        </div>
    </div>
@endsection
