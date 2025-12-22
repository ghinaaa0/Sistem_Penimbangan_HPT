@extends('layouts.auth')

@section('title', 'Login BBPTUHPT')

@section('content')
<div class="auth-wrapper mt-20 mb-20">
    <div class="container">
        <!-- LEFT IMAGE -->
        <div class="left">
            <img src="{{ asset('images/bbptuhpt.jpg') }}" alt="BBPTUHPT">
            <div class="overlay">
                <h2>Kelola HPT Dengan Lebih Mudah!</h2>
                <p>
                    Ayo kelola HPT harian dengan mudah dengan
                    sistem admin BBPTUHPT.
                </p>
            </div>
        </div>

        <!-- RIGHT FORM -->
        <div class="right">
            <h1>Selamat Datang di BBPTUHPT!</h1>
            <span>Masuk kembali ke akun Anda.</span>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="Masukan email..." required>

                <label for="password">Kata Sandi</label>
                <input id="password" type="password" name="password" placeholder="Masukan kata sandi..." required>

                <div class="options">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        Ingat Saya
                    </label>
                    <a href="#">Lupa Kata Sandi?</a>
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>
    </div>
</div>
@endsection
