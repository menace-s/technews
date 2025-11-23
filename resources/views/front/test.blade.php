@extends('front.app')
@section('title', 'Accueil - ActuNews')
@section('content')

@include('front.partials.slider')
<div class="container mx-auto px-4 py-12">
    
    {{-- En-tête de la page --}}
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Découvrez nos Articles
        </h1>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">
            Explorez notre contenu et trouvez exactement ce qui vous intéresse
        </p>
    </div>

    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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
                        @if($article->category)
                            <div class="absolute top-4 left-4">
                                <span class="bg-white/90 backdrop-blur-sm text-green-600 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $article->category->name }}
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
                            
                            @if($article->user)
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>{{ $article->user->name }}</span>
                                </div>
                            @endif
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
                        <a href="{{ route('article.detail', $article->slug) }}" 
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

</div>
@endsection