<?php

namespace Knp\Invoice\Model;

class Invoice
{
    protected $id;

    protected $number;

    protected $seller;

    protected $buyer;

    protected $tax;

    protected $paidAmount;

    protected $entries = array();

    protected $createdAt;

    protected $payDue;

    public function __construct()
    {
        $this->createdAt = new \DateTime('NOW');
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getSeller()
    {
        return $this->seller;
    }

    public function getBuyer()
    {
        return $this->buyer;
    }

    public function getEntries()
    {
        return $this->entries;
    }

    public function getPaid()
    {
        return $this->paidAmount;
    }

    public function getTotal()
    {
        $tax   = 0;
        $toPay = 0;
        foreach ($this->entries as $entry) {
            $toPay += $entry->getPrice();
            $tax   += $entry->getTax()->getValue();
        }

        return array(
            'netto'  => $toPay,
            'brutto' => $toPay + $tax
        );
    }

    public function setNumber($value)
    {
        $this->number = $value;
    }

    public function setDate($date)
    {
        $this->createdAt = new \DateTime($date);
    }

    public function setPayDue($date)
    {
        $this->payDue = new \DateTime($date);
    }

    public function setPaidAmount($paid)
    {
        $this->paidAmount = $paid;
    }

    public function setSeller(Client $seller)
    {
        $this->seller = $seller;
    }

    public function setBuyer(Client $buyer)
    {
        $this->buyer = $buyer;
    }

    public function setTax(Tax $tax)
    {
        $this->tax = $tax;
    }

    public function addEntry(Entry $entry)
    {
        $this->entries[] = $entry;
    }
}