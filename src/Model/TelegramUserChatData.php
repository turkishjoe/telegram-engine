<?php

namespace Turkishjoe\TelegramEngine\Model;

class TelegramUserChatData
{
    private string $chatId;
    private string $username;

    public function __construct(array $telegramChatData){
        $this->chatId = $telegramChatData['id'];
        $this->username = $telegramChatData['username'] ?? '';
    }

    public function getChatId(): string{
        return $this->chatId;
    }

    public function getUsername(): string{
        return $this->username;
    }
}
