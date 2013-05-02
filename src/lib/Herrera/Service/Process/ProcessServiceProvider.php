<?php

namespace Herrera\Service\Process;

use Herrera\Service\Container;
use Herrera\Service\ProviderInterface;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Adds a Process factory to the service container.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class ProcessServiceProvider implements ProviderInterface
{
    /**
     * The flag that determines if the simple builder is used.
     *
     * @var boolean
     */
    private $simple;

    /**
     * Sets the flag that determines if the simple builder is used.
     *
     * @param boolean $simple Use the simple builder?
     */
    public function __construct($simple = true)
    {
        $this->simple = $simple;
    }

    /**
     * {@inheritDoc}
     */
    public function register(Container $container)
    {
        if ($this->simple) {
            $container['process'] = $container->many(
                function ($command) {
                    return new Process($command);
                }
            );
        } else {
            $container['process'] = $container->many(
                function ($command) {
                    return new ProcessBuilder(array($command));
                }
            );
        }
    }
}
