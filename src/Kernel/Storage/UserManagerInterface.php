<?php

namespace Turkishjoe\TelegramEngine\Kernel\Storage;

use Turkishjoe\TelegramEngine\Model\TelegramUser;

interface UserManagerInterface
{
    public function store(TelegramUser $telegramUser): void;
}
