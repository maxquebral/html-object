<?php

namespace App\Service\HtmlObject\Layout;

class Head
{
    /**
     * @var string[]
     */
    private array $links = [];

    /**
     * @var string[]
     */
    private array $scripts = [];

    /**
     * @param  string  $href
     *
     * @return \App\Service\HtmlObject\Layout\Head
     */
    public function addLink(string $href): Head
    {
        $this->links[] = $href;

        return $this;
    }

    /**
     * @param  string  $source
     *
     * @return Head
     */
    public function addScript(string $source): Head
    {
        $this->scripts[] = $source;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @return string[]
     */
    public function getScripts(): array
    {
        return $this->scripts;
    }
}
