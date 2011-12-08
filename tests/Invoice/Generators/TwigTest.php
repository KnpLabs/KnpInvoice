<?php

namespace Knp\Invoice\Generators;

use Knp\Invoice\Model\Invoice;

class TwigTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        if (!class_exists('Twig_Environment')) {
            $this->markTestSkipped('Twig is not available.');
        }
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWhatCheckTemplateAllows()
    {
        $generator = new Twig;
        $generator->generate(new Invoice(), 'dummy');
    }
}