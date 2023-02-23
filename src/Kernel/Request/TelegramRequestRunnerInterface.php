<?php

namespace Turkishjoe\TelegramEngine\Kernel\Request;

use Turkishjoe\TelegramEngine\Kernel\Route\Route;

/**
 * Class TelegramRouteResolver
 * @package App\Service\Telegram\Kernel
 */
interface TelegramRequestRunnerInterface
{
    public function call(TelegramRequest $telegramRequest, Route $route, $params = []);
}
