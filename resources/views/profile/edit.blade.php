@extends('back.app') {{-- Remplacez 'layouts.app' ou 'back.app' par le chemin exact de votre layout principal si différent --}}

@section('title', 'Mon Profil - Admin Dashboard')

@section('dashboard-content')
{{-- Le container-fluid est supposé être dans votre layout back.app ou englober ce yield --}}
{{-- Si ce n'est pas le cas, et que vous l'aviez dans la version précédente, vous pouvez l'ajouter ici : --}}
{{-- <div class="container-fluid pt-4 px-4"> --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2 page-title">Mon Profil</h1>
    </div>

    {{-- AJOUT DU MESSAGE DE SUCCÈS UNIQUEMENT --}}
    {{-- Dans votre fichier profile.blade.php, à l'endroit où vous voulez afficher les notifications --}}

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            @php
                $statusMessage = '';
                switch (session('status')) {
                    case 'profile-updated':
                        $statusMessage = 'Profil modifié avec succès !';
                        break;
                    case 'password-updated':
                        $statusMessage = 'Mot de passe modifié avec succès !';
                        break;
                    // Vous pouvez ajouter d'autres cas ici si nécessaire
                    // case 'another-status-key':
                    //     $statusMessage = 'Autre message de succès !';
                    //     break;
                    default:
                        // Si le statut est une chaîne de caractères que vous voulez afficher directement
                        // (par exemple, si un contrôleur envoie un message complet au lieu d'une clé)
                        // $statusMessage = session('status');
                        // Cependant, avec la structure actuelle, il est préférable que les contrôleurs envoient des clés.
                        $statusMessage = 'Opération réussie !'; // Un message générique par défaut
                }
            @endphp
            {{ $statusMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- FIN DE L'AJOUT DU MESSAGE DE SUCCÈS --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-primary">À Propos de Moi</h6>
            <div>
                <a href="#" class="btn btn-sm btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    Changer le mot de passe
                </a>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="bi bi-pencil-square me-1"></i> Modifier les informations
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center profile-avatar-wrapper mb-3 mb-md-0">
                    <img src="{{ Auth::user()->avatarUrl() }}" {{-- Remplacer par Auth::user()->image si disponible --}}
                         alt="Avatar de l'utilisateur"
                         class="img-fluid rounded-circle mb-2">
                    <p class="text-muted small mb-0">Administrateur</p>
                </div>
                <div class="col-md-9">
                    <h4 id="profileNameDisplay" class="mb-1">{{ Auth::user()->name }}</h4>
                    <p class="mb-2">
                        <i class="bi bi-envelope-fill me-2 text-muted"></i>
                        <span id="profileEmailDisplay">{{ Auth::user()->email }}</span>
                    </p>
                    
                </div>
            </div>
        </div>
    </div>

{{-- Si vous aviez un container-fluid ouvert au début de cette section, fermez-le ici : --}}
{{-- </div> --}}


<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Modifier mes informations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH') {{-- Ou PUT, selon ce que votre ProfileController attend et ce qui est défini dans vos routes --}}
                <div class="modal-body">
                    {{-- Vous pouvez ajouter l'affichage des erreurs de validation ici si nécessaire, ex: --}}
                    {{-- @if ($errors->updateProfileInformation && $errors->updateProfileInformation->any()) ... @endif --}}

                    <div class="row">
                        <div class="col-md-4 text-center profile-avatar-wrapper mb-3">
                            <img src="{{ Auth::user()->avatarUrl() }}" style="width:120px; height:120px; object-fit:cover;">
                            <label for="avatarModal" class="form-label">Changer l'avatar</label>
                            <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror" id="avatarModal" name="image">
                             @error('image') {{-- Si vous n'utilisez pas d'error bag spécifique pour ce formulaire --}}
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted d-block mt-1">Laisser vide pour ne pas changer.</small>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="nameModal" class="form-label">Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameModal" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Votre nom et prénom" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="emailModal" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailModal" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Votre adresse e-mail" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Ajoutez ici le champ pour la biographie si vous le souhaitez dans la modale --}}
                            {{-- <div class="mb-3">
                                <label for="bioModal" class="form-label">Biographie (optionnel)</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" id="bioModal" name="bio" rows="3" placeholder="Parlez un peu de vous...">{{ old('bio', Auth::user()->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Changer mon mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT') {{-- Fortify utilise PUT pour user-password.update --}}
                <div class="modal-body">
                    {{-- Affichage des erreurs spécifiques à cette modale (ex: avec error bag 'updatePassword') --}}
                    {{-- @if ($errors->updatePassword && $errors->updatePassword->any()) ... @endif --}}

                    <div class="mb-3">
                        <label for="current_passwordModal" class="form-label">Mot de passe actuel</label>
                        <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_passwordModal" name="current_password" required placeholder="Votre mot de passe actuel">
                        @error('current_password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new_passwordModal" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="new_passwordModal" name="password" required placeholder="Minimum 8 caractères">
                         @error('password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmationModal" class="form-label">Confirmer le nouveau mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmationModal" name="password_confirmation" required placeholder="Retapez le nouveau mot de passe">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection