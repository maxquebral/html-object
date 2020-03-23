<?php

namespace App\Service\HtmlObject;

interface CommonInterface
{
    /**
     * @param  mixed  ...$component
     *
     * @return mixed
     */
    public function addComponent(...$component);
}
