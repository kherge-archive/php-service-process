<?php

namespace Herrera\Service\Process;

use Herrera\Service\Container;
use Herrera\Service\ProviderInterface;

/**
 * Adds a Process factory to the service container.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class ProcessServiceProvider implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Container $container)
    {
        $container['process'] = $container->many(
            function ($command) {
                return new Process($command);
            }
        );
    }
}
