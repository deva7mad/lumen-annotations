# Lumen Annotations

[![Latest Stable Version](https://poser.pugx.org/deva7mad/lumen-annotations/v/stable)](https://packagist.org/packages/deva7mad/lumen-annotations) [![Total Downloads](https://poser.pugx.org/deva7mad/lumen-annotations/downloads)](https://packagist.org/packages/deva7mad/lumen-annotations) [![Latest Unstable Version](https://poser.pugx.org/deva7mad/lumen-annotations/v/unstable)](https://packagist.org/packages/deva7mad/lumen-annotations) [![License](https://poser.pugx.org/deva7mad/lumen-annotations/license)](https://packagist.org/packages/deva7mad/lumen-annotations)

This package enables annotations in Laravel Lumen to define routes and event bindings.

## Installation 

Lumen Annotations is distributed as a composer package. So you first have to run the following command

```
composer require deva7mad/lumen-annotations
```

After that copy `config/annotations.php` from this package to your configuration directory.

Finally: Add this lines to `bootstrap/app.php` file:

```
$app->configure('annotations');
$app->register(DevA7mad\Annotations\AnnotationsServiceProvider::class);
```


##### Include generated routes

Once you have run `php artisan route:scan` (NOTE: see below Examples), you have to include the generated `routes.php` file in your `bootstrap/app.php` file:

```php
require __DIR__.'/../storage/framework/routes.php';
```

## Usage

By using annotations you can define your routes directly in your controller classes and your event bindings directly in your event handlers (see examples for usage of annotations).

##### Class Annotations

For routes:

Annotation | Description
--- | ---
`@Controller` | This annotation must be set to indicate that the class is a controller class. Optional parameters `prefix` and `middleware`.
`@Resource` | First parameter is resource name. Optional parameters `only` and `except`.
`@Middleware` | First parameter is middleware name.

For events:

Annotation | Description
--- | ---
`@Hears` | This annotation binds an event handler class to an event.

##### Method Annotations

For routes:

Annotation | Description
--- | ---
`@Get`,<br>`@Post`,<br>`@Options`,<br>`@Put`,<br>`@Patch`,<br>`@Delete`,<br>`@Any` | First parameter is route url. Optional parameters `as` and `middleware`.
`@Middleware` | First parameter is middleware name.

### Commands

After you have defined the routes and event bindings via annotations, you have to run the scan command:

* Use `php artisan route:scan` to register all routes.
* Use `php artisan route:clear` to clear the registered routes.
* Use `php artisan event:scan` to register all event bindings.
* Use `php artisan event:clear` to clear the registered events.

### Examples

##### Example #1

```php
<?php

namespace App\Http\Controllers;

use DevA7mad\Annotations\Annotations as Route;

/**
 * Class annotation for UserController (belongs to all class methods).
 *
 * @Route\Controller(prefix="admin")
 */
class UserController
{
    /**
     * Method annotations for showProfile($id) method.
     * @param $id
     * @Route\Get("profiles/{id}", as="profiles.show")
     * @return mixed
     */
    public function showProfile($id)
    {
        return $id;
    }

}
```

##### Example #2

```php
<?php

namespace App\Http\Controllers;

use DevA7mad\Annotations\Annotations as Route;

/**
 * Class annotations for resource controller CommentController (belongs to all class methods).
 *
 * @Route\Controller
 * @Route\Resource("comments", only={"create", "index", "show"})
 * @Route\Middleware("auth")
 */
class CommentController
{
    ...
}
```

##### Example #3

```php
<?php

namespace App\Handlers\Events;

use DevA7mad\Annotations\Annotations\Hears;

/**
 * Annotation for event binding.
 *
 * @Hears("UserWasRegistered")
 */
class SendWelcomeMail
{
    ...
}
```

## Support

Bugs and feature requests are tracked on [GitHub](https://github.com/deva7mad/lumen-annotations/issues).

## Author

* **Ahmad Elkenany** - *Development* - [Linkedin](https://www.linkedin.com/in/ahmad-elkenany/)

## License

This package is released under the [MIT License](LICENSE).


## Support on Beerpay
Hey dude! Help me out for a couple of :beers:!

[![Beerpay](https://beerpay.io/deva7mad/lumen-annotations/badge.svg?style=beer-square)](https://beerpay.io/deva7mad/lumen-annotations)  [![Beerpay](https://beerpay.io/deva7mad/lumen-annotations/make-wish.svg?style=flat-square)](https://beerpay.io/deva7mad/lumen-annotations?focus=wish)