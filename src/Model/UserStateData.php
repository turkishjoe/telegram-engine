<?php

namespace Turkishjoe\TelegramEngine\Model;

class UserStateData
{
    const DEFAULT_STATE = 0;

    private int $state;
    private array $params;

    public function __construct(int $state = self::DEFAULT_STATE, array $params = []){
        $this->state = $state;
        $this->params = $params;
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
