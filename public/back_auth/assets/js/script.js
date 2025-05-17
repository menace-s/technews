// js/script.js
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle'); // Bouton sur la navbar mobile
    const mainContent = document.querySelector('.main-content');

    // Fonction pour appliquer l'état initial de la sidebar
    function applyInitialSidebarState() {
        if (!sidebar || !mainContent) return;

        if (window.innerWidth > 767.98) { // Grands écrans
            if (localStorage.getItem('sidebarActive') === 'false') {
                sidebar.classList.remove('active');
                mainContent.classList.remove('sidebar-active');
            } else { // Par défaut ou si 'true'
                sidebar.classList.add('active');
                mainContent.classList.add('sidebar-active');
            }
        } else { // Petits écrans
            sidebar.classList.remove('active');
            mainContent.classList.remove('sidebar-active');
        }
    }

    // Appliquer l'état initial au chargement
    applyInitialSidebarState();

    // Gestion du clic sur le bouton de bascule
    if (sidebarToggle && sidebar && mainContent) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            // Sur les grands écrans, le main-content a une marge.
            // Sur les petits écrans, la sidebar se superpose, donc pas de marge pour main-content.
            if (window.innerWidth > 767.98) {
                mainContent.classList.toggle('sidebar-active', sidebar.classList.contains('active'));
            } else {
                 mainContent.classList.remove('sidebar-active'); // Assurer pas de marge sur mobile
            }

            // Sauvegarder l'état pour les grands écrans uniquement
            if (window.innerWidth > 767.98) {
                localStorage.setItem('sidebarActive', sidebar.classList.contains('active'));
            }
        });
    }

    // Réappliquer l'état lors du redimensionnement pour gérer les transitions mobile/desktop
    window.addEventListener('resize', function() {
        // Un léger délai pour s'assurer que le DOM est stable après redimensionnement
        setTimeout(applyInitialSidebarState, 100);
    });

    // Initialisation des tooltips Bootstrap (si vous en utilisez)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});