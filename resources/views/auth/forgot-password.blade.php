{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('auth.auth-layout')

@section('title', 'Mot de passe oublié')

@section('auth-form')
<div class="card-body">
    <div class="text-center mb-4">
        {{-- Vous pouvez ajouter un logo ici si désiré --}}
        {{-- <img src="https://via.placeholder.com/80?text=Logo" alt="Logo" class="mb-3" style="width: 80px;"> --}}
        <h3 class="mb-3 fw-semibold">Mot de passe oublié ?</h3>
        <p class="text-muted">
            Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation qui vous permettra d'en choisir un nouveau.
        </p>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            {{-- <label for="email" class="form-label">Adresse Email</label> --}} {{-- Optionnel, si vous utilisez des placeholders --}}
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Votre adresse e-mail">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">
                Envoyer le lien de réinitialisation
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