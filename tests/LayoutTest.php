<?php
declare(strict_types=1);

namespace Tests;

use HtmlObject\Head;
use HtmlObject\Layout;
use Tests\Mocks\Button;
use Tests\Mocks\FakeButton;

class LayoutTest extends AbstractTestCase
{
    /**
     * Should throw exception if adding an invalid component
     */
    public function testAddComponentShouldThrowException(): void
    {
        $this->expectException(\RuntimeException::class);

        $layout = new Layout(new \DOMDocument('1.0'));
        $layout->addComponent(new FakeButton());
    }

    /**
     *  Should add component to the layout successfully
     */
    public function testAddComponentSuccessfully(): void
    {
        $layout = new Layout(new \DOMDocument('1.0'));
        $layout->addComponent(new Button());

        self::assertNotEmpty($layout->getComponents());
    }

    /**
     * Should return correct DOMDocument
     */
    public function testGetDomSuccessfully(): void
    {
        $dom = new \DOMDocument('1.0');
        $layout = new Layout($dom);

        self::assertSame($dom, $layout->getDom());
    }

    /**
     *  Should successfully add link
     */
    public function testShouldSetHeadSuccessfully(): void
    {
        $layout = new Layout(new \DOMDocument('1.0'));

        $head = (new Head())
            // Add 1 link nodes
            ->addLink($this->getFaker()->url)

            // Add 2 script nodes
            ->addScript($this->getFaker()->url)
            ->addScript($this->getFaker()->url)
        ;

        $layout->setHead($head);

        self::assertEquals(3, $layout->getHeadElement()->childNodes->count());
        self::assertEquals('link', $layout->getHeadElement()->childNodes->item(0)->nodeName);
        self::assertEquals('script', $layout->getHeadElement()->childNodes->item(1)->nodeName);
        self::assertEquals('script', $layout->getHeadElement()->childNodes->item(2)->nodeName);


    }
}