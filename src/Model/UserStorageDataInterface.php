<?php

namespace Turkishjoe\TelegramEngine\Model;

interface UserStorageDataInterface
{
    const DEFAULT_STATE = 0;

    public function getState(): int;
    public function getStateParams(): array;

    /**
     * Не придумал как сделать лучше, здесь может быть как
     * и ларовская модель, так и нет. Может лучше разделить интрефейсы,
     * но пока так
     *
     * @template T
     *
     * @return T
     */
    public function getUserData();
}
