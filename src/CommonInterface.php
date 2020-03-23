<?php
declare(strict_types=1);

namespace HtmlObject;

interface CommonInterface
{
    /**
     * @param  mixed  ...$component
     *
     * @return mixed
     */
    public function addComponent(...$component);
}
