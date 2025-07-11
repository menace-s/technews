@extends('back.app')

@section('title', 'Détails : ' . $article->title)

@section('dashboard-content')
<div class="container-fluid pt-4 px-4">

    {{-- 1. EN-TÊTE DE LA PAGE AVEC ACTIONS --}}
    <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
        {{-- On limite la longueur du titre pour éviter qu'il ne soit trop long --}}
        <h1 class="h2 text-truncate" style="max-width: 70%;">{{ $article->title }}</h1>
        
        {{-- Boutons d'action rapides --}}
        <div>
            <a href="{{ route('articles.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Retour
            </a>
            <a href="{{ route('articles.edit', $article) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square me-2"></i>Modifier
            </a>
        </div>
    </div>

    {{-- On affiche les messages de succès s'il y en a --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- 2. CORPS DE LA PAGE EN DEUX COLONNES --}}
    <div class="row">

        {{-- COLONNE GAUCHE (8/12) : CONTENU PRINCIPAL --}}
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Contenu de l'article</h6>
                </div>
                <div class="card-body">
                    {{-- Image principale de l'article --}}
                    <div class="text-center mb-4">
                        <img src="{{ $article->imageUrl() }}" class="img-fluid rounded" alt="Image de l'article">
                    </div>
                    
                    {{-- Description / Contenu de l'article --}}
                    {{-- ATTENTION : On utilise {!! !!} pour interpréter le HTML qui viendrait d'un éditeur de texte riche (WYSIWYG).
                         À n'utiliser que si vous faites confiance à la source des données ! --}}
                    <div class="text-justify">
                        {!! $article->description !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- COLONNE DROITE (4/12) : MÉTA-DONNÉES --}}
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informations</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Auteur
                            @if ($article->author)
                                <div class="d-flex align-items-center">
                                    <img src="{{ $article->author->avatarUrl() }}" alt="Avatar" class="rounded-circle me-2" width="30">
                                    <span>{{ $article->author->name }}</span>
                                </div>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Catégorie
                            <span class="badge bg-info rounded-pill">{{ $article->category?->name ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Publication
                            <x-status-badge :active="$article->is_active" />
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Partage
                            <x-status-badge :active="$article->is_shareable" />
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Commentaires
                            <x-status-badge :active="$article->is_commentable" />
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Créé le
                            <span class="text-muted">{{ $article->created_at->format('d/m/Y') }}</span>
                        </li>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                            Modifié le
                            {{-- diffForHumans() affiche "il y a 2 heures", "hier", etc. --}}
                            <span class="text-muted">{{ $article->updated_at->diffForHumans() }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection