Process Service Provider
========================

[![Build Status](https://travis-ci.org/herrera-io/php-service-process.png?branch=master)](https://travis-ci.org/herrera-io/php-service-process)

A service provider for Symfony Process.

Summary
-------

Integrates the Symfony Process component into the [Herrera.io service container](https://github.com/herrera-io/php-service-container).

Installation
------------

Add it to your list of Composer dependencies:

```sh
$ composer require herrera-io/service-process=1.*
```

Usage
-----

```php
<?php

use Herrera\Service\Container;
use Herrera\Service\Process\ProcessServiceProvider;

$container = new Container();
$container->register(new ProcessServiceProvider());

$process = $container['process']('composer');
$process->arg('hello')
        ->arg('Guest')
        ->output($process->stream(STDOUT))
        ->run();
```

Running it:

```sh
$ php script.php
Hello, Guest!
```
