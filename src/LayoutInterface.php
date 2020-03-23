<?php
declare(strict_types=1);

namespace HtmlObject;

interface LayoutInterface
{
    /**
     * @param  mixed  ...$component
     *
     * @return self
     */
    public function addComponent(...$component): self;
}
