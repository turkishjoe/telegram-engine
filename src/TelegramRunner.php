<?php

namespace Turkishjoe\TelegramEngine;

use Turkishjoe\TelegramEngine\Storage\Update\UpdateStorageInterface;
use Turkishjoe\TelegramEngine\Model\Update;

class TelegramRunner
{
    private UpdateStorageInterface $updateStorageInterface;
    private RequestProcessorInterface $requestProcessor;

    public function __construct(
        UpdateStorageInterface $updateStorageInterface,
        RequestProcessorInterface $requestProcessor
    ) {
        $this->updateStorageInterface = $updateStorageInterface;
        $this->requestProcessor = $requestProcessor;
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
            $result = $this->requestProcessor->
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
