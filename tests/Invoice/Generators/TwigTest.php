<?php

namespace Knp\Invoice\Generators;

use Knp\Invoice\Model\Invoice;

class TwigTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        if (!class_exists('Twig_Environment', false)) {
            $this->markTestSkipped('Twig library is required to run this test.');
        }
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWhatCheckTemplateAllows()
    {
        $generator = new Knp\Invoice\Generators\Twig;
        $generator->generate(new Invoice());
    }
}