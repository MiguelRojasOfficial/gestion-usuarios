@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center align-items-center m-0">
        <div class="card shadow p-4 text-center w-100 mw-400">
        <h2 class="text-center mb-4 text-uppercase">Iniciar Sesión</h2>
        <form action="{{ url('login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="mb-3 text-start">
                <label class="invisible fw-bold d-block">Email</label>
                <div class="d-flex justify-content-center">
                    <input type="email" name="email" class="input-underline shadow-none no-autofill mx-auto m-w w-75" placeholder="Email" autocomplete="off" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="mb-3 text-start">
                <label class="invisible fw-bold d-block">Contraseña</label>
                <div class="d-flex justify-content-center">
                    <input type="password" name="password" class="input-underline shadow-none text-align no-autofill mx-auto m-w w-75" placeholder="Contraseña" autocomplete="new-password" required>
                </div>
            </div>
            <button class="btn btn-danger mt-3 w-25">Entrar</button>
            <p class="mt-3">¿No tienes una cuenta?</p>
            <a href="{{ url('register') }}" class="text-secondary text-decoration-none fw-bold">Regístrate aquí</a>
        </form>
        </div>
    </div>
@endsection