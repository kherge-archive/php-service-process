<?php

namespace Herrera\Service\Process\Tests;

use Herrera\PHPUnit\TestCase;
use Herrera\Service\Container;
use Herrera\Service\Process\ProcessServiceProvider;

class ProcessServiceProviderTest extends TestCase
{
    public function testRegister()
    {
        $container = new Container();
        $container->register(new ProcessServiceProvider());

        $this->assertInstanceOf(
            'Herrera\\Service\\Process\\Process',
            $container['process']('test')
        );
    }
}
