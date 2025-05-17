{{-- resources/views/auth/reset-password.blade.php --}}
@extends('auth.auth-layout')

@section('title', 'Réinitialiser le mot de passe')

@section('auth-form')
<div class="card-body">
    <div class="text-center mb-4">
        <h3 class="mb-3 fw-semibold">Définir un nouveau mot de passe</h3>
        <p class="text-muted">
            Veuillez choisir un nouveau mot de passe sécurisé. Assurez-vous qu'il soit différent des précédents.
        </p>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}"> {{-- Assurez-vous que 'password.store' est la bonne route pour la soumission du formulaire de réinitialisation --}}
        @csrf

        {{-- Laravel s'attend à ce que le token soit disponible dans la requête.
             Le contrôleur qui affiche cette vue (généralement NewPasswordController@create)
             doit passer $request->route('token') ou $token à la vue. --}}
        <input type="hidden" name="token" value="{{ $token ?? $request->route('token') }}">

        <div class="mb-3">
            {{-- <label for="email" class="form-label">Adresse Email</label> --}}
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $request->email) }}" required autofocus placeholder="Adresse Email" readonly>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            {{-- <label for="password" class="form-label">Nouveau mot de passe</label> --}}
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Nouveau mot de passe">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            {{-- <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label> --}}
            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required placeholder="Confirmer le nouveau mot de passe">
            @error('password_confirmation') {{-- Utile si vous avez des règles de validation spécifiques pour ce champ au-delà de 'confirmed' --}}
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">
                Réinitialiser le mot de passe
            </button>
        </div>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="text-decoration-none fw-medium">
            <i class="bi bi-arrow-left-circle me-1"></i> Retour à la connexion
        </a>
    </div>
</div>
@endsection