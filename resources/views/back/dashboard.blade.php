@extends('back.app')
@section('title', 'Dashboard-Accueil')

@section('dashboard-content')


            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                 <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Exporter</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Partager</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <i class="bi bi-calendar3"></i> Cette semaine
                    </button>
                </div>
            </div>

            <h2 class="h4 mb-4">Dashboard</h2>

            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2 stat-card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <p class="text-xs font-weight-bold text-uppercase mb-1">Total Articles</p>
                                    <h5 class="mb-0 font-weight-bold text-gray-800">
                                        {{ Auth::user()->hasRole('admin') ? $articles->count() : $author_articles }}
                                    </h5>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-file-earmark-text card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2 stat-card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <p class="text-xs font-weight-bold text-uppercase mb-1">Total Catégories</p>
                                    <h5 class="mb-0 font-weight-bold text-gray-800">{{ $categories }}</h5>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-tags card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2 stat-card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <p class="text-xs font-weight-bold text-uppercase mb-1">Total Commentaires</p>
                                    <h5 class="mb-0 mr-3 font-weight-bold text-gray-800">1538</h5>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-chat-dots card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2 stat-card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <p class="text-xs font-weight-bold text-uppercase mb-1">Abonnements</p>
                                    <h5 class="mb-0 font-weight-bold text-gray-800">364</h5>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-person-check card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Articles récents</h6>
                    <a href="{{ route('article.index') }}" class="btn btn-sm btn-primary">Voir tous</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Titre</th>
                                    <th>Catégories</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recent_articles as $article)
                                    <tr>
                                        <td><img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/80x40?text=Image' }}" alt="Article Image" class="img-fluid" style="width: 80px; height: 40px;"></td>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->category ? $article->category->name : 'Non spécifié' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun article trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

@endsection