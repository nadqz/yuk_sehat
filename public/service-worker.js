// Ini adalah Service Worker sederhana agar website bisa diinstal (PWA)
self.addEventListener('fetch', function(event) {
    // Tetap biarkan browser mengambil data seperti biasa
    event.respondWith(fetch(event.request));
});