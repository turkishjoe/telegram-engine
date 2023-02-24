<?php

namespace Turkishjoe\TelegramEngine\Storage\User;

use Turkishjoe\TelegramEngine\Model\TelegramUser;
use Turkishjoe\TelegramEngine\Model\TelegramUserChatData;
use Turkishjoe\TelegramEngine\Model\UserStateData;

interface UserStorageInterface
{
    public function syncWithStorage(TelegramUserChatData $telegramUser): UserStateData;
}
