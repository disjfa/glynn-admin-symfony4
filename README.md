# glynn admin symfony4

[![Check on packagist][packagist-badge]][packagist]
[![MIT License][license-badge]][LICENSE]

[![Watch on GitHub][github-watch-badge]][github-watch]
[![Star on GitHub][github-star-badge]][github-star]
[![Tweet][twitter-badge]][twitter]

Basic starter template using symfony4.

## Instalation

```
composer create-project disjfa/glynn-admin-symfony4 my_project
cd my_project
```

## Create database

```
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
```

## Generate site assets

```
npm install
npm run dev
```

## Serve

Start a server using the [symfony commandline tool](https://symfony.com/download)

```
symfony server:start -d
```

## The basic setup

We use [symfony](https://symfony.com) with these recepies:

* orm
* twig
* security
* var-dumper
* server
* security
* make

Next we add these bundles

* [KNP menu](https://github.com/KnpLabs/KnpMenu)

Clean code

* [php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

Site bundles, lets npm/yarn

* [webpack encore](https://symfony.com/doc/current/frontend.html)
* [bootstrap](http://getbootstrap.com)
* [font awesome](http://fontawesome.io)
* [glynn-admin](https://github.com/disjfa/glynn-admin)
* [ryoko-headers](https://github.com/disjfa/ryoko-headers)

[packagist-badge]: https://img.shields.io/packagist/v/disjfa/glynn-admin-symfony4
[packagist]: https://packagist.org/packages/disjfa/glynn-admin-symfony4
[license]: https://github.com/disjfa/glynn-admin-symfony4/blob/master/LICENSE
[license-badge]: https://img.shields.io/github/license/disjfa/glynn-admin-symfony4.svg
[github-watch-badge]: https://img.shields.io/github/watchers/disjfa/glynn-admin-symfony4.svg?style=social
[github-watch]: https://github.com/disjfa/glynn-admin-symfony4/watchers
[github-star-badge]: https://img.shields.io/github/stars/disjfa/glynn-admin-symfony4.svg?style=social
[github-star]: https://github.com/disjfa/glynn-admin-symfony4/stargazers
[twitter-badge]: https://img.shields.io/twitter/url/https/github.com/disjfa/glynn-admin-symfony4.svg?style=social
[twitter]: https://twitter.com/intent/tweet?text=Check%20out%20glynn-admin-symfony4!%20-%20Cool%mail%20setup%20for%20symfony!%20Thanks%20@disjfa%20https://github.com/disjfa/glynn-admin-symfony4%20%F0%9F%A4%97
