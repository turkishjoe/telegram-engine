<?php

namespace Turkishjoe\TelegramEngine\Storage\Update;

use Turkishjoe\TelegramEngine\Model\Update;

interface UpdateStorageInterface
{
    public function saveState(Update $update);
}
