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

    public function getChatId(){
        return $this->chatId;
    }

    public function getUsername(){
        return $this->username;
    }
}
