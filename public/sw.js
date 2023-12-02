const preLoad = function() {
    return caches.open("offline").then(function(cache) {
        // caching index and important routes
        return cache.addAll(filesToCache);
    });
};

self.addEventListener("install", function(event) {
    event.waitUntil(preLoad());
});

const filesToCache = [
    '/',
    '/offline.html'
];

const checkResponse = function(request) {
    return new Promise(function(fulfill, reject) {
        fetch(request).then(function(response) {
            if (response.status !== 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};
const addToCache = function(request) {
    if (request.url.includes('/assets/ghost.svg')) {
        return caches.open("offline").then(function(cache) {
            return fetch(request).then(function(response) {
                return cache.put(request, response.clone());
            });
        });
    } else {
        // For other resources, use the default caching behavior
        return caches.open("offline").then(function(cache) {
            return fetch(request).then(function(response) {
                // Cache other resources using the default behavior
                if (!response || response.status !== 200 || response.type !== 'basic') {
                    return response;
                }

                const clonedResponse = response.clone();
                cache.put(request, clonedResponse);
                return response;
            });
        });
    }
};

const returnFromCache = function(request) {
    return caches.open("offline").then(function(cache) {
        return cache.match(request).then(function(matching) {
            if (!matching || matching.status === 404) {
                return cache.match("offline.html");
            } else {
                return matching;
            }
        });
    });
};

self.addEventListener("fetch", function(event) {
    event.respondWith(checkResponse(event.request).catch(function() {
        return returnFromCache(event.request);
    }));
    if (!event.request.url.startsWith('http')) {
        event.waitUntil(addToCache(event.request));
    }
});