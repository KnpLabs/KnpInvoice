<?php

namespace Knp\Invoice\Model;

abstract class Client
{
    protected $first_name;
    protected $last_name;

    protected $company_name;
    protected $company_number;
    protected $company_phone;

    protected $company_address_street;
    protected $company_address_city;
    protected $company_address_zipcode;
    protected $company_address_country;

    protected $company_other_name;
    protected $company_other_address_street;
    protected $company_other_address_city;
    protected $company_other_address_zipcode;
    protected $company_other_address_country;

    public function setName($name)
    {
        $this->company_name = $name;
    }

    public function setFirstName($name)
    {
        $this->first_name = $name;
    }

    public function setLastName($name)
    {
        $this->last_name = $name;
    }

    public function setCompanyName($name)
    {
        $this->company_name = $name;
    }

    public function setAddress($street, $city, $zipcode, $country)
    {
        $this->company_address_street  = $street;
        $this->company_address_city    = $city;
        $this->company_address_zipcode = $zipcode;
        $this->company_address_country = $country;
    }

    public function getName()
    {
        if ($this->company_name) {
            return $this->company_name;
        }

        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAddress()
    {
        return array(
            'street'  => $this->company_address_street,
            'city'    => $this->company_address_city,
            'zipcode' => $this->company_address_zipcode,
            'country' => $this->company_address_country
        );
    }
}