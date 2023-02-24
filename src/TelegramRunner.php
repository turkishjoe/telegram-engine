<?php

namespace Turkishjoe\TelegramEngine;

use Turkishjoe\TelegramEngine\Kernel\Request\TelegramRequestBuilder;
use Turkishjoe\TelegramEngine\Kernel\Request\TelegramRequestRunnerInterface;
use Turkishjoe\TelegramEngine\Kernel\Route\RouteResolver;
use Turkishjoe\TelegramEngine\Kernel\Storage\UpdateStorageInterface;
use Turkishjoe\TelegramEngine\Kernel\Storage\UserManagerInterface;
use Turkishjoe\TelegramEngine\Model\TelegramUser;
use Turkishjoe\TelegramEngine\Model\Update;

class TelegramRunner
{
    private UpdateStorageInterface $updateStorageInterface;
    private TelegramRequestRunnerInterface $telegramRequestRunner;
    private TelegramRequestBuilder $telegramRequestBuilder;
    private RouteResolver $routeResolver;
    private UserManagerInterface $userManager;

    public function __construct(
        TelegramRequestRunnerInterface $telegramRequestRunner,
        TelegramRequestBuilder $telegramRequestBuilder,
        UpdateStorageInterface $updateStorageInterface,
        RouteResolver $routeResolver,
        UserManagerInterface $userManager
    ) {
        $this->telegramRequestRunner = $telegramRequestRunner;
        $this->updateStorageInterface = $updateStorageInterface;
        $this->telegramRequestBuilder = $telegramRequestBuilder;
        $this->routeResolver = $routeResolver;
        $this->userManager = $userManager;
    }

    /**
     * TODO: validate telegram request
     *
     * @param array       $telegramUpdateData
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function handler(array $telegramUpdateData)
    {
        $update = new Update((string)$telegramUpdateData['update_id']);

        /**
         * TODO: Change to event/subscribe
         */
        $update->makeProcessing();
        $this->updateStorageInterface->saveState($update);


        try {
            $user = new TelegramUser($telegramUpdateData['message']['chat']);
            $this->userManager->store($user);

            $telegramRequest = $this->telegramRequestBuilder->build($user, $telegramUpdateData);

            $result = $this->telegramRequestRunner->call(
                $telegramRequest,
                $this->routeResolver->resolve($telegramRequest),
                []
            );

            /**
             * TODO: Change to event/subscribe
             */
            $update->makeSuccess();
            $this->updateStorageInterface->saveState($update);
        } catch (\Throwable $exception) {
            if (!is_null($update)) {
                /**
                 * TODO: Change to event/subscribe
                 */
                $update->makeFailed();
                $this->updateStorageInterface->saveState($update);
            }

            throw $exception;
        }

        return $result;
    }
}
