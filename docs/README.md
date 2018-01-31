# Welcome to glynn admin. The symfony4 edition.

Why this got started. I like symfony, and i like projects. But to get started is tough.
When you get started you like to have a basic setup. But for a symfony projects there
are choices. Get started with the [sonata admin](https://sonata-project.org/bundles/admin/3-x/doc/index.html),
or the more recent [easy admin](https://github.com/javiereguiluz/EasyAdminBundle).

Both are awesome, but we wanted a more simple and basic setup. Use symfony like symfony works.
With even less twists.

# Let's check this thing out

Create a project.

```
composer create-project disjfa/glynn-admin-symfony4 my_project
cd my_project
```

Setup the database, basic example uses sqlite because it just works.

```
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
```

Start a server.

```
bin/console server:start
```

And build the assets.

```
npm install
npm run dev
```

And you are done, you just got a basic site with an admin. Next you have to add your own stuff.