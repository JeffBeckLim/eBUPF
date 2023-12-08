const filesToCache = [
    '/',
    '/offline.html',
];

self.addEventListener("install", function(event) {
    event.waitUntil(
        caches.open("offline").then(function(cache) {
            return cache.addAll(filesToCache);
        })
    );
});

self.addEventListener("fetch", function(event) {
    if (event.request.mode === 'navigate' || (event.request.method === 'GET' && event.request.headers.get('accept').includes('text/html'))) {
        event.respondWith(
            fetch(event.request).catch(function() {
                return caches.match('/offline.html');
            })
        );
    } else {
        event.respondWith(
            caches.match(event.request).then(function(response) {
                return response || fetch(event.request);
            })
        );
    }
});
