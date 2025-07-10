@extends('back.app')

@section('title', 'Dashboard - Articles')

@section('dashboard-content')
<div class="container-fluid pt-4 px-4">
    {{-- --- DONNÉES DE DÉMONSTRATION --- --}}
    @php
        $articles = [
            (object)[
                'id_article' => 'ART-0001',
                'image_url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=60&h=40&fit=crop',
                'titre' => 'Titre de l’article',
                'categorie' => 'Catégorie',
                'date_publication' => '2020-03-21 10:00:00',
                'statut_publication' => 'Publié',
                'partage_actif' => true,
                'commentaires_actifs' => true,
                'auteur' => (object)[
                    'nom' => 'Tommy Bernal',
                    'user_id' => '#0001',
                    'avatar_url' => 'https://i.pravatar.cc/40?u=a042581f4e29026704d'
                ]
            ],
            (object)[
                'id_article' => 'ART-0002',
                'image_url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=60&h=40&fit=crop',
                'titre' => 'Un autre article intéressant',
                'categorie' => 'Technologie',
                'date_publication' => '2021-05-15 14:30:00',
                'statut_publication' => 'Brouillon',
                'partage_actif' => true,
                'commentaires_actifs' => false,
                'auteur' => (object)[
                    'nom' => 'Jane Doe',
                    'user_id' => '#0002',
                    'avatar_url' => 'https://i.pravatar.cc/40?u=a042581f4e29026705d'
                ]
            ],
        ];

        $categories = [
            (object)['id' => 1, 'name' => 'Technologie', 'description' => 'Tout sur la tech', 'is_active' => true],
            (object)['id' => 2, 'name' => 'Business', 'description' => 'Actualités business', 'is_active' => false],
            (object)['id' => 3, 'name' => 'Sport', 'description' => 'Infos sportives', 'is_active' => true],
        ];
    @endphp

    <!-- Articles Table -->
    <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Articles</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addArticleModal">
            <a href="{{ route('articles.create') }}" class="text-white text-decoration-none">
            <i class="bi bi-plus-circle-fill me-2"></i>Ajouter un article</a>
        </button>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>ID Article</th>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Date</th>
                            <th>Publication</th>
                            <th>Partage</th>
                            <th>Commentaires</th>
                            <th>Auteur</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->id_article }}</td>
                                <td>
                                    @if($article->image_url)
                                        <img src="{{ $article->image_url }}" alt="" class="rounded" width="60">
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>{{ $article->titre }}</td>
                                <td>{{ $article->categorie }}</td>
                                <td>{{ \Carbon\Carbon::parse($article->date_publication)->format('d-m-Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $article->statut_publication == 'Publié' ? 'success' : 'secondary' }}">
                                        {{ $article->statut_publication }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $article->partage_actif ? 'success' : 'secondary' }}">
                                        {{ $article->partage_actif ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $article->commentaires_actifs ? 'success' : 'secondary' }}">
                                        {{ $article->commentaires_actifs ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="d-flex align-items-center">
                                    <img src="{{ $article->auteur->avatar_url }}" alt="Avatar" class="rounded-circle me-2" width="40">
                                    <div>
                                        <div>{{ $article->auteur->nom }}</div>
                                        <small class="text-muted">{{ $article->auteur->user_id }}</small>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="#" class="dropdown-item"><i class="bi bi-pencil-square me-2"></i>Modifier</a></li>
                                            <li>
                                                <form action="#" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash-fill me-2"></i>Supprimer</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
