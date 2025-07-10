@extends('back.app')

@section('title', 'Dashboard - Catégories')

@section('dashboard-content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2 page-title">Catégories</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="bi bi-plus-circle-fill me-2"></i>Ajouter une catégorie
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-primary">Liste des catégories</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTableCategories" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>ID Catégorie</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $index => $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <span class="badge badge-pill bg-success inv-badge">
                                        {{ $category->isActive == 1 ? 'ACTIF' : 'INACTIF' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary rounded-circle" type="button" id="dropdownMenuButton{{ $index }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $index }}">
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                                                    <i class="bi bi-pencil-square me-2"></i>Modifier
                                                </a>
                                            </li>
                                            <li>
                                                
                                                    <form action="{{ route("categories.destroy",$category) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn text-danger dropdown-item">
                                                        <i class="bi bi-trash-fill me-2"></i>Supprimer
                                                        </button>
                                                    </form>
                                                
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modale de modification -->
                            <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Modifier la catégorie "{{ $category->name }}"</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                        </div>
                                        <form action="{{ route('categories.update', $category->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="editCategoryName{{ $category->id }}" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="editCategoryName{{ $category->id }}" name="name" value="{{ $category->name }}" placeholder="Nom de la catégorie" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editCategoryDescription{{ $category->id }}" class="form-label">Description</label>
                                                    <textarea class="form-control" id="editCategoryDescription{{ $category->id }}" name="description" rows="3" placeholder="Description">{{ $category->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editCategoryStatus{{ $category->id }}" class="form-label">Statut</label>
                                                    <select name="isActive" id="editCategoryStatus{{ $category->id }}" class="form-select" required>
                                                        <option value="1" {{ $category->isActive ? 'selected' : '' }}>Actif</option>
                                                        <option value="0" {{ !$category->isActive ? 'selected' : '' }}>Inactif</option>
                                                    </select>
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

                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucune catégorie trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modale pour Ajouter une Catégorie -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Ajouter une nouvelle catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="categoryName" name="name" required placeholder="Ex: Technologie">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Description (optionnel)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="categoryDescription" name="description" rows="3" placeholder="Une brève description de ce que contient cette catégorie."></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sel2" class="form-label">Activation : </label>
                        <select id="sel2" name="isActive" required class="form-select">
                            <option value="1">Activer</option>
                            <option value="0">Désactiver</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer la catégorie</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
