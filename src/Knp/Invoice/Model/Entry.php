<?php

namespace Knp\Invoice\Model;

class Entry
{
    protected $taxes;

    protected $description;

    protected $unit_price;

    protected $quantity = 1;

    public function  __construct()
    {
        $this->taxes = array();
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getTotalPrice()
    {
        return $this->quantity * $this->unit_price;
    }

    public function getTotalPriceWithTax()
    {
        $brutto = 0;
        foreach ($this->getTax() as $tax) {
            $brutto += $this->unit_price * $tax->getValue() / 100;
        }

        return $this->quantity * ($this->unit_price + $brutto);
    }

    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getTax()
    {
        return $this->taxes ?: array(new Tax);
    }

    public function setUnitPrice($price)
    {
        $this->unit_price = (float) $price;
    }

    public function addTax(Tax $tax)
    {
        if (count($this->taxes) == 2) {
            throw new \OutOfBoundsException();
        }

        $this->taxes[] = $tax;
    }

    public function setQuantity($quantity)
    {
        $quantity = (int) $quantity;
        if ($quantity < 1) {
            throw new \OutOfBoundsException();
        }

        $this->quantity = $quantity;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;
    }
}