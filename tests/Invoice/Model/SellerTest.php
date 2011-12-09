<?php

namespace Knp\Invoice\Model;

class SellerTest extends ClientTest
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testLogoFileMustExists()
    {
        $seller = new Seller;
        $seller->setLogo('dummy_filename');
    }
}