@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}">

<div class="login-container">
    <section>
        <h1>Iniciar Sesión</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

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

           <button type="submit" class="btn-action">Ingresar</button>
        </form>

        <p class="label">¿No tienes cuenta? <a href="{{ route('registrarse') }}" class="link-registrarse">Regístrate aquí</a></p>

    </section>
</div>

@endsection
