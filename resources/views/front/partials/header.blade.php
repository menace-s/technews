{{-- 1. On ajoute "relative" ici pour que le menu "absolute" se positionne par rapport au header --}}
<header x-data="{ open: false }" class="relative p-4 mb-4">
    <div class="fixed z-50 top-3 right-0 left-0 container mx-auto px-6">
        <nav class="bg-white/80 backdrop-blur-sm rounded-full border-1 border-solid border-gray-300 shadow-lg px-6 py-3 flex items-center justify-between">
            
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <span class="bg-gradient-to-br from-lime-300 to-green-500 rounded-full w-8 h-8 flex items-center justify-center text-white font-bold text-xl">
                    G
                </span>
                <span class="text-2xl font-bold text-gray-800">Agrob</span>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-500 transition-colors">Home</a>
                <a href="#" class="text-gray-600 hover:text-green-500 transition-colors">About</a>
                <a href="#" class="text-gray-600 hover:text-green-500 transition-colors">Service</a>
                <a href="#" class="text-gray-600 hover:text-green-500 transition-colors">Blog</a>
            </div>

            <a href="#" class="hidden md:flex bg-green-500 hover:bg-green-600 text-white rounded-full px-6 py-2 items-center space-x-2 transition-transform hover:scale-105">
                <span>Contact</span>
                {{-- <span class="bg-white/30 rounded-full w-5 h-5 flex items-center justify-center text-xs">?</span> --}}
            </a>

            <div class="md:hidden">
                <button @click="open = !open" class="focus:outline-none">
                    <svg class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </nav>

        {{-- 2. On ajoute les classes pour le positionnement et le z-index --}}
        <div x-show="open" 
             @click.away="open = false" 
             class="absolute z-50 left-0 w-full md:hidden mt-3 bg-white rounded-xl shadow-lg overflow-hidden">
            {{-- Le reste du contenu du menu ne change pas --}}
            <a href="{{ route('home') }}" class="block px-4 py-3 text-gray-600 hover:bg-gray-100">Home</a>
            <a href="#" class="block px-4 py-3 text-gray-600 hover:bg-gray-100">About</a>
            <a href="#" class="block px-4 py-3 text-gray-600 hover:bg-gray-100">Service</a>
            <a href="#" class="block px-4 py-3 text-gray-600 hover:bg-gray-100">Blog</a>
            <a href="#" class="block px-4 py-3 bg-green-50 text-green-600 font-semibold hover:bg-green-100">Contact</a>
        </div>
    </div>
</header>