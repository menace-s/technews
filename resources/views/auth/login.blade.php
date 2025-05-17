{{-- resources/views/auth/login.blade.php --}}
@extends('auth.auth-layout')

@section('title', 'Connexion')

@section('auth-form')
<div class="card-body">
    <div class="text-center mb-4">
        {{-- Vous pouvez ajouter un logo ici si vous en avez un dans auth-layout ou le mettre ici --}}
        {{-- <img src="https://via.placeholder.com/80?text=Logo" alt="Logo" class="mb-3" style="width: 80px;"> --}}
        <h3 class="mb-3 fw-semibold">Connexion Administrateur</h3>
        <p class="text-muted">Connectez-vous pour accéder à votre tableau de bord.</p>
    </div>

    {{-- Affichage des messages de session (par exemple, après une déconnexion réussie ou si un statut est flashé) --}}
    @if (session('status'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Adresse Email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <p class="invalid-feedback" style="font-size: 0.875em;">{{ $message }}</p> {{-- Style d'erreur comme register.blade.php --}}
            @enderror
        </div>

        <div class="mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mot de passe" required>
            @error('password')
                <p class="invalid-feedback" style="font-size: 0.875em;">{{ $message }}</p> {{-- Style d'erreur comme register.blade.php --}}
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="rememberMe">
                    Se souvenir de moi
                </label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none text-muted" style="font-size: 0.9em;">Mot de passe oublié?</a>
            @endif
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>
    </form>

    @if (Route::has('register'))
    <hr class="my-4">
    <p class="text-center text-muted mb-0">
        Pas encore de compte? <a href="{{ route('register') }}" class="text-decoration-none fw-medium">S'inscrire</a>
    </p>
    @endif
</div>
@endsection