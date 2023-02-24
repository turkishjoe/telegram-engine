<?php

namespace Turkishjoe\TelegramEngine\Kernel\Request;

use Turkishjoe\TelegramEngine\Model\TelegramUser;

class TelegramRequestBuilder
{
    /**
     * TODO: Maybe we have lib with telegramRequest object
     * TODO: In production we have more events, for example chat_invite_link and each other
     * TODO: At now we pass data to TelegramRequest. As my opinion it is not ok(i need more time for refactor this
     * in our projects we work with ->getData()['message']['from'] and other. But it also need to refactor),
     * and we need pass only data and user. And parse data in constructor
     * or parse telegram data on builder Something like this
     *
     * new TelegramRequest(
     *     $user,
     *     $callbackData,
     *     (new Chat($data['chat']['from'])),
     *     .....
     * )
     */
    public function build(TelegramUser $user, array $rawTelegramData): TelegramRequest{
        $telegramData = empty($rawTelegramData['message']) ? $rawTelegramData['callback_query'] : $rawTelegramData;
        $callbackData = $this->castCallbackData($telegramData);

        return new TelegramRequest(
            $user,
            $telegramData,
            $callbackData
        );
    }

    private function castCallbackData(array $telegramData): array{
        $callbackData = null;

        if (!empty($telegramData['data'])) {
            $callbackData = json_decode($telegramData['data'], true) ?? [];
        }

        return $callbackData;
    }
}
