<?php

namespace Turkishjoe\TelegramEngine\Storage;

use Turkishjoe\TelegramEngine\Model\Update;

interface UpdateStorageInterface
{
    public function saveState(Update $update);
}
