<?php

namespace Knp\Invoice\Test\Model;

class TaxTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $tax = new Tax('TAX NAME', 23);

        $this->assertEquals('TAX NAME', $tax->getName());
        $this->assertEquals(23, $tax->getValue());
    }

    /**
     * @dataProvider entryData
     */
    public function testSetters($name, $value)
    {
        $tax = new Tax();
        $tax->setName($name);
        $tax->setValue($value);

        $this->assertEquals($name, $tax->getName());
        $this->assertEquals($value, $tax->getValue());
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testValueCannotBeLowerThanZero()
    {
        $tax = new Tax();
        $tax->setValue(-1);
    }

    public function entryData()
    {
        return array(
            array('TAX NAME #1', 0),
            array('TAX NAME #2', 8),
            array('TAX NAME #3', 23)
        );
    }
}
