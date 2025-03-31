@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center align-items-center m-0">
        <div class="card shadow p-4 text-center w-100 mw-400">
            <h2 class="text-center mb-4 text-uppercase">Registro</h2>
            <form action="{{ url('register') }}" method="POST" autocomplete="off">
                @csrf
                <div class="mb-3 text-start">
                    <label class="invisible fw-bold d-block">Nombre</label>
                    <div class="d-flex justify-content-center">
                        <input type="text" name="name" class="input-underline shadow-none no-autofill mx-auto w-75" placeholder="Nombre" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="invisible fw-bold d-block">Email</label>
                    <div class="d-flex justify-content-center">
                        <input type="email" name="email" class="input-underline shadow-none no-autofill mx-auto w-75" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="invisible fw-bold d-block">Contraseña</label>
                    <div class="d-flex justify-content-center">
                        <input type="password" name="password" class="input-underline shadow-none no-autofill mx-auto w-75" placeholder="Contraseña" autocomplete="new-password" required>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="invisible fw-bold d-block">Confirmar Contraseña</label>
                    <div class="d-flex justify-content-center">
                        <input type="password" name="password_confirmation" class="input-underline shadow-none no-autofill mx-auto w-75" placeholder="Confirmar Contraseña" autocomplete="new-password" required>
                    </div>
                </div>
                <button class="btn btn-danger mt-3 w-35">Registrarse</button>
                <p class="mt-3">¿Ya tienes una cuenta?</p>
                <a href="{{ url('login') }}" class="text-secondary text-decoration-none fw-bold">Inicia sesión aquí</a>
            </form>
        </div>
    </div>
@endsection
