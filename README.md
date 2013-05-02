Process Service Provider
========================

[![Build Status]](https://travis-ci.org/herrera-io/php-service-process)

Process Service Provider registers the Symfony Process builder as a service
for the [Herrera.io service container][]. Also included is a simplified
process builder.

```php
use Herrera\Service\Container;
use Herrera\Service\Process\ProcessServiceProvider;

$container = new Container();
$container->register(new ProcessServiceProvider());

$process = $container['process']('echo');
$process
    ->arg('Hello, ')
    ->arg('Guest!')
    ->output($process->stream(STDOUT))
    ->run();
```

Documentation
-------------

- [Installing][]
- [Usage][]

[Build Status]: https://travis-ci.org/herrera-io/php-service-process.png?branch=master
[Herrera.io service container]: https://github.com/herrera-io/php-service-container
[Installing]: doc/00-Installing.md
[Usage]: doc/01-Usage.md
