# SlimSwagger
A Slim Middleware for generating Swagger documentation on the fly with Swagger-PHP.

## Installation
Easiest is using Composer:
```
composer require terwey/slim-swagger
```

Adding it to Slim is easy too:
```
$app->add(new \terwey\SlimSwagger(array(), array('baseDir' => __DIR__.'/../src/')));
```
Where ```src/``` is the directory you keep your API endpoint or Models.

## Resources
For now you'll have to grab a release of [Swagger-UI](https://github.com/swagger-api/swagger-ui) and copy ```/lib``` and ```/css``` to your ```/public``` directory.
Also copy over ```swagger-ui.min.js``` to the ```/public/lib``` directory.

## Template
I've provided a Twig template in the ```/templates``` directory. Copy this over to your Slim application. If you want to use Twig also install [Slim Views](https://github.com/codeguy/Slim-Views).
