<?php

namespace Knp\Invoice\Model;

class EntryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTaxReturnsTaxModel()
    {
        $entry = new Entry;

        $this->assertCount(1, $entry->getTax());
        $this->assertInstanceOf('Knp\Invoice\Model\Tax', current($entry->getTax()));
    }

    /**
     * @dataProvider entryData
     */
    public function testGetTotalPrice($quantity, $price, $total)
    {
        $entry = new Entry;
        $entry->setQuantity($quantity);
        $entry->setUnitPrice($price);

        $this->assertEquals($total, $entry->getTotalPrice());
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testEntryCanHaveOnlyTwoTaxes()
    {
        $entry = new Entry;
        $entry->addTax(new Tax('Tax 1', 1));
        $entry->addTax(new Tax('Tax 2', 2));
        $entry->addTax(new Tax('Tax 3', 3));
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testQuantityCannotBeLowerThanOne()
    {
        $entry = new Entry;
        $entry->setQuantity(0);
    }

    public function entryData()
    {
        return array(
            array(1, 10, 10),
            array(1, 50, 50),
            array(2, 10, 20)
        );
    }
}