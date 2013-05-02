<?php

namespace Herrera\Service\Process;

use Symfony\Component\Process\ProcessBuilder;

/**
 * Built on ProcessBuilder, further simplifying process building.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class Process
{
    /**
     * The process builder.
     *
     * @var ProcessBuilder
     */
    private $builder;

    /**
     * The error callback.
     *
     * @var callable
     */
    private $error;

    /**
     * The output callback.
     *
     * @var callable
     */
    private $output;

    /**
     * Sets the command and initializes the process builder.
     *
     * @param string $command The command.
     */
    public function __construct($command)
    {
        $this->builder = ProcessBuilder::create(array($command));
    }

    /**
     * Adds an argument.
     *
     * @param mixed $value The argument value.
     *
     * @return Process For method chaining.
     */
    public function arg($value)
    {
        $this->builder->add($value);

        return $this;
    }

    /**
     * Returns the process builder.
     *
     * @return ProcessBuilder The process builder.
     */
    public function builder()
    {
        return $this->builder;
    }

    /**
     * Sets the callback for error output.
     *
     * @param callable $callback The callback.
     *
     * @return Process For method chaining.
     */
    public function error($callback)
    {
        $this->error = $callback;

        return $this;
    }

    /**
     * Expands the glob pattern and add the results as arguments.
     *
     * @param string $pattern The glob pattern.
     *
     * @return Process For method chaining.
     */
    public function glob($pattern)
    {
        foreach (glob($pattern) as $result) {
            $this->builder->add($result);
        }
    }

    /**
     * Sets the callback for output.
     *
     * @param callable $callback The callback.
     *
     * @return Process For method chaining.
     */
    public function output($callback)
    {
        $this->output = $callback;

        return $this;
    }

    /**
     * Runs the command.
     *
     * @return integer The exit status code.
     */
    public function run()
    {
        $error = $this->error;
        $output = $this->output;

        return $this->builder->getProcess()->run(
            function ($type, $buffer) use ($error, $output) {
                if ('err' === $type) {
                    if ($error) {
                        $error($buffer);
                    }
                } elseif ($output) {
                    $output($buffer);
                }
            }
        );
    }

    /**
     * Returns a callable for streaming output.
     *
     * @param resource $stream The stream.
     *
     * @return callable The callable.
     */
    public function stream($stream)
    {
        return function ($buffer) use ($stream) {
            fwrite($stream, $buffer);
        };
    }
}
