<?php

namespace Turkishjoe\TelegramEngine;

use Turkishjoe\TelegramEngine\Model\TelegramUser;
use Turkishjoe\TelegramEngine\Model\TelegramUserChatData;
use Turkishjoe\TelegramEngine\Storage\User\UserStorageInterface;

class UserManager
{
    private UserStorageInterface $userStorage;

    public function __construct(UserStorageInterface $userStorage){
        $this->userStorage = $userStorage;
    }

    public function buildTelegramUserObject(array $telegramUpdateData): TelegramUser{
        $telegramUserChatData = new TelegramUserChatData($telegramUpdateData['message']['chat']);
        $stateData = $this->userStorage->syncWithStorage($telegramUserChatData);

        return new TelegramUser($stateData, $telegramUserChatData);
    }
}
