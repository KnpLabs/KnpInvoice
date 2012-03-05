<?php

namespace Knp\Invoice\Test\Generators;

use Knp\Invoice\Model;

class TwigTest extends \PHPUnit_Framework_TestCase
{
    protected $generator;

    protected function setUp()
    {
        if (!class_exists('Twig_Environment')) {
            $this->markTestSkipped('Twig is not available.');
        }

        $this->generator = new Twig();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testTemplateNotExists()
    {
        $this->generator->generate(new Model\Invoice(), 'dummy');
    }

    public function testGenerateInvoice()
    {
        $data = array(
            'address' => array(
                'seller' => array(
                    'street'  => '11 RUE KERVEGAN',
                    'city'    => 'NANTES',
                    'zipcode' => '44000',
                    'country' => 'France'
                ),
                'buyer'  => array(
                    'street'  => 'Kozia 5',
                    'city'    => 'Kozia Wólka',
                    'zipcode' => '00-666',
                    'country' => 'Poland'
                )
            )
        );

        $this->generator->generate(
            $this->getInvoice($data)
        );

        $this->assertGeneratedContent('<div id="invoice">
        <dl>
            <dd>0000001</dd>
            <dt>Facture #</dt>

            <dd>December 9, 2011</dd>
            <dt>Facture Date</dt>
        </dl>

        <dl class="invoice-total">
            <dd>&euro; 819.18 EUR</dd>
            <dt>Amount Due</dt>
        </dl>
    </div>', $this->generator->render());
    }

    protected function getInvoice(array $data)
    {
        $invoice = new Model\Invoice();

        $seller = new Model\Seller();
        $seller->setName('KnpLabs France');
        $seller->setAddress(
            $data['address']['seller']['street'],
            $data['address']['seller']['city'],
            $data['address']['seller']['zipcode'],
            $data['address']['seller']['country']
        );

        $invoice->setSeller($seller);

        $buyer = new Model\Buyer();
        $buyer->setName('Marek Nowak');
        $buyer->setAddress(
            $data['address']['buyer']['street'],
            $data['address']['buyer']['city'],
            $data['address']['buyer']['zipcode'],
            $data['address']['buyer']['country']
        );

        $invoice->setBuyer($buyer);

        $tax = new Model\Tax('TAX 23%', 23);

        $entry = new Model\Entry();
        $entry->setDescription('Entry #1');
        $entry->setUnitPrice(666);
        $entry->addTax($tax);

        $invoice->setDate('2011-12-08');
        $invoice->addEntry($entry);

        return $invoice;
    }

    protected function assertGeneratedContent($expected, $actual)
    {
        $this->markTestIncomplete('Find a way to compare this!');

        return parent::assertContains(
            preg_replace('/[\t\r\n]/', '', $expected),
            preg_replace('/[\t\r\n]/', '', $actual)
        );
    }
}
