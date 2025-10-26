{{-- Header avec menu déroulant pour les catégories --}}
<header x-data="{ open: false, categoriesOpen: false }" class="relative p-4 mb-4">
    <div class="fixed z-50 top-3 right-0 left-0 container mx-auto px-6">
        <nav class="bg-white/80 backdrop-blur-sm rounded-full border-1 border-solid border-gray-300 shadow-lg px-6 py-3 flex items-center justify-between">
            
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <span class="bg-gradient-to-br from-lime-300 to-green-500 rounded-full w-8 h-8 flex items-center justify-center text-white font-bold text-xl">
                    {{ strtoupper(substr($settings->site_name, 0, 1)) }}
                </span>
                <span class="text-2xl font-bold text-gray-800">{{ $settings->site_name }}</span>
            </a>

            {{-- Menu desktop --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-500 transition-colors">Home</a>
                <a href="#" class="text-gray-600 hover:text-green-500 transition-colors">About</a>
                
                {{-- Dropdown Catégories Desktop --}}
                <div class="relative" @click.away="categoriesOpen = false">
                    <button @click="categoriesOpen = !categoriesOpen" 
                            class="text-gray-600 hover:text-green-500 transition-colors flex items-center space-x-1">
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
                         class="absolute top-full mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden"
                         style="display: none;">
                        
                        @foreach($categories as $category)
                            <a href="{{ route('category.show', $category->slug) }}" 
                            class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <a href="#" class="text-gray-600 hover:text-green-500 transition-colors">Service</a>
                <a href="#" class="text-gray-600 hover:text-green-500 transition-colors">Blog</a>
            </div>

            <a href="#" class="hidden md:flex bg-green-500 hover:bg-green-600 text-white rounded-full px-6 py-2 items-center space-x-2 transition-transform hover:scale-105">
                <span>Contact</span>
            </a>

            {{-- Burger menu mobile --}}
            <div class="md:hidden">
                <button @click="open = !open" class="focus:outline-none">
                    <svg class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
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
             class="absolute z-50 left-0 w-full md:hidden mt-3 bg-white rounded-xl shadow-lg overflow-hidden"
             style="display: none;">
            
            <a href="{{ route('home') }}" class="block px-4 py-3 text-gray-600 hover:bg-gray-100">Home</a>
            <a href="#" class="block px-4 py-3 text-gray-600 hover:bg-gray-100">About</a>
            
            {{-- Dropdown Catégories Mobile --}}
            <div class="border-t border-gray-100">
                <button @click="categoriesOpen = !categoriesOpen" 
                        class="w-full text-left px-4 py-3 text-gray-600 hover:bg-gray-100 flex items-center justify-between">
                    <span>Catégories</span>
                    <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': categoriesOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                     class="bg-gray-50 overflow-hidden"
                     style="display: none;">
                    
                    @foreach($categories as $category)
                        <a href="{{ route('category.show', $category->slug) }}" 
                        class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <a href="#" class="block px-4 py-3 text-gray-600 hover:bg-gray-100">Service</a>
            <a href="#" class="block px-4 py-3 text-gray-600 hover:bg-gray-100">Blog</a>
            <a href="#" class="block px-4 py-3 bg-green-50 text-green-600 font-semibold hover:bg-green-100">Contact</a>
        </div>
    </div>
</header>