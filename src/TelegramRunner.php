<?php

namespace Turkishjoe\TelegramEngine;

use Turkishjoe\TelegramEngine\Request\TelegramRequestBuilder;
use Turkishjoe\TelegramEngine\Request\RequestRunner\TelegramRequestRunnerInterface;
use Turkishjoe\TelegramEngine\Route\RouteResolver;
use Turkishjoe\TelegramEngine\Route\RouteResolverInterface;
use Turkishjoe\TelegramEngine\Storage\Update\UpdateStorageInterface;
use Turkishjoe\TelegramEngine\Model\Update;

class TelegramRunner
{
    private UpdateStorageInterface $updateStorageInterface;
    private TelegramRequestRunnerInterface $telegramRequestRunner;
    private TelegramRequestBuilder $telegramRequestBuilder;
    private RouteResolverInterface $routeResolver;
    private UserManager $userManager;

    public function __construct(
        TelegramRequestRunnerInterface $telegramRequestRunner,
        TelegramRequestBuilder $telegramRequestBuilder,
        UpdateStorageInterface $updateStorageInterface,
        RouteResolverInterface $routeResolver,
        UserManager $userManager
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
    public function handler(array $telegramUpdateData, ?string $botAlias = null)
    {
        $update = new Update((string)$telegramUpdateData['update_id']);

        /**
         * TODO: Change to event/subscribe
         */
        $update->makeProcessing();
        $this->updateStorageInterface->saveState($update);


        try {
            $user = $this->userManager->buildTelegramUserObject($telegramUpdateData, $botAlias);
            $telegramRequest = $this->telegramRequestBuilder->build($user, $telegramUpdateData);

            $result = $this->telegramRequestRunner->call(
                $telegramRequest,
                $this->routeResolver->resolve(
                    $telegramRequest,
                    '/start'
                ),
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
