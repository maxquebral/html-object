<?php

namespace App\Service\HtmlObject;

use App\Service\HtmlObject\Layout\Head;
use DOMDocument;
use DOMElement;

class Layout implements CommonInterface
{
    /**
     * @var \DOMDocument
     */
    protected DOMDocument $dom;

    /**
     * Html element
     *
     * @var \DOMElement
     */
    protected DOMElement $htmlElement;

    /**
     * @var \DOMElement
     */
    private DOMElement $bodyElement;

    /**
     * @var array
     */
    private array $components = [];

    /**
     * @var \DOMElement
     */
    private DOMElement $headElement;

    /**
     * Layout constructor.
     */
    public function __construct()
    {
        $this->dom = new DOMDocument('1.0');

        $this->htmlElement = $this->dom->createElement('html');
        $this->bodyElement = $this->dom->createElement('body');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $this->htmlElement->appendChild($this->headElement);

        foreach ($this->components as $component) {
            /** @var \App\Service\HtmlObject\AbstractBaseElement $component */
            $this->bodyElement->appendChild($component->setDom($this->dom)->createElement());
        }

        $this->htmlElement->appendChild($this->bodyElement);
        $this->dom->appendChild($this->htmlElement);

        return '<!doctype html>'.$this->dom->saveHTML();
    }

    /**
     * @inheritDoc
     */
    public function addComponent(...$component)
    {
        foreach ($component as $element) {
            /** @var \App\Service\HtmlObject\AbstractBaseElement $element */
            $this->components[] = $element;
        }

        return $this;
    }

    /**
     * @return \DOMDocument
     */
    public function getDom(): \DOMDocument
    {
        return $this->dom;
    }

    /**
     * @param  \App\Service\HtmlObject\Layout\Head  $head
     *
     * @return Layout
     */
    public function setHead(Head $head): Layout
    {
        $this->headElement = $this->dom->createElement('head');

        foreach ($head->getLinks() as $link) {
            $linkElement = $this->dom->createElement('link');

            $linkAttr = $this->dom->createAttribute('href');
            $linkAttr->value = $link;
            $linkElement->appendChild($linkAttr);

            $linkAttr = $this->dom->createAttribute('rel');
            $linkAttr->value = 'stylesheet';
            $linkElement->appendChild($linkAttr);

            $this->headElement->appendChild($linkElement);
        }

        foreach ($head->getScripts() as $script) {
            $scriptElement = $this->dom->createElement('script');

            $scriptAttr = $this->dom->createAttribute('scr');
            $scriptAttr->value = $script;
            $scriptElement->appendChild($scriptAttr);

            $scriptAttr = $this->dom->createAttribute('type');
            $scriptAttr->value = 'text/javascript';
            $scriptElement->appendChild($scriptAttr);

            $this->headElement->appendChild($scriptElement);
        }

        // $this->element->appendChild($this->headElement);

        return $this;
    }
}
