<?php

namespace Turkishjoe\TelegramEngine\Kernel\Updates;

use Turkishjoe\TelegramEngine\Model\UpdateInterface;

interface UpdateObserverInterface
{
    public function initUpdate(array $data): UpdateInterface;

    public function markUpdateAsProcessed(UpdateInterface $updateInterface);
    public function markUpdateAsFailed(UpdateInterface $updateInterface);
}
