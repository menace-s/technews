{{-- resources/views/front/partials/slider.blade.php --}}

{{-- Le conteneur principal avec une marge verticale (my-10) pour ne pas coller au header --}}
<div class="container mx-auto my-10 px-4">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center mb-8">
        <div class="text-center md:text-left">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-800 leading-tight">
                Sustainable Future Insights
            </h1>
        </div>
        <div class="text-center md:text-left">
            <p class="text-gray-600 mb-6">
                We share common trends and strategies for improving your rental making sure in high demand of service unique blocks, you can nd making sure you stay.
            </p>
            <a href="#" class="text-green-600 font-semibold inline-flex items-center group">
                Learn More
                <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>

    <div class="swiper hero-slider">
        <div class="swiper-wrapper">
            
            {{-- Slide 1 --}}
            <div class="swiper-slide">
                <img src="{{ asset('front/images/agro.jpg') }}" alt="Champ de culture durable" class="rounded-2xl w-full h-[450px] object-cover">
            </div>

            {{-- Slide 2 --}}
            <div class="swiper-slide">
                <img src="{{ asset('front/images/agro1.jpg') }}" alt="Innovation agricole" class="rounded-2xl w-full h-[450px] object-cover">
            </div>

            {{-- Slide 3 --}}
            <div class="swiper-slide">
                <img src="{{ asset('front/images/agro2.jpg') }}" alt="Méthodes de culture biologique" class="rounded-2xl w-full h-[450px] object-cover">
            </div>

        </div>
        
        <div class="swiper-pagination"></div>
    </div>