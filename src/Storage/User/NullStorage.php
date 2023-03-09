<?php

namespace Turkishjoe\TelegramEngine\Storage\User;

use Turkishjoe\TelegramEngine\Model\TelegramUserChatData;
use Turkishjoe\TelegramEngine\Model\UserStorageDataInterface;
use Turkishjoe\TelegramEngine\Storage\User\UserStorageInterface;

class NullStorage implements UserStorageInterface
{
    public function syncWithStorage(TelegramUserChatData $telegramUser, ?string $botAlias): UserStorageDataInterface
    {
        return new UserStorageDataInterface();
    }
}
