Usage
=====

- [Registration](#registration)
    - [Simple Builder](#simple-builder)
    - [Regular Builder](#regular-builder)
- [Process Building](#process-building)
    - [arg()](#process-argarg)
    - [builder()](#processbuilder-builder)
    - [error()](#process-errorstream)
    - [glob()](#process-globpattern)
    - [output()](#process-outputstream)
    - [run()](#integer-run)
    - [stream()](#callable-streamstream)

Registration
------------

There are two ways of registering the process service provider.

### Simple Builder

To use the simple process builder (`Herrera\Service\Process\Process`):

```php
$container = new Herrera\Service\Container();
$container->register(new Herrera\Service\Process\ProcessServiceProvider());
```

### Regular Builder

To use the regular process builder (`Symfony\Component\Process\ProcessBuilder`):

```php
$container = new Herrera\Service\Container();
$container->register(new Herrera\Service\Process\ProcessServiceProvider(false));
```

> **Notice** that `false` was passed as a constructor argument.

Process Building
----------------

If you decide to use the simple process builder, there are a few abbreviated
methods available.

### `Process arg($arg)`

Adds an argument to the process builder.

It is the equivalent of `ProcessBuilder->add($arg)`.

### `ProcessBuilder builder()`

Returns the process builder (`Symfony\Component\Process\ProcessBuilder`).

Running the builder directly will not respect any error and output stream
handlers you may have registered with the simple process builder.

### `Process error($stream)`

Sets a callable that will be used for error output.

### `Process glob($pattern)`

Adds all of the files matching the glob pattern as arguments.

### `Process output($stream)`

Sets a callable that will be used for output.

### `integer run()`

Runs the process using the registered stream handlers (see: `error()` and
`output`). The exit status of the process is returned.

### `callable stream($stream)`

Returns a callable for the `$stream` that can be used with either `error()` or
`output()`.
