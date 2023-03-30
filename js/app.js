$(function () {

    // Carrusel izquierda
    if ($('.owl-2').length > 0) {
        $('.owl-2').owlCarousel({
            center: false,
            items: 1,
            loop: true,
            stagePadding: false,
            margin: 10,
            smartSpeed: 1000,
            autoplay: true,
            nav: false,
            dots: true,
            pauseOnHover: false,
            responsive: {
                600: {
                    margin: 20,
                    nav: false,
                    items: 2
                },
                1000: {
                    margin: 20,
                    // stagePadding: 0,
                    nav: false,
                    items: 3
                }
            }
        });
    }
    // Carrusel derecha
    if ($('.owl-2-right').length > 0) {
        $('.owl-2-right').owlCarousel({
            center: false,
            items: 1,
            rtl: true,
            loop: true,
            stagePadding: 0,
            margin: 10,
            smartSpeed: 1000,
            autoplay: true,
            nav: false,
            dots: true,
            pauseOnHover: false,
            responsive: {
                600: {
                    margin: 20,
                    nav: false,
                    items: 2
                },
                1000: {
                    margin: 20,
                    stagePadding: 0,
                    nav: false,
                    items: 3
                }
            }
        });
    }
    ScrollReveal().reveal('.headline', { duration: 1000, distance: '60px', opacity: 0 });

})