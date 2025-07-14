@extends('back.app')

@section('title', 'Dashboard - Ajouter un article')

@section('dashboard-content')
<div class="container-fluid pt-4 px-4">
    <div class="card shadow">
        <div class="card-header bg-light">
            <h5 class="mb-0">@if(isset($article)) Modifier un article @else Ajouter un article @endif</h5>
        </div>
        <div class="card-body">
            
            <form action="{{ isset($article) ? route('articles.update',$article) : route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($article))
                    @method('PUT')
                    <div class="mb-3 col-12" width="100%" height="200px">
                        {{-- Affichage de l'image actuelle si l'article existe --}}
                        <img src="{{ $article->imageUrl() }}" alt="{{ $article->title }}" class="img-fluid rounded mb-3" style="max-height: 200px; object-fit: cover;">
                    </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="title" class="form-label">Titre de l'article</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Titre de l'article" value="{{ isset($article) ? old('title',$article->title) : old('title') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="category_id" class="form-label">Catégorie</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">-- Sélectionnez une catégorie --</option>
                            
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{-- La magie est ici --}}
                                    @selected(old('category_id', $article->category_id ?? '') == $category->id)
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="image" class="form-label">Uploader une image</label>
                        <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="6" class="form-control" placeholder="Entrez le contenu de l'article..." value="{{ old('description') }}" required>{{ old('description', $article->description ?? '') }}</textarea>
                </div>
                                {{-- On vérifie non seulement que l'article existe, mais aussi qu'il a bien des tags --}}
                @if (isset($article) && $article->tags->isNotEmpty())
                    <div class="mb-3">
                        <p class="fw-bold mb-2">Tags actuels :</p>
                        <div>
                            @foreach ($article->tags as $tag)
                                {{-- On utilise une balise <span> avec les classes "badge" de Bootstrap 5 --}}
                                <span class="badge rounded-pill bg-primary me-1 mb-1 fs-6 fw-normal">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="col-md-12">
                    <input type="text" class="form-control mt-2" name="tags" data-role="tagsinput">
                    @error('tags')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="d-block mb-1">Publication</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="publish" value="1" @checked(old('is_active', $article->is_active ?? true))>
                            <label class="form-check-label" for="publish">Publier</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="not_publish" value="0" @checked(old('is_active', $article->is_active ?? null) == 0)>
                            <label class="form-check-label" for="not_publish">Ne pas publier</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="d-block mb-1">Partages</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_shareable" id="share_yes"  value="1" @checked(old('is_shareable', $article->is_shareale ?? true))>
                            <label class="form-check-label" for="share_yes">Partageable</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_shareable" id="share_no" value="0" @checked(old('is_shareable', $article->is_shareable ?? null) == 0)>
                            <label class="form-check-label" for="share_no">Non partageable</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="d-block mb-1">Commentaires</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_commentable" id="comment_yes" value="1" @checked(old('is_commentable', $article->is_commentable ?? true))>
                            <label class="form-check-label" for="comment_yes">Autoriser</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_commentable" id="comment_no" value="0" @checked(old('is_commentable', $article->is_commentable ?? null) == 0)>
                            <label class="form-check-label" for="comment_no">Non autoriser</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer l'article</button>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary ms-2">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection