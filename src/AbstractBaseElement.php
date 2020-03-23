<?php
declare(strict_types=1);

namespace HtmlObject;

use DOMDocument;
use DOMElement;

abstract class AbstractBaseElement
{
    /**
     * @var mixed
     */
    protected array $attributes = [];

    /**
     * @var \DOMDocument
     */
    protected DOMDocument $dom;

    /**
     * Button element
     *
     * @var \DOMElement
     */
    protected DOMElement $element;

    /**
     * Get the tag/element to be create
     *
     * @return string
     */
    abstract public function getTagName(): string;

    /**
     * @param  string  $name
     * @param  array  $arguments
     *
     * @return \HtmlObject\AbstractBaseElement
     */
    public function __call(string $name, array $arguments)
    {
        return $this->setAttribute($name, $arguments[0]);
    }

    /**
     * Create the element or tag
     *
     * @return \DOMElement
     */
    public function createElement(): DOMElement
    {
        if (empty($this->element) === false) {
            return $this->element;
        }

        $this->element = $this->dom->createElement($this->getTagName());
        foreach ($this->attributes as $attribute => $value) {
            // $this->setNodeAttribute($attribute, $value);

            if ($value !== '') {
                $domAttribute = $this->dom->createAttribute($attribute);
                $domAttribute->value = $value;
                $this->element->nodeValue = $value;
                $this->element->appendChild($domAttribute);
            }
        }

        return $this->element;
    }

    /**
     * @return \DOMElement
     */
    public function getElement(): \DOMElement
    {
        return $this->element;
    }

    /**
     * @param  \DOMDocument  $dom
     *
     * @return AbstractBaseElement
     */
    public function setDom(\DOMDocument $dom): AbstractBaseElement
    {
        $this->dom = $dom;

        return $this;
    }

    /**
     * @param  string  $attrName
     * @param  string  $value
     *
     * @return \HtmlObject\AbstractBaseElement
     */
    protected function setAttribute(string $attrName, string $value): AbstractBaseElement
    {
        $attr = strtolower(substr($attrName, 3));

        if (\array_key_exists($attr, $this->attributes) === false) {
            throw new \RuntimeException(\sprintf('Attribute [%s] does not exist exception', $attrName));
        }

        $this->attributes[$attr] = $value;

        return $this;
    }

    /**
     * @param  string  $attribute
     * @param  string  $value
     *
     * @return \DOMAttr
     */
    protected function setNodeAttribute(string $attribute, string $value): \DOMAttr
    {
        $domAttribute = $this->dom->createAttribute($attribute);
        $domAttribute->value = $value;
        $this->element->appendChild($domAttribute);

        return $domAttribute;
    }
}
