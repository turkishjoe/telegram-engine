<?php

namespace Turkishjoe\TelegramEngine\Kernel\Storage;

use Turkishjoe\TelegramEngine\Model\Update;

interface UpdateStorageInterface
{
    public function saveState(Update $update);
}