<?php

namespace Turkishjoe\TelegramEngine\Kernel;

use Turkishjoe\TelegramEngine\Model\TelegramUserInterface;

interface UserManagerInterface
{
    public function get($telegramChatData, $class): TelegramUserInterface;
}
