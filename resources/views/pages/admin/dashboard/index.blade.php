@extends('layouts.admin')
@section('menuDashboard', 'active')
@section('title', 'Dashboard | Admin Dangau Studio')

@section('admin-content')
    <div class="bg-white rounded-3 p-4 mb-4 d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-3">
        {{-- Judul & Selamat Datang --}}
        <div>
            <h1 class="text-xl lg:text-2xl font-semibold text-dark">Dashboard</h1>
            <p class="text-sm lg:text-base text-gray-800">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        </div>
    </div>
@endsection
