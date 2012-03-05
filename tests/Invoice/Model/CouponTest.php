<?php

namespace Knp\Invoice\Test\Model;

class CouponTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider entryData
     */
    public function testSetters($name, $value)
    {
        $coupon = new Coupon();
        $coupon->setName($name);
        $coupon->setValue($value);

        $this->assertEquals($name, $coupon->getName());
        $this->assertEquals($value, $coupon->getValue());
    }

    public function testValueReturnsZeroIfCouponIsExpired()
    {
        $coupon = new Coupon();
        $coupon->setValue(23);
        $coupon->setExpiresAt('2010-01-01');

        $this->assertEquals(0, $coupon->getValue());
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testValueCannotBeLowerThanZero()
    {
        $coupon = new Coupon();
        $coupon->setValue(-1);
    }

    public function entryData()
    {
        return array(
            array('Coupon #1', 0),
            array('Coupon #2', 8),
            array('Coupon #3', 23)
        );
    }
}
