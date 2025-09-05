<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Le CSRF Token : Sécurité OBLIGATOIRE pour les formulaires --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Mon Super Site d\'Actus')</title>

    {{-- On inclut nos feuilles de style --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @include('front.partials.styles')

</head>
<body class="font-sans antialiased">

    {{-- Le Header : notre navigation principale --}}
    @include('front.partials.header')

    {{-- La Sidebar : pratique pour les catégories ou les actus récentes --}}
    {{-- On pourrait l'afficher conditionnellement, mais pour l'instant, on l'inclut --}}
    {{-- @include('front.partials.sidebar') --}}
    
    {{-- Contenu principal : C'est ici que la magie opère ! --}}
    {{-- Chaque page remplira cette section avec son propre contenu. --}}
    <main class="pt-12">
        @include('front.partials.slider')
        @yield('content')
    </main>

    {{-- Le Footer : infos de contact, liens, etc. --}}
    {{-- @include('front.partials.footer') --}}

    {{-- On inclut nos scripts JS juste avant la fin du body pour la performance --}}
    @include('front.partials.scripts')

    {{-- Zone pour des scripts spécifiques à une page --}}
    @stack('custom-scripts')

</body>
</html>