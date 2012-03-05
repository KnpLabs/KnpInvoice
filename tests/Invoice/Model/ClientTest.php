<?php

namespace Knp\Invoice\Test\Model;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider addressData
     */
    public function testSetAddress($address)
    {
        $client = new Buyer();
        $client->setAddress($address['street'], $address['city'], $address['zipcode'], $address['country']);

        $this->assertTrue(is_array($client->getAddress()));
        $this->assertEquals($address, $client->getAddress());
    }

    public function testGetNameReturnsCompanyNameIfPossible()
    {
        $client = new Seller();
        $client->setCompanyName('Company Name');

        $this->assertEquals('Company Name', $client->getName());
    }

    public function testGetNameReturnsFullNameIfNoCompanyNameGiven()
    {
        $client = new Seller();
        $client->setFirstName('Testowy');
        $client->setLastName('Test');

        $this->assertEquals('Testowy Test', $client->getName());
    }

    public function addressData()
    {
        return array(
            array(
                array(
                    'street'  => '11 RUE KERVEGAN',
                    'city'    => 'NANTES',
                    'zipcode' => '44000',
                    'country' => 'France'
                ),
            ),
            array(
                array(
                    'street'  => 'Kozia 5',
                    'city'    => 'Kozia Wólka',
                    'zipcode' => '00-666',
                    'country' => 'Poland'
                ),
            )
        );
    }
}
