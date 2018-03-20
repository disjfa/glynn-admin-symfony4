# Front end

## Webpack encore

The front end assets are built with [webpack encore](https://symfony.com/doc/current/frontend.html).

The assets are built using the config in `webpack.config.js`. Quick peek:

```javascript
  // will create public/build/app.js and public/build/app.css
Encore
  .addEntry('admin', './assets/admin/js/admin.js')
  .addEntry('site', './assets/site/js/site.js')
``` 
Are built to:
```
public/build/admin.css
public/build/admin.js
public/build/site.css
public/build/site.js
public/build/manifest.json
```
The `manifest.json` file is used in `config/packages/framework.yaml` so we can enable versioning in the files, 
[explained here](https://symfony.com/doc/current/frontend/encore/versioning.html).

In the js files for the `admin` and `site` there is a basic setup using bootstrap and vuejs. This can be used in bundles if you like.

Files can be created, and watched, by this command:
```
npm run dev
```
Or be built for production running:
```
npm run production
```

## Favicon

Also, a favicon. Not one, many. To get started as a "progressive web app". Add a `manifest.json` to your meta tags
and generate all the meta tags needed for a nice user experience who add your website to their homescreen
of their mobile phone.

There is a script to generate them all. Using [gulp](https://gulpjs.com/) and [favicons](https://www.npmjs.com/package/favicons).
The basic image is:
```
assets/logo.png
```
And with that we run this command to generate all files.
```
npm run favicons
```
This will build all the files in `public/icons`

## Service worker

We also have a [service worker](https://developers.google.com/web/fundamentals/primers/service-workers/).
This will index and cache you client files like css and javascript. There is one extra file:
```
assets/sw.js
```
This is a simple setup which will also cache a `/offline.html` route. And display this when a device is not online and has already
loaded the site once. This can be useful to not show a `server is not responding` message when a device is offline.

The basic route is loaded in the `HomeController`. When installing and using this bundle, please keep the route alive
to let a user see an offline page, when offline. Here you can add more than just a message. It is cached on the client side.

## Usage

The basic setup uses a couple of features.

* [webpack encore](https://symfony.com/doc/current/frontend.html)
* [bootstrap](http://getbootstrap.com)
* [font awesome](http://fontawesome.com)
* [glynn-admin](https://github.com/disjfa/glynn-admin)
* [ryoko-headers](https://github.com/disjfa/ryoko-headers)

