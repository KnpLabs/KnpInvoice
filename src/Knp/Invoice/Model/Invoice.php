<?php

namespace Knp\Invoice\Model;

class Invoice
{
    /**
     * @var mixed
     */
    protected $number = '0000001';

    /**
     * @var Seller
     */
    protected $seller;

    /**
     * @var Buyer
     */
    protected $buyer;

    /**
     * @var Coupon
     */
    protected $coupon;

    /**
     * @var float
     */
    protected $paidAmount;

    /**
     * @var Entry[]
     */
    protected $entries;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $payDue;

    public function __construct()
    {
        $this->entries   = array();
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

    public function getCoupon()
    {
        return $this->coupon;
    }

    public function getPaid()
    {
        return $this->paidAmount;
    }

    public function getTotal()
    {
        $netto  = 0;
        $brutto = 0;
        $taxes  = array();
        foreach ($this->entries as $entry) {
            $netto  += $entry->getTotalPrice();
            $brutto += $entry->getTotalPriceWithTax();

            foreach ($entry->getTax() as $tax) {
                $taxes[$tax->getName()] = $tax->getValue();
            }
        }

        return array(
            'netto'  => $netto,
            'brutto' => $brutto,
            'amount' => $brutto - ($this->coupon ? $this->coupon->getValue() : 0) - $this->paidAmount,
            'taxes'  => $taxes
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

    public function setCoupon(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function addEntry(Entry $entry)
    {
        $this->entries[] = $entry;
    }
}