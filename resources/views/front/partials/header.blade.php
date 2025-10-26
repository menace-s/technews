{{-- Header avec menu déroulant pour les catégories --}}
<header x-data="{ open: false, categoriesOpen: false }" class="relative p-4 mb-4">
    <div class="fixed z-50 top-3 right-0 left-0 container mx-auto px-6">
        <nav class="bg-white/80 backdrop-blur-sm rounded-full border border-gray-300 shadow-lg px-8 py-4 flex items-center justify-between">
            
            {{-- Logo et nom du site --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-2 flex-shrink-0">
                <span class="bg-gradient-to-br from-lime-300 to-green-500 rounded-full w-10 h-10 flex items-center justify-center text-white font-bold text-xl">
                    {{ strtoupper(substr($settings->site_name, 0, 1)) }}
                </span>
                <span class="text-2xl font-bold text-gray-800">{{ $settings->site_name }}</span>
            </a>

            {{-- Menu desktop --}}
            <div class="hidden md:flex items-center space-x-6">
                {{-- Dropdown Catégories Desktop --}}
                <div class="relative" @click.away="categoriesOpen = false">
                    <button @click="categoriesOpen = !categoriesOpen" 
                            class="text-gray-700 hover:text-green-500 transition-colors flex items-center space-x-2 font-medium">
                        <span>Catégories</span>
                        <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': categoriesOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    {{-- Menu déroulant Desktop --}}
                    <div x-show="categoriesOpen"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute top-full left-1/2 transform -translate-x-1/2 mt-3 w-56 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden"
                         style="display: none;">
                        
                        @foreach($categories as $category)
                            <a href="{{ route('category.article', $category->slug) }}" 
                               class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                
                {{-- Bouton Contact --}}
                <a href="#contact" class="bg-green-500 hover:bg-green-600 text-white rounded-full px-6 py-2.5 font-medium transition-all transform hover:scale-105 shadow-md">
                    Contact
                </a>
            </div>

            {{-- Burger menu mobile --}}
            <div class="md:hidden">
                <button @click="open = !open" class="focus:outline-none p-2">
                    <svg x-show="!open" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </nav>

        {{-- Menu mobile --}}
        <div x-show="open" 
             @click.away="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="md:hidden mt-3 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200"
             style="display: none;">
            
            {{-- Dropdown Catégories Mobile --}}
            <div>
                <button @click="categoriesOpen = !categoriesOpen" 
                        class="w-full text-left px-6 py-4 text-gray-700 hover:bg-gray-50 flex items-center justify-between font-medium border-b border-gray-100">
                    <span>Catégories</span>
                    <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': categoriesOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                {{-- Sous-menu catégories mobile --}}
                <div x-show="categoriesOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 max-h-0"
                     x-transition:enter-end="opacity-100 max-h-96"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 max-h-96"
                     x-transition:leave-end="opacity-0 max-h-0"
                     class="bg-gray-50 overflow-hidden border-b border-gray-100"
                     style="display: none;">
                    
                    @foreach($categories as $category)
                        <a href="{{ route('category.article', $category->slug) }}" 
                           class="block px-8 py-3 text-gray-600 hover:bg-green-50 hover:text-green-600 transition-colors">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            {{-- Bouton Contact Mobile --}}
            <a href="#contact" class="block px-6 py-4 bg-green-50 text-green-600 font-semibold hover:bg-green-100 transition-colors text-center">
                Contact
            </a>
        </div>
    </div>
</header>