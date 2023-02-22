<?php

namespace Turkishjoe\TelegramEngine;

use Turkishjoe\TelegramEngine\Kernel\TelegramEntryPoint;

class TelegramRunner
{
    /**
     * @var TelegramEntryPoint $telegramEntryPoint
     */
    private $telegramEntryPoint;

    /**
     * @var BotFactory $telegramFactory
     */
    private $telegramFactory;

    public function __construct(TelegramEntryPoint $telegramEntryPoint, BotFactory $botFactory)
    {
        $this->telegramEntryPoint = $telegramEntryPoint;
        $this->telegramFactory = $botFactory;
    }

    public function run(array $data, string $botName)
    {
        $this->telegramEntryPoint->handler(
            $data,
            $this->telegramFactory->getBotMetadataByName($botName)
        );
    }
}
