<?php

namespace Turkishjoe\TelegramEngine\Storage\User;

use Turkishjoe\TelegramEngine\Model\TelegramUser;
use Turkishjoe\TelegramEngine\Model\TelegramUserChatData;
use Turkishjoe\TelegramEngine\Model\UserStorageDataInterface;

interface UserStorageInterface
{
    public function syncWithStorage(TelegramUserChatData $telegramUser, ?string $botAlias): UserStorageDataInterface;
    public function storeUser(TelegramUser $userStateData, UserStorageDataInterface $newStorage);
}
