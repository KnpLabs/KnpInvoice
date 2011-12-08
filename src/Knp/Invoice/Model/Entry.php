<?php

namespace Knp\Invoice\Model;

class Entry
{
    protected $tax;

    protected $description;

    protected $unit_price;

    protected $quantity = 1;

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
        return $this->quantity * ($this->unit_price + ($this->unit_price * $this->getTax()->getValue()));
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
        return $this->tax ?: new Tax;
    }

    public function setUnitPrice($price)
    {
        $this->unit_price = (float) $price;
    }

    public function setTax(Tax $tax)
    {
        $this->tax = $tax;
    }

    public function setQuantity($quantity)
    {
        $quantity = (int) $quantity;
        if ($quantity < 1) {
            throw new \InvalidArgumentException();
        }

        $this->quantity = $quantity;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;
    }
}