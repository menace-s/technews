import './bootstrap';

// 1. Importer Swiper et ses styles
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';


import Alpine from 'alpinejs';

// Initialiser Swiper pour notre slider
const swiper = new Swiper('.hero-slider', { // On cible la classe '.hero-slider'
    modules: [Pagination, Autoplay],
    
    // Options
    loop: true, // Pour que le slider boucle
    autoplay: {
        delay: 4000, // Défilement toutes les 4 secondes
        disableOnInteraction: false,
    },
    
    // Rendre les indicateurs cliquables
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },

    // Pour un effet de slide fluide
    effect: 'slide',
    grabCursor: true, // Affiche une icône de main au survol
    speed: 600, // Vitesse de la transition en ms
});

window.Alpine = Alpine;

Alpine.start();
