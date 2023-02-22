<?php

namespace Turkishjoe\TelegramEngine\Kernel\Route;

class Action
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $method;

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }


}
