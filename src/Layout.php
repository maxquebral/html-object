<?php
declare(strict_types=1);

namespace HtmlObject;

use DOMDocument;
use DOMElement;

final class Layout implements LayoutInterface
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
     *
     * @param  \DOMDocument  $dom
     */
    public function __construct(DOMDocument $dom)
    {
        $this->dom = $dom;

        $this->htmlElement = $this->dom->createElement('html');
        $this->bodyElement = $this->dom->createElement('body');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function __toString()
    {
        $this->htmlElement->appendChild($this->headElement);

        foreach ($this->components as $component) {
            /** @var \HtmlObject\AbstractBaseElement $component */
            $this->bodyElement->appendChild($component->setDom($this->dom)->createElement());
        }

        $this->htmlElement->appendChild($this->bodyElement);
        $this->dom->appendChild($this->htmlElement);

        return '<!doctype html>'.$this->dom->saveHTML();
    }

    /**
     * @inheritDoc
     */
    public function addComponent(...$component): self
    {
        foreach ($component as $element) {
            if (($element instanceof ElementInterface) === false) {
                throw new \RuntimeException('Invalid component exception');
            }

            /** @var \HtmlObject\AbstractBaseElement $element */
            $this->components[] = $element;
        }

        return $this;
    }

    /**
     * Get added components to the layout.
     *
     * @return array
     */
    public function getComponents(): array
    {
        return $this->components;
    }

    /**
     * @return \DOMDocument
     */
    public function getDom(): \DOMDocument
    {
        return $this->dom;
    }

    /**
     * @return \DOMElement
     */
    public function getHeadElement(): \DOMElement
    {
        return $this->headElement;
    }

    /**
     * @param  \HtmlObject\Head  $head
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

        return $this;
    }
}
