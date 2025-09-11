@extends('layouts.app')

@section('content')
<div class="login-container">
    <section>
        <h1>Iniciar Sesión</h1>

        @if(session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Ingresar</button>
        </form>

        <p class="mt-3">¿No tienes cuenta? <a href="{{ route('registrarse') }}">Regístrate aquí</a></p>
    </section>
</div>
@endsection
