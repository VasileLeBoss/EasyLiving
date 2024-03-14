function toggleUserMenu(event) {
    event.stopPropagation(); // Empêche la propagation de l'événement pour éviter de déclencher le gestionnaire d'événements global

    var userMenu = document.getElementById('userMenu');
    userMenu.classList.toggle('user-menu-show');
}

// Cacher le menu si l'utilisateur clique en dehors du menu
document.addEventListener('click', function(event) {
    var userMenu = document.getElementById('userMenu');
    var userElement = document.getElementById('user');
    
    if (event.target.closest('.user') !== userElement && !userMenu.contains(event.target)) {
        userMenu.classList.remove('user-menu-show');
    }
});


document.addEventListener('DOMContentLoaded', function () {
    var menuButton = document.querySelector('.menu');
    var menu = document.querySelector('.menu-items');
    var body = document.body;
    var html = document.documentElement;

    menuButton.addEventListener('click', function () {
        menu.classList.toggle('show-menu');

        // Ajouter ou supprimer la classe 'no-scroll' au body et à html
        body.classList.toggle('no-scroll', menu.classList.contains('show-menu'));
        html.classList.toggle('no-scroll', menu.classList.contains('show-menu'));
    });

});


var header = document.querySelector('.header-grid');

document.addEventListener('scroll', function () {
    var scrollPosition = window.scrollY || document.documentElement.scrollTop;

    // Ajoutez ou supprimez la classe sticky en fonction de la position de défilement
    if (scrollPosition > 0) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
});


