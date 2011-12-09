<?php

namespace Knp\Invoice\Generators;

use Knp\Invoice\Model;

class TwigTest extends \PHPUnit_Framework_TestCase
{
    protected $generator;

    protected function setUp()
    {
        if (!class_exists('Twig_Environment')) {
            $this->markTestSkipped('Twig is not available.');
        }

        $this->generator = new Twig;
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWhatCheckTemplateAllows()
    {
        $this->generator->generate(new Model\Invoice(), 'dummy');
    }

    public function testGenerateInvoice()
    {
        $address = array(
            'seller' => array(
                'street'  => '11 RUE KERVEGAN',
                'city'    => 'NANTES',
                'zipcode' => '44000',
                'country' => 'France'
            ),
            'buyer'  => array(
                'street'  => 'Słowackiego 17',
                'city'    => 'Łowicz',
                'zipcode' => '99-400',
                'country' => 'Poland'
            )
        );

        $invoice = new Model\Invoice();

        $seller = new Model\Seller();
        $seller->setName('KnpLabs France');
        $seller->setAddress(
            $address['seller']['street'],
            $address['seller']['city'],
            $address['seller']['zipcode'],
            $address['seller']['country']
        );

        $this->assertEquals('KnpLabs France', $seller->getName());
        $this->assertEquals($address['seller'], $seller->getAddress());

        $invoice->setSeller($seller);

        $buyer = new Model\Buyer();
        $buyer->setName('Józef Bielawski');
        $buyer->setAddress(
            $address['buyer']['street'],
            $address['buyer']['city'],
            $address['buyer']['zipcode'],
            $address['buyer']['country']
        );

        $this->assertEquals('Józef Bielawski', $buyer->getName());
        $this->assertEquals($address['buyer'], $buyer->getAddress());

        $invoice->setBuyer($buyer);

        $tax = new Model\Tax('TAX 23%', 23);

        $this->assertEquals('TAX 23%', $tax->getName());
        $this->assertEquals(23, $tax->getValue());

        $entry = new Model\Entry();
        $entry->setDescription('Entry #1');
        $entry->setUnitPrice(666);
        $entry->addTax($tax);

        $invoice->setDate('2011-12-08');
        $invoice->addEntry($entry);

        $this->generator->generate($invoice);

        $this->assertContains('<div id="invoice">
    <dl>
        <dd>0000001</dd>
        <dt>Facture #</dt>

        <dd>December 8, 2011</dd>
        <dt>Facture Date</dt>
    </dl>

    <dl class="invoice-total">
        <dd>&euro; 819.18 EUR</dd>
        <dt>Amount Due</dt>
    </dl>
</div>', $this->generator->render());
    }
}