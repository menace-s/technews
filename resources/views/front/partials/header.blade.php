<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-6">
        <nav class="flex justify-between items-center">
            <div>
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">
                    ActuNews
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="" class="text-gray-600 hover:text-blue-500">Accueil</a>
                <a href="" class="text-gray-600 hover:text-blue-500">Catégories</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">À Propos</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">Contact</a>
            </div>
            <div>
                @auth
                    {{-- L'utilisateur est connecté --}}
                    <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Dashboard</a>
                @else
                    {{-- L'utilisateur n'est pas connecté --}}
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-500">Connexion</a>
                    <a href="{{ route('register') }}" class="ml-4 bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Inscription</a>
                @endauth
            </div>
        </nav>
    </div>
</header>