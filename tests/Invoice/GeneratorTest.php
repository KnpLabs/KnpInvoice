<?php

namespace Knp\Invoice;

use Knp\Invoice\Model\Invoice;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException RuntimeException
     */
    public function testGenerateFunctionMustBeOverwritten()
    {
        $generator = new Generator;
        $generator->generate(new Invoice());
    }

    /**
     * @expectedException RuntimeException
     */
    public function testGenerateAndSaveFunctionMustBeOverwritten()
    {
        $generator = new Generator;
        $generator->generateAndSave(new Invoice());
    }

    public function testToStringFunctionNeedsGeneratedContent()
    {
        $generator = new Generator;
        $this->assertEmpty((string) $generator);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetThemeFunctionNeedsStringTest()
    {
        $generator = new Generator;
        $generator->setTheme((int) 1);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testSetThemeFunctionNeedsExistingFileTest()
    {
        $generator = new Generator;
        $generator->setTheme('dummy_name');
    }
}