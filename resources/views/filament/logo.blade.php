@php
    // Cek apakah sedang di halaman login
    $isLogin = request()->routeIs('filament.*.auth.login');
    $isRegister = request()->routeIs('filament.*.auth.register');
@endphp

@if($isLogin || $isRegister)
    <img src="{{ asset('images/logo/uin.png') }}" alt="Logo" style="width: 50px; height: 60px; margin-top: -30px; margin-bottom: 5px;">
@else
    <img src="{{ asset('images/logo/uin.png') }}" alt="Logo" style="width: 30px; height: 40px; margin-top: -10px; margin-bottom: 5px;">
@endif