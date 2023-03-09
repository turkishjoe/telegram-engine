<?php

namespace Turkishjoe\TelegramEngine;

interface RequestProcessorInterface
{
    public function process($telegramUpdateData, $botAlias): array;
}
