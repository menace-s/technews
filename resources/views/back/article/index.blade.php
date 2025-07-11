@extends('back.app')

@section('title', 'Gestion des Articles')

@section('dashboard-content')
<div class="container-fluid pt-4 px-4">

    {{-- En-tête de la page --}}
    <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle-fill me-2"></i>Ajouter un article
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        {{-- ✅ En-tête de tableau corrigé avec les colonnes séparées --}}
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Publication</th>
                            <th>Partage</th>
                            <th>Commentaires</th>
                            <th>Auteur</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>ART-000{{ $article->id }}</td>
                                <td>
                                    <img src="{{ $article->imageUrl() }}" alt="Image de {{ $article->title }}" class="rounded" width="60" height="40">
                                </td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->category?->name ?? 'N/A' }}</td>
                                
                                {{-- ✅ Utilisation du composant dans chaque colonne de statut --}}
                                <td><x-status-badge :active="$article->is_active" /></td>
                                <td><x-status-badge :active="$article->is_shareable" /></td>
                                <td><x-status-badge :active="$article->is_commentable" /></td>
                                
                                <td>
                                    @if ($article->author)
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $article->author->avatarUrl() }}" alt="Avatar de {{ $article->author->name }}" class="rounded-circle me-2" width="40" height="40">
                                            <span>{{ $article->author->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">Auteur inconnu</span>
                                    @endif
                                </td>
                                
                                <td class="text-end">
                                    {{-- Actions --}}
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="{{ route('articles.show', $article) }}" class="dropdown-item">
                                                    <i class="bi bi-eye-fill me-2"></i>Voir
                                                </a>
                                            <li><a href="{{ route('articles.edit', $article) }}" class="dropdown-item"><i class="bi bi-pencil-square me-2"></i>Modifier</a></li>
                                            <li>
                                                <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash-fill me-2"></i>Supprimer</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                {{-- Le colspan doit correspondre au nombre de colonnes dans thead --}}
                                <td colspan="9" class="text-center">Aucun article trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@endsection