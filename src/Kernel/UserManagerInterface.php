<?php

namespace Turkishjoe\TelegramEngine\Kernel;

use App\Models\Telegram\Telegram\TelegramUserInterface;

interface UserManagerInterface
{
    public function findOrCreate($telegramChatData, $class): TelegramUserInterface;
}
