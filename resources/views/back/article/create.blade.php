@extends('back.app')

@section('title', 'Dashboard - Ajouter un article')

@section('dashboard-content')
<div class="container-fluid pt-4 px-4">
    <div class="card shadow">
        <div class="card-header bg-light">
            <h5 class="mb-0">Modifier un article</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="title" class="form-label">Titre de l'article</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Titre de l'article" required>
                    </div>
                    <div class="col-md-4">
                        <label for="category_id" class="form-label">Catégorie</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">-- Sélectionnez une catégorie --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="image" class="form-label">Uploader une image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="6" class="form-control" placeholder="Entrez le contenu de l'article..." required></textarea>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="d-block mb-1">Publication</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="publish" value="1" checked>
                            <label class="form-check-label" for="publish">Publier</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="not_publish" value="0">
                            <label class="form-check-label" for="not_publish">Ne pas publier</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="d-block mb-1">Partages</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_shareable" id="share_yes" value="1" checked>
                            <label class="form-check-label" for="share_yes">Partageable</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_shareable" id="share_no" value="0">
                            <label class="form-check-label" for="share_no">Non partageable</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="d-block mb-1">Commentaires</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_commentable" id="comment_yes" value="1" checked>
                            <label class="form-check-label" for="comment_yes">Autoriser</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_commentable" id="comment_no" value="0">
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
