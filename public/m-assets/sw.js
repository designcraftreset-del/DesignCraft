const CACHE_NAME = 'designcraft-mobile-v2';
const STATIC_URLS = [
  '/m-assets/css/mobile-app.css',
  '/m-assets/js/mobile-app.js'
];

self.addEventListener('install', function (e) {
  e.waitUntil(
    caches.open(CACHE_NAME).then(function (cache) {
      return cache.addAll(STATIC_URLS).catch(function () {});
    }).then(function () { return self.skipWaiting(); })
  );
});

self.addEventListener('activate', function (e) {
  e.waitUntil(
    caches.keys().then(function (keys) {
      return Promise.all(keys.map(function (key) {
        if (key !== CACHE_NAME) return caches.delete(key);
      }));
    }).then(function () { return self.clients.claim(); })
  );
});

self.addEventListener('fetch', function (e) {
  if (e.request.method !== 'GET') return;
  var url = new URL(e.request.url);
  if (url.pathname.indexOf('/mobile') !== 0 && url.pathname.indexOf('/m-assets') !== 0) return;
  e.respondWith(
    caches.match(e.request).then(function (cached) {
      if (cached) return cached;
      return fetch(e.request).then(function (res) {
        var clone = res.clone();
        if (res.status === 200 && (url.pathname.indexOf('/m-assets/') === 0 || url.pathname === '/mobile/' || url.pathname === '/mobile')) {
          caches.open(CACHE_NAME).then(function (cache) { cache.put(e.request, clone); });
        }
        return res;
      }).catch(function () {
        if (e.request.destination === 'document' && url.pathname.indexOf('/mobile') === 0) {
          return caches.match('/mobile/').then(function (c) { return c || new Response('Offline', { status: 503 }); });
        }
        return new Response('', { status: 503 });
      });
    })
  );
});
