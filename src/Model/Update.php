<?php

namespace Turkishjoe\TelegramEngine\Model;

class Update
{
    /**
     * TODO: IN php 8.1 to enum
     */
    const DRAFT = 0;
    const PROCESSING = 1;
    const SUCCESS = 2;
    const FAILED = 3;

    /**
     * TODO: 8.1 StateEnum instead of int
     * @var int
     */
    private int $state;

    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->state = self::DRAFT;
    }

    public function makeSuccess(){
        $this->state = self::SUCCESS;
    }

    public function makeProcessing(){
        $this->state = self::PROCESSING;
    }

    public function makeFailed(){
        $this->state = self::FAILED;
    }

    public function getState(){
        return $this->state;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
