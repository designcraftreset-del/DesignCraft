(function () {
  'use strict';
  var toggler = document.querySelector('.m-menu-toggler');
  var nav = document.getElementById('mNav');
  var close = document.querySelector('.m-menu-close');
  if (toggler && nav) {
    toggler.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      toggler.setAttribute('aria-expanded', open);
      nav.setAttribute('aria-hidden', !open);
      document.body.style.overflow = open ? 'hidden' : '';
    });
    if (close) close.addEventListener('click', function () {
      nav.classList.remove('is-open');
      toggler.setAttribute('aria-expanded', 'false');
      nav.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    });
  }
  var lazy = document.querySelectorAll('img[data-src]');
  if (lazy.length && 'IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (!e.isIntersecting) return;
        var img = e.target;
        var src = img.getAttribute('data-src');
        if (src) { img.src = src; img.removeAttribute('data-src'); }
        io.unobserve(img);
      });
    }, { rootMargin: '50px' });
    lazy.forEach(function (img) { io.observe(img); });
  }
  var themeToggle = document.getElementById('mThemeToggle');
  var themeLabel = document.getElementById('mThemeLabel');
  function applyThemeLabel() {
    if (!themeLabel) return;
    themeLabel.textContent = document.body.classList.contains('m-theme-light') ? 'светлая' : 'тёмная';
  }
  if (themeToggle) {
    applyThemeLabel();
    themeToggle.addEventListener('click', function () {
      document.body.classList.toggle('m-theme-light');
      try { localStorage.setItem('m_theme', document.body.classList.contains('m-theme-light') ? 'light' : 'dark'); } catch (e) {}
      applyThemeLabel();
    });
  }
  var supportChatToggle = document.getElementById('support-chat-toggle');
  if (supportChatToggle) {
    supportChatToggle.addEventListener('click', function (e) {
      e.preventDefault();
      var nav = document.getElementById('mNav');
      if (nav) nav.classList.remove('is-open');
      var toggler = document.querySelector('.m-menu-toggler');
      if (toggler) toggler.setAttribute('aria-expanded', 'false');
    });
  }
})();
