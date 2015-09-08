<?php

namespace Knp\Invoice\Model;

class Invoice {

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
	public $createdAt;

	/**
	 * @var \DateTime
	 */
	protected $issueDate;

	/**
	 * Additional information. You could store any additional information there.
	 *
	 * @var array
	 */
	protected $informations;

	public function __construct()
	{
		$this->entries = array();
		$this->informations = array();
	}

	public function getNumber()
	{
		return $this->number;
	}

	public function getSeller()
	{
		return $this->seller;
	}

	public function getSellerName()
	{
		return $this->seller ? $this->seller->getName() : null;
	}

	public function getBuyer()
	{
		return $this->buyer;
	}

	public function getBuyerName()
	{
		return $this->buyer->getName();
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
		$netto = 0;
		$brutto = 0;
		$taxes = array();

		$taxes_netto = array();
		foreach ($this->entries as $entry) {
			foreach ($entry->getTax() as $tax) {

				$total = $entry->getTotalPrice();
				if (isset($taxes_netto[$tax->getName()])) {
					$taxes_netto[$tax->getName()] += $total;
				}else{
					$taxes_netto = array_merge($taxes_netto, array($tax->getName() => $total));
				}
			}
		}

		foreach ($this->entries as $entry) {
			$netto += $entry->getTotalPrice();
			$brutto += $entry->getTotalPriceWithTax();

			foreach ($entry->getTax() as $tax) {
				$taxes[$tax->getName()] = array('value' => $tax->getValue(), 'amount' => $taxes_netto[$tax->getName()] * $tax->getValue() / 100);
			}
		}

		return array(
			'netto' => $netto,
			'brutto' => $brutto,
			'amount' => $brutto - ($this->coupon ? $this->coupon->getValue() : 0) - $this->paidAmount,
			'taxes' => $taxes
		);
	}

	public function setNumber($value)
	{
		$this->number = $value;
	}

	public function setCreatedAt(\DateTime $date)
	{
		$this->createdAt = $date;
	}

	public function setIssueDate(\DateTime $date)
	{
		$this->issueDate = $date;
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

	public function getInformations()
	{
		return $this->informations;
	}

	public function setInformations(array $informations)
	{
		$this->informations = $informations;
	}

	public function addInformation($data)
	{
		$this->informations[] = $data;
	}

	public function clearInformations()
	{
		$this->informations = array();
	}

}
