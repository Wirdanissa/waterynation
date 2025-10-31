@extends('layouts.app')
@section('body')
    @include('partials.guest.navbar')

    <main class="py-4">
        @yield('content')
    </main>

    @include('partials.guest.footer')
@endsection
