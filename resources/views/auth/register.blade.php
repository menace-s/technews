@extends('auth.auth-layout')
@section('title', 'Inscription')
@section('auth-form')
 <div class="card-body">
                <div class="text-center mb-4">
                    <h3 class="mb-3 fw-semibold">Créer un compte</h3>
                    <p class="text-muted">Rejoignez notre plateforme d'administration.</p>
                </div>

                <form action="{{ route('register') }}" method="POST"> 
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="Name" name="name"  placeholder="Nom" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="invalid-feedback" style="font-size: 0.875em;">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  placeholder="Email" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="invalid-feedback" style="font-size: 0.875em;"">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mot de passe" value="{{ old('password') }}" required>
                        @error('password')
                            <p class="invalid-feedback" style="font-size: 0.875em;">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword" name="password_confirmation" placeholder="Retapez votre mot de passe" value="{{ old('password_confirmation') }}" required>
                        @error('password_confirmation')
                            <p class="invalid-feedback" style="font-size: 0.875em;">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </div>  
                </form>

                <p class="text-center text-muted mb-0">
                    Déjà un compte? <a href="{{ route('login') }}" class="text-decoration-none fw-medium">Se connecter</a>
                </p>
            </div>
@endsection