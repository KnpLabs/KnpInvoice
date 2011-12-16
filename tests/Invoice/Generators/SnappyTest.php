<?php

namespace Knp\Invoice\Generators;

use Knp\Invoice\Model\Invoice;

class SnappyTest extends \PHPUnit_Framework_TestCase
{
    protected $skip = false;

    protected function setUp()
    {
        if (!class_exists('Knp\Snappy\Pdf')) {
            $this->markTestSkipped('Snappy is not available.');
        }

        try {
            new Snappy;
        } catch (\RuntimeException $e) {
            $this->skip = true;
        }
    }

    /**
     * @expectedException RuntimeException
     */
    public function testBinaryIsAvailable()
    {
        new Snappy('dummy_file_address');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWhatCheckTemplateAllows()
    {
        if ($this->skip) {
            $this->markTestSkipped('Binary `wkhtmltopdf` not found.');
        }

        $generator = new Snappy;
        $generator->generate(new Invoice());
    }
}