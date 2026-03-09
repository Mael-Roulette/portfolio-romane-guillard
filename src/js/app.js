document.addEventListener('DOMContentLoaded', function () {
  /**
   * Gère l'ouverture et fermeture du menu mobile
   */
  function setupMenuToggle () {
    const modalTriggers = document.querySelectorAll( '.modal-trigger' );

    modalTriggers.forEach( trigger => {
      trigger.addEventListener( 'click', function () {
        const targetId = this.getAttribute( 'data-target' );
        const targetElement = document.getElementById( targetId );

        // Toggle des classes
        this.classList.toggle( 'opened' );
        targetElement.classList.toggle( 'opened' );

        // Empêcher le défilement du body quand le menu est ouvert
        document.body.classList.toggle( 'menu-open' );
      } );
    } );

    // Fermer le menu avec la touche Escape
    document.addEventListener( 'keydown', function ( e ) {
      if ( e.key === 'Escape' ) {
        const openedMenus = document.querySelectorAll( '.header-menu-wrapper.opened' );
        const openedToggles = document.querySelectorAll( '.header-toggle.opened' );

        openedMenus.forEach( menu => menu.classList.remove( 'opened' ) );
        openedToggles.forEach( toggle => toggle.classList.remove( 'opened' ) );
        document.body.classList.remove( 'menu-open' );
      }
    } );

    // Ajouter cette classe pour le style CSS qui empêche le défilement
    if ( !document.querySelector( 'style#menu-styles' ) ) {
      const styleEl = document.createElement( 'style' );
      styleEl.id = 'menu-styles';
      styleEl.textContent = 'body.menu-open { overflow: hidden; }';
      document.head.appendChild( styleEl );
    }
  }
  setupMenuToggle();

  /**
   * Gère les sliders
   */
  function initSwiperSlider() {
     /* ----- Slider bannière ----- */
       new Swiper('.banner-slider', {
          loop: true,
          autoplay: true,
          pagination: {
              el: '.banner-slider-pagination'
          },
          slidesPerView: 1,
          spaceBetween: 20,
          grabCursor: true,
       });

       /* ----- Slider bannière ----- */
         new Swiper('.home-projects-slider', {
          loop: false,
          slidesPerView: 1,
          breakpoints: {
            768: {
              slidesPerView: 2,
            },
            992: {
              slidesPerView: 3,
            },
          },
          spaceBetween: 40,
          grabCursor: true,
          pagination: {
              el: '.home-projects-slider-pagination'
          },
        });
   }
  initSwiperSlider();
} );
