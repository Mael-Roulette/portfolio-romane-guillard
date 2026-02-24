document.addEventListener('DOMContentLoaded', function () {
  const STORAGE_KEY = 'rg_splash_seen';

  const splash = document.getElementById('splashScreen');
  const playBtn = document.getElementById('splashPlay');

  if (!splash || !playBtn) return;

  // Déjà vu cette session → masque immédiatement
  if (sessionStorage.getItem(STORAGE_KEY)) {
    hideSplashInstant(splash);
    return;
  }

  // Rendre visible + bloquer le scroll
  splash.removeAttribute('aria-hidden');
  document.body.classList.add('splash-open');

  // Clic bouton Play
  playBtn.addEventListener('click', function () {
    enterSite(splash);
  });

  // Espace ou Entrée = clic
  document.addEventListener('keydown', function (e) {
    if ((e.key === 'Enter' || e.key === ' ') && document.body.classList.contains('splash-open')) {
      e.preventDefault();
      enterSite(splash);
    }
  });

  function enterSite(splash) {
    if (splash.classList.contains('is-leaving')) return;

    splash.classList.add('is-leaving');
    // sessionStorage.setItem(STORAGE_KEY, '1');

    splash.addEventListener('animationend', function onEnd() {
      splash.removeEventListener('animationend', onEnd);
      hideSplashInstant(splash);
      document.body.classList.remove('splash-open');
    });
  }

  function hideSplashInstant(splash) {
    splash.style.display = 'none';
    splash.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('splash-open');
  }
});
