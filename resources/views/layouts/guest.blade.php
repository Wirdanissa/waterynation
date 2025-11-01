@extends('layouts.app')
@section('body')
    @include('partials.guest.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.guest.footer')
@endsection
