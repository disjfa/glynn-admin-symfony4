importScripts('workbox-sw.prod.v2.1.3.js');

const workbox = new WorkboxSW({
  skipWaiting: true,
  clientsClaim: true
});

self.addEventListener('install', function (event) {
  let offlineRequest = new Request('offline.html');
  event.waitUntil(
    fetch(offlineRequest).then(function (response) {
      return caches.open('offline').then(function (cache) {
        console.log('[oninstall] Cached offline page', response.url);
        return cache.put(offlineRequest, response);
      });
    })
  );
});

self.addEventListener('fetch', function (event) {
  let request = event.request;
  if (request.method === 'GET') {
    console.log(request);
    event.respondWith(
      fetch(request).catch(function (error) {
        console.error(
          '[onfetch] Failed. Serving cached offline fallback ' +
          error
        );
        return caches.open('offline').then(function (cache) {
          return cache.match('offline.html');
        });
      })
    );
  }
});

workbox.precache([
  {
    "url": "build/admin.css",
    "revision": "7da0f998932f64a507f4f30ca45d24e1"
  },
  {
    "url": "build/manifest.json",
    "revision": "a62851932679c542aafe36f16b8a5b10"
  },
  {
    "url": "build/site.css",
    "revision": "19f37b6c182df423e488a29ddf3d5bb3"
  },
  {
    "url": "icons/android-chrome-144x144.png",
    "revision": "eca21cc6ec0db98276bae8a002e22e67"
  },
  {
    "url": "icons/android-chrome-192x192.png",
    "revision": "19c8fd1d63a28654b3682bc6c328f9ca"
  },
  {
    "url": "icons/android-chrome-256x256.png",
    "revision": "f9d0133e993b1fa59e075f05e69d322a"
  },
  {
    "url": "icons/android-chrome-36x36.png",
    "revision": "7211f7214dfc13174b3674c57f784a45"
  },
  {
    "url": "icons/android-chrome-384x384.png",
    "revision": "b5fd4dda4eac8ebd63e2c7ded7c734f2"
  },
  {
    "url": "icons/android-chrome-48x48.png",
    "revision": "c91c7b122345c096f314198e6d9f45d2"
  },
  {
    "url": "icons/android-chrome-512x512.png",
    "revision": "904daefab74612e58ff4e9e74fdc0cac"
  },
  {
    "url": "icons/android-chrome-72x72.png",
    "revision": "750e1a5b05c954b8e203802fc8616071"
  },
  {
    "url": "icons/android-chrome-96x96.png",
    "revision": "ba11155a670efe48adf7de223eeffdfe"
  },
  {
    "url": "icons/apple-touch-icon-114x114.png",
    "revision": "54928922d84ada28adafc05c66f33b03"
  },
  {
    "url": "icons/apple-touch-icon-120x120.png",
    "revision": "b4c7c3fb2d7a95216e52de20fe52a685"
  },
  {
    "url": "icons/apple-touch-icon-144x144.png",
    "revision": "457101f4488d1d9212685bc4cc9bb8b1"
  },
  {
    "url": "icons/apple-touch-icon-152x152.png",
    "revision": "83a83b66b4dc4332b45d9015fe986ac4"
  },
  {
    "url": "icons/apple-touch-icon-167x167.png",
    "revision": "1a5c570a94360300c7943b08f0d9a3df"
  },
  {
    "url": "icons/apple-touch-icon-180x180.png",
    "revision": "99f4a9014cc4229d9de287cd7aaaeeb0"
  },
  {
    "url": "icons/apple-touch-icon-57x57.png",
    "revision": "1215c4aebcd72fbd09446bd15a2c42e6"
  },
  {
    "url": "icons/apple-touch-icon-60x60.png",
    "revision": "61dcb448caab3ddf0a35de477bbca429"
  },
  {
    "url": "icons/apple-touch-icon-72x72.png",
    "revision": "23f8514059db929d8584f71ff7567b32"
  },
  {
    "url": "icons/apple-touch-icon-76x76.png",
    "revision": "c02179d5c3cd487acf749fb5fa582790"
  },
  {
    "url": "icons/apple-touch-icon-precomposed.png",
    "revision": "99f4a9014cc4229d9de287cd7aaaeeb0"
  },
  {
    "url": "icons/apple-touch-icon.png",
    "revision": "99f4a9014cc4229d9de287cd7aaaeeb0"
  },
  {
    "url": "icons/apple-touch-startup-image-1182x2208.png",
    "revision": "61ca2f7a3d6f1ff2fbf8021d18989f2a"
  },
  {
    "url": "icons/apple-touch-startup-image-1242x2148.png",
    "revision": "bccfbe4a69cae3c71034372a32587711"
  },
  {
    "url": "icons/apple-touch-startup-image-1496x2048.png",
    "revision": "98b670efb65dab1a0c8cf0f31d064663"
  },
  {
    "url": "icons/apple-touch-startup-image-1536x2008.png",
    "revision": "fa13a79fa931e89e5758a15ec75f7561"
  },
  {
    "url": "icons/apple-touch-startup-image-320x460.png",
    "revision": "80164d9dad5abdd110fd781298523c15"
  },
  {
    "url": "icons/apple-touch-startup-image-640x1096.png",
    "revision": "5515a0ec7a911e400b9fbd225c026541"
  },
  {
    "url": "icons/apple-touch-startup-image-640x920.png",
    "revision": "e3421a183b29b9dc485c46713b2044ad"
  },
  {
    "url": "icons/apple-touch-startup-image-748x1024.png",
    "revision": "888560b95c8089e289fcb07417477d2c"
  },
  {
    "url": "icons/apple-touch-startup-image-750x1294.png",
    "revision": "38ef49e1c3c6cb5c7f95e5500401f252"
  },
  {
    "url": "icons/apple-touch-startup-image-768x1004.png",
    "revision": "dfed9fa6e7eb0293cf498167ea3d9ec6"
  },
  {
    "url": "icons/coast-228x228.png",
    "revision": "c04588b1f5ccc032b13db38ac0af7d62"
  },
  {
    "url": "icons/favicon-16x16.png",
    "revision": "149e2b383b708975fbf5d6b733bfb8f2"
  },
  {
    "url": "icons/favicon-32x32.png",
    "revision": "e630f56e04cca0671708118f8ceddb29"
  },
  {
    "url": "icons/firefox_app_128x128.png",
    "revision": "b9fdae10c4ffbe754ffceff1d33e27f1"
  },
  {
    "url": "icons/firefox_app_512x512.png",
    "revision": "bfae10232455a079f34c245b1e3a0982"
  },
  {
    "url": "icons/firefox_app_60x60.png",
    "revision": "91bf7bf619594f0dc944b820d351b516"
  },
  {
    "url": "icons/index.html",
    "revision": "0acc83b664092e2d9fc44ab2bc7ebc0e"
  },
  {
    "url": "icons/manifest.json",
    "revision": "6001aadf81aa49a5c6824d6baa1ecc51"
  },
  {
    "url": "icons/mstile-144x144.png",
    "revision": "eca21cc6ec0db98276bae8a002e22e67"
  },
  {
    "url": "icons/mstile-150x150.png",
    "revision": "5185742532b3f839b738ffdaf6c35605"
  },
  {
    "url": "icons/mstile-310x150.png",
    "revision": "01bd4aabeba67bfc7193fab6f2f0abda"
  },
  {
    "url": "icons/mstile-310x310.png",
    "revision": "c25ea2cd180e6b6f59d18f9e5fdebb8c"
  },
  {
    "url": "icons/mstile-70x70.png",
    "revision": "89509519c0fed4ae413fdc117cf52040"
  },
  {
    "url": "icons/yandex-browser-50x50.png",
    "revision": "910dfad725c5f99706b0148b22cb5f70"
  },
  {
    "url": "icons/yandex-browser-manifest.json",
    "revision": "3e5433b16da571f81f091ef67db398ae"
  },
  {
    "url": "sw.js",
    "revision": "fae654564239a5f0ded09b800ed576c9"
  },
  {
    "url": "workbox-sw.prod.v2.1.3.js",
    "revision": "a9890beda9e5f17e4c68f42324217941"
  },
  {
    "url": "offline.html",
    "revision": "572d4e421e5e6b9bc11d815e8a027112"
  }
]);
