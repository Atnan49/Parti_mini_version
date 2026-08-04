// Service Worker for PARTI 2026 PWA
// ponytail: minimalist native Service Worker without external library dependencies

const CACHE_NAME = 'parti-cache-v1';
const STATIC_ASSETS = [
    '/',
    '/offline.html',
    '/manifest.json',
    '/logo.png',
    '/icon-192.png',
    '/icon-512.png'
];

// Install Event: Pre-cache core shell & offline page
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(STATIC_ASSETS);
        }).then(() => self.skipWaiting())
    );
});

// Activate Event: Clean up legacy caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== CACHE_NAME) {
                        return caches.delete(cache);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Fetch Event Strategy
self.addEventListener('fetch', (event) => {
    const request = event.request;

    // Skip non-GET requests (e.g., POST form submissions) and chrome-extension/non-http schemes
    if (request.method !== 'GET' || !request.url.startsWith('http')) {
        return;
    }

    const url = new URL(request.url);

    // Skip caching external domains (e.g., Google Forms, external APIs)
    if (url.origin !== location.origin) {
        return;
    }

    // Navigation Requests (HTML pages): Network-First, Cache Fallback -> Offline Page
    if (request.mode === 'navigate') {
        event.respondWith(
            fetch(request)
                .then((response) => {
                    if (response.status === 200) {
                        const copy = response.clone();
                        caches.open(CACHE_NAME).then((cache) => cache.put(request, copy));
                    }
                    return response;
                })
                .catch(() => {
                    return caches.match(request).then((cachedResponse) => {
                        if (cachedResponse) {
                            return cachedResponse;
                        }
                        return caches.match('/offline.html');
                    });
                })
        );
        return;
    }

    // Static Assets (CSS, JS, Images, Fonts): Stale-While-Revalidate
    event.respondWith(
        caches.match(request).then((cachedResponse) => {
            const fetchPromise = fetch(request).then((networkResponse) => {
                if (networkResponse.status === 200) {
                    const copy = networkResponse.clone();
                    caches.open(CACHE_NAME).then((cache) => cache.put(request, copy));
                }
                return networkResponse;
            }).catch(() => cachedResponse);

            return cachedResponse || fetchPromise;
        })
    );
});
