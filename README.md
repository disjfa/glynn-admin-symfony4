# glynn admin symfony4

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

```
bin/console server:start
```

## The basic setup

We use [symfony](https://symfony.com) with these recepies:

* orm
* twig
* security
* var-dumper
* server
* security

Next we add these bundles

* [FOS user](https://github.com/FriendsOfSymfony/FOSUserBundle)
* [KNP menu](https://github.com/KnpLabs/KnpMenu)

Clean code

* [php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

Site bundles, lets npm/yarn

* [webpack encore](https://symfony.com/doc/current/frontend.html)
* [bootstrap](http://getbootstrap.com)
* [font awesome](http://fontawesome.io)
* [glynn-admin](https://github.com/disjfa/glynn-admin)
* [ryoko-headers](https://github.com/disjfa/ryoko-headers)

