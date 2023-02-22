<?php

namespace Turkishjoe\TelegramEngine\Model;

interface TelegramUserInterface
{
    const STATUS_NEW = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DECLINED = 2;
    const STATUS_REGISTRATION = 3;
    const STATUS_ADMIN = 4;

    public function getChatId();
    public function setChatId($chatId);

    public function setUsername($username);
    public function getUsername();

    public function getState();
    public function setState($state);

    public function getStatus();
    public function setStatus($status);
}
