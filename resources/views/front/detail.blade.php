@extends('front.app')
@section('title', $article->title)

@section('content')
<div class="container mx-auto px-4 py-12">
    
    {{-- Fil d'ariane --}}
    <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-8">
        <a href="{{ route('home') }}" class="hover:text-green-600 transition-colors">Accueil</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        @if($article->category)
            <a href="{{ route('category.article', $article->category->slug) }}" class="hover:text-green-600 transition-colors">
                {{ $article->category->name }}
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        @endif
        <span class="text-gray-400">{{ Str::limit($article->title, 50) }}</span>
    </nav>

    <div class="max-w-4xl mx-auto">
        
        {{-- En-tête de l'article --}}
        <header class="mb-8">
            {{-- Catégorie et temps de lecture --}}
            <div class="flex items-center space-x-4 mb-4">
                @if($article->category)
                    <a href="{{ route('category.show', $article->category->slug) }}" 
                       class="bg-green-100 text-green-600 px-4 py-1 rounded-full text-sm font-semibold hover:bg-green-200 transition-colors">
                        {{ $article->category->name }}
                    </a>
                @endif
                <span class="text-gray-500 text-sm flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ ceil(str_word_count(strip_tags($article->description)) / 200) }} min de lecture</span>
                </span>
            </div>

            {{-- Titre --}}
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $article->title }}
            </h1>

            {{-- Extrait --}}
            @if($article->excerpt)
                <p class="text-xl text-gray-600 leading-relaxed mb-6">
                    {{ $article->excerpt }}
                </p>
            @endif

            {{-- Meta informations --}}
            <div class="flex items-center justify-between py-6 border-t border-b border-gray-200">
                <div class="flex items-center space-x-4">
                    {{-- Date de publication --}}
                    <div class="flex items-center space-x-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">{{ $article->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                {{-- Boutons de partage --}}
                <div class="flex items-center space-x-3">
                    <button class="w-10 h-10 rounded-full bg-gray-100 hover:bg-green-100 text-gray-600 hover:text-green-600 transition-colors flex items-center justify-center" title="Partager sur Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </button>
                    <button class="w-10 h-10 rounded-full bg-gray-100 hover:bg-green-100 text-gray-600 hover:text-green-600 transition-colors flex items-center justify-center" title="Partager sur Twitter">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </button>
                    <button class="w-10 h-10 rounded-full bg-gray-100 hover:bg-green-100 text-gray-600 hover:text-green-600 transition-colors flex items-center justify-center" title="Copier le lien">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        {{-- Image principale --}}
        @if($article->image)
            <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl">
                <img src="{{ asset('storage/' . $article->image) }}" 
                     alt="{{ $article->title }}"
                     class="w-full h-auto">
            </div>
        @endif

        {{-- Contenu de l'article --}}
        <article class="prose prose-lg max-w-none mb-12">
            <div class="text-gray-800 leading-relaxed">
                {!! $article->description !!}
            </div>
        </article>

        {{-- Navigation article précédent/suivant --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 pt-8 border-t border-gray-200">
            @if($previousArticle = \App\Models\Article::where('id', '<', $article->id)->orderBy('id', 'desc')->first())
                <a href="{{ route('article.show', $previousArticle->slug) }}" 
                   class="group bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-xl hover:shadow-lg transition-all">
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        <span>Article précédent</span>
                    </div>
                    <h4 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors">
                        {{ Str::limit($previousArticle->title, 60) }}
                    </h4>
                </a>
            @endif

            @if($nextArticle = \App\Models\Article::where('id', '>', $article->id)->orderBy('id', 'asc')->first())
                <a href="{{ route('article.show', $nextArticle->slug) }}" 
                   class="group bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-xl hover:shadow-lg transition-all text-right">
                    <div class="flex items-center justify-end space-x-2 text-sm text-gray-500 mb-2">
                        <span>Article suivant</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors">
                        {{ Str::limit($nextArticle->title, 60) }}
                    </h4>
                </a>
            @endif
        </div>

        {{-- Section articles similaires --}}
        @if($article->category)
            @php
                $relatedArticles = $article->category->articles()
                    ->where('id', '!=', $article->id)
                    ->take(3)
                    ->get();
            @endphp

            @if($relatedArticles->count() > 0)
                <section class="pt-12 border-t border-gray-200">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Articles similaires</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedArticles as $related)
                            <a href="{{ route('article.show', $related->slug) }}" 
                               class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all">
                                <div class="h-40 bg-gradient-to-br from-green-100 to-green-200 overflow-hidden">
                                    @if($related->image)
                                        <img src="{{ asset('storage/' . $related->image) }}" 
                                             alt="{{ $related->title }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors line-clamp-2">
                                        {{ $related->title }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-2">
                                        {{ $related->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        @endif

    </div>
</div>

{{-- Style pour le contenu de l'article --}}
@push('custom-scripts')
<style>
.prose {
    color: #374151;
}
.prose h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #111827;
}
.prose h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #1f2937;
}
.prose p {
    margin-bottom: 1.25rem;
    line-height: 1.8;
}
.prose ul, .prose ol {
    margin-left: 1.5rem;
    margin-bottom: 1.25rem;
}
.prose li {
    margin-bottom: 0.5rem;
}
.prose a {
    color: #10b981;
    text-decoration: underline;
}
.prose a:hover {
    color: #059669;
}
.prose img {
    border-radius: 1rem;
    margin: 2rem auto;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}
.prose blockquote {
    border-left: 4px solid #10b981;
    padding-left: 1.5rem;
    font-style: italic;
    color: #6b7280;
    margin: 2rem 0;
}
</style>
@endpush
@endsection