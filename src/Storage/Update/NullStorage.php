<?php

namespace Turkishjoe\TelegramEngine\Storage\Update;

use Turkishjoe\TelegramEngine\Model\TelegramUserChatData;
use Turkishjoe\TelegramEngine\Model\Update;
use Turkishjoe\TelegramEngine\Model\UserStateData;
use Turkishjoe\TelegramEngine\Storage\Update\UpdateStorageInterface;
use Turkishjoe\TelegramEngine\Storage\User\UserStorageInterface;

class NullStorage implements UpdateStorageInterface
{
    public function saveState(Update $update){

    }
}
