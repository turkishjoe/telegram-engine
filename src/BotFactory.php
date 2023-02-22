<?php

namespace Turkishjoe\TelegramEngine;

use Psr\Container\ContainerInterface;
use Turkishjoe\TelegramEngine\Kernel\BotMetadata;

class BotFactory
{
    private string $botMapping;
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container, string $botMapping)
    {
        $this->container = $container;
        $this->botMapping = $botMapping;
    }

    public function getBotMetadataByName($alias): BotMetadata
    {
        return $this->container->get($this->botMapping[$alias]);
    }
}
