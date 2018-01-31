# Menu items

When you build a bundle or extend the admin you can use an event to add your routes to the menu.
In `config/services.yaml` you can check some examples. For the menu's there are two events;

One for an admin menu item.

```
glynn_admin.menu_configure
```

And one for a site menu item.

```
glynn_site.menu_configure
```

A quick example can be seen here.

```yaml
App\Menu\Site\HomeMenuListener:
    autowire: true
    tags:
        - { name: 'kernel.event_listener', event: 'glynn_site.menu_configure', method: 'onMenuConfigure', priority: 999 }
```

Add a kernel event, and setup a
* name
* event
* method
* priority

Name is the listener, a kernel event.

Event is the menu type.

Method is the method called on the class (here the onMenuConfigure in the HomeMenuListener class).

And the priority, 999 is first and -999 is last. So we can set up an order.

In the listener class method we have a listener like this.

```php
public function onMenuConfigure(ConfigureMenuEvent $event)
{
    $menu = $event->getMenu();

    $menu->addChild('home', [
        'route' => 'home_index',
        'label' => 'Home',
    ])->setExtra('icon', 'fa-home');
}
```

In the event we have a menu, knp menu that is. And we can add a child, in the admin it 
will get added in the sidebar and in the site menu it will be added to the navbar.