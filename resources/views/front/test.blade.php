@extends('front.app')
@section('title', 'Page de Test')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Bienvenue sur la page de test</h1>
        <p class="mb-4">Ceci est une page de test pour vérifier l'intégration de Blade avec Tailwind CSS.</p>
        <p>
            I’m Derek, an astro-engineer based in Tattooine. I like to build X-Wings
            at <a class="underline decoration-sky-500">My Company, Inc</a>. Outside
            of work, I like to <a class="underline decoration-pink-500">watch pod-racing</a>
            and have <a class="underline decoration-indigo-500">light-saber</a> fights.
        </p>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-semibold mb-4">Exemple de Carte</h2>
            <p class="text-gray-700 ">Voici un exemple de carte stylisée avec Tailwind CSS. Vous pouvez ajouter plus de contenu ici selon vos besoins.</p>
            <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cliquez Moi</button>
        </div>
    </div>
@endsection