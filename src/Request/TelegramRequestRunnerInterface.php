<?php

namespace Turkishjoe\TelegramEngine\Request;

use Turkishjoe\TelegramEngine\Route\Route;

/**
 * Class TelegramRouteResolver
 * @package App\Service\Telegram\Kernel
 */
interface TelegramRequestRunnerInterface
{
    public function call(TelegramRequest $telegramRequest, Route $route, $params = []);
}
