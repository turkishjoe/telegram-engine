<?php

namespace Turkishjoe\TelegramEngine\Route;

use Turkishjoe\TelegramEngine\Request\TelegramRequest;

interface RouteResolverInterface
{
    public function resolve(TelegramRequest $telegramRequest, string $defaultAction);
}
