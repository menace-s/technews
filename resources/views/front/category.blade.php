@extends('front.app')

@section('title', $category->name . ' - Articles')

@section('content')
<div class="container mx-auto px-4 py-12">
    
    {{-- Fil d'ariane --}}
    <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-8">
        <a href="{{ route('home') }}" class="hover:text-green-600 transition-colors">Accueil</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-400">{{ $category->name }}</span>
    </nav>

    {{-- En-tête de la catégorie --}}
    <div class="text-center mb-16">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl mb-6 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
        </div>
        
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            {{ $category->name }}
        </h1>
        
        @if($category->description)
            <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-6">
                {{ $category->description }}
            </p>
        @endif
        
        <div class="inline-flex items-center space-x-2 text-green-600 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span>{{ $articles->total() }} article{{ $articles->total() > 1 ? 's' : '' }}</span>
        </div>
    </div>

    {{-- Grille d'articles --}}
    @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($articles as $article)
                <article class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    {{-- Image de l'article --}}
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-green-100 to-green-200">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" 
                                 alt="{{ $article->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-20 h-20 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Badge catégorie --}}
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-sm text-green-600 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $category->name }}
                            </span>
                        </div>

                        {{-- Badge "Nouveau" pour articles récents (moins de 7 jours) --}}
                        @if($article->created_at->diffInDays(now()) < 7)
                            <div class="absolute top-4 right-4">
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold animate-pulse">
                                    Nouveau
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Contenu de l'article --}}
                    <div class="p-6">
                        {{-- Meta informations --}}
                        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-3">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                            
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min</span>
                            </div>
                        </div>

                        {{-- Titre --}}
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-green-600 transition-colors">
                            {{ $article->title }}
                        </h3>

                        {{-- Extrait --}}
                        @if($article->excerpt)
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ $article->excerpt }}
                            </p>
                        @endif

                        {{-- Lien de lecture --}}
                        <a href="{{ route('article.show', $article->slug) }}" 
                           class="inline-flex items-center space-x-2 text-green-600 font-semibold hover:text-green-700 group/link">
                            <span>Lire l'article</span>
                            <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="flex justify-center">
            {{ $articles->links() }}
        </div>

        {{-- Message si dernière page --}}
        @if($articles->currentPage() === $articles->lastPage() && $articles->lastPage() > 1)
            <div class="text-center mt-8 text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p>Vous avez vu tous les articles de cette catégorie</p>
            </div>
        @endif
    @else
        {{-- Aucun article dans cette catégorie --}}
        <div class="text-center py-20">
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-3xl p-16 max-w-2xl mx-auto">
                <svg class="w-24 h-24 text-green-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Aucun article disponible</h3>
                <p class="text-gray-600 mb-8">Cette catégorie ne contient pas encore d'articles.</p>
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center space-x-2 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full font-semibold transition-all transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Retour à l'accueil</span>
                </a>
            </div>
        </div>
    @endif

    {{-- Autres catégories --}}
    @if($otherCategories->count() > 0)
        <section class="mt-20 pt-12 border-t border-gray-200">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Explorer d'autres catégories</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($otherCategories as $otherCategory)
                    <a href="{{ route('category.article', $otherCategory->slug) }}" 
                       class="group bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 p-6 rounded-xl text-center transition-all transform hover:scale-105 hover:shadow-lg">
                        <div class="w-12 h-12 bg-white rounded-full mx-auto mb-3 flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors">
                            {{ $otherCategory->name }}
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $otherCategory->articles_count }} article{{ $otherCategory->articles_count > 1 ? 's' : '' }}
                        </p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

</div>
@endsection