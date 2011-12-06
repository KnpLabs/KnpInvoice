<?php

namespace Knp\Invoice\Model;

use Symfony\Component\Validator\Constraints as Assert;

abstract class Client
{
    protected $id;

    protected $first_name;
    protected $last_name;

    protected $company_name;
    protected $company_number;
    protected $company_phone;

    protected $company_address_street;
    protected $company_address_city;
    protected $company_address_zipcode;

    protected $company_other_name;
    protected $company_other_address_street;
    protected $company_other_address_city;
    protected $company_other_address_zipcode;

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

    public function setAddress($street, $city, $zipcode)
    {
        $this->company_address_street  = $street;
        $this->company_address_city    = $city;
        $this->company_address_zipcode = $zipcode;
    }

    public function getName()
    {
        if ($this->company_name) {
            return $this->company_name;
        }

        return $this->first_name . ' ' . $this->last_name;
    }
}