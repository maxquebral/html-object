<?php
declare(strict_types=1);

namespace HtmlObject;

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
     * @return \HtmlObject\Head
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
