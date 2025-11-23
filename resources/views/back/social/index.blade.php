@extends('back.app')

{{-- On change le titre de la page --}}
@section('title', 'Réseaux Sociaux - Admin Dashboard')

@section('dashboard-content')
<div class="container-fluid pt-4 px-4">
    {{-- On change les titres et le data-bs-target du bouton --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2 page-title">Réseaux Sociaux</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSocialMediaModal">
                <i class="bi bi-plus-circle-fill me-2"></i>Ajouter un média social
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-primary">Liste des réseaux sociaux</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTableSocialMedia" width="100%" cellspacing="0">
                    <thead class="table-light">
                        {{-- On adapte les colonnes du tableau --}}
                        <tr>
                            <th class="text-center">Icône</th>
                            <th>Nom</th>
                            <th>Lien</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- On change la variable de la boucle --}}
                        @forelse ($social_media_list as $social_media_item)
                        <tr>
                            {{-- On affiche l'icône directement --}}
                            <td class="text-center">
                                <i class="{{ $social_media_item->icon }} fs-4"></i>
                            </td>
                            <td>{{ $social_media_item->name }}</td>
                            {{-- On rend le lien cliquable --}}
                            <td>
                                <a href="{{ $social_media_item->lien }}" target="_blank">{{ $social_media_item->lien }}</a>
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        {{-- On adapte les data-bs-target pour les modales --}}
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editSocialMediaModal{{ $social_media_item->id }}">
                                                <i class="bi bi-pencil-square me-2"></i>Modifier
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteSocialMediaModal{{ $social_media_item->id }}">
                                                <i class="bi bi-trash-fill me-2"></i>Supprimer
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        {{-- ============================================= --}}
                        {{-- MODALE DE MODIFICATION POUR CHAQUE ÉLÉMENT --}}
                        {{-- ============================================= --}}
                        <div class="modal fade" id="editSocialMediaModal{{ $social_media_item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifier : {{ $social_media_item->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    {{-- On adapte la route et les champs du formulaire --}}
                                    <form action="{{ route('admin.social-media.update', $social_media_item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="edit_name_{{ $social_media_item->id }}" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="edit_name_{{ $social_media_item->id }}" name="name" value="{{ old('name', $social_media_item->name) }}" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_icon_{{ $social_media_item->id }}" class="form-label">Classe de l'icône</label>
                                                <input type="text" class="form-control" id="edit_icon_{{ $social_media_item->id }}" name="icon" value="{{ old('icon', $social_media_item->icon) }}" placeholder="Ex: bi bi-facebook" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_lien_{{ $social_media_item->id }}" class="form-label">Lien URL</label>
                                                <input type="url" class="form-control" id="edit_lien_{{ $social_media_item->id }}" name="lien" value="{{ old('lien', $social_media_item->lien) }}" placeholder="https://..." />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- ============================================= --}}
                        {{-- MODALE DE SUPPRESSION POUR CHAQUE ÉLÉMENT --}}
                        {{-- ============================================= --}}
                        <div class="modal fade" id="deleteSocialMediaModal{{ $social_media_item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmer la suppression</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer "{{ $social_media_item->name }}" ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <form action="{{ route('admin.social-media.destroy', $social_media_item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            {{-- On ajuste le colspan au nombre de colonnes --}}
                            <td colspan="4" class="text-center">Aucun média social trouvé.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ============================================= --}}
{{-- MODALE DE CRÉATION (UNE SEULE POUR LA PAGE) --}}
{{-- ============================================= --}}
<div class="modal fade" id="addSocialMediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Média Social</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.social-media.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required placeholder="Ex: Facebook" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Classe de l'icône</label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon') }}" placeholder="Ex: bi bi-facebook" />
                         @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lien" class="form-label">Lien URL</label>
                        <input type="url" class="form-control @error('lien') is-invalid @enderror" id="lien" name="lien" value="{{ old('lien') }}" placeholder="https://..." />
                         @error('lien')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection