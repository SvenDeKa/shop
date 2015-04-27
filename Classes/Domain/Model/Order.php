<?php
namespace TYPO3\Z3Shop\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Sven Külpmann <sven.kuelpmann@lenz-wie-fruehling>
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package z3_shop
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Order extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * customer
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Customer
	 * 
	 */
	protected $customer;
	
	/**
	 * Bestellnummer
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $number;

	/**
	 * Zahlungsmethode
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $paymentType;

	/**
	 * Versandart
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $shippingType;

	/**
	 * Zahlungsgebühr
	 *
	 * @var \float
	 */
	protected $paymentFee;

	/**
	 * Versanmdkosten
	 *
	 * @var \float
	 */
	protected $shippingFee;

	/**
	 * AGBs akzeptiert
	 *
	 * @var boolean
	 * @validate NotEmpty
	 */
	protected $confirmedTerms = FALSE;

	/**
	 * Zeitpunkt der Bestellung
	 *
	 * @var \DateTime
	 */
	protected $ordered;

	/**
	 * Zeitpunkt des Versands
	 *
	 * @var \string
	 */
	protected $shipped;

	/**
	 * Zeitpunkt der Zahlung
	 *
	 * @var \string
	 */
	protected $payed;

	/**
	 * Hash aus uid, ordered und number
	 *
	 * @var \string
	 */
	protected $crypt;
	
	/**
	 * products
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Cart
	 */
	protected $cart;

	/**
	 * shippingAddress
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Address
	 */
	protected $shippingAddress;

	/**
	 * billingAddress
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Address
	 */
	protected $billingAddress;

	/**
	 * __construct
	 *
	 * @return Order
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->cart = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->billingAddress = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->shippingAddress = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the number
	 *
	 * @return \string $number
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * Sets the number
	 *
	 * @param \string $number
	 * @return void
	 */
	public function setNumber($number) {
		$this->number = $number;
	}

	/**
	 * Returns the paymentType
	 *
	 * @return \string $paymentType
	 */
	public function getPaymentType() {
		return $this->paymentType;
	}

	/**
	 * Sets the paymentType
	 *
	 * @param \string $paymentType
	 * @return void
	 */
	public function setPaymentType($paymentType) {
		$this->paymentType = $paymentType;
	}

	/**
	 * Returns the shippingType
	 *
	 * @return \string $shippingType
	 */
	public function getShippingType() {
		return $this->shippingType;
	}

	/**
	 * Sets the shippingType
	 *
	 * @param \string $shippingType
	 * @return void
	 */
	public function setShippingType($shippingType) {
		$this->shippingType = $shippingType;
	}

	/**
	 * Returns the paymentFee
	 *
	 * @return \float $paymentFee
	 */
	public function getPaymentFee() {
		return $this->paymentFee;
	}

	/**
	 * Sets the paymentFee
	 *
	 * @param \float $paymentFee
	 * @return void
	 */
	public function setPaymentFee($paymentFee) {
		$this->paymentFee = $paymentFee;
	}

	/**
	 * Returns the shippingFee
	 *
	 * @return \float $shippingFee
	 */
	public function getShippingFee() {
		return $this->shippingFee;
	}

	/**
	 * Sets the shippingFee
	 *
	 * @param \float $shippingFee
	 * @return void
	 */
	public function setShippingFee($shippingFee) {
		$this->shippingFee = $shippingFee;
	}

	/**
	 * Returns the confirmedTerms
	 *
	 * @return boolean $confirmedTerms
	 */
	public function getConfirmedTerms() {
		return $this->confirmedTerms;
	}

	/**
	 * Sets the confirmedTerms
	 *
	 * @param boolean $confirmedTerms
	 * @return void
	 */
	public function setConfirmedTerms($confirmedTerms) {
		$this->confirmedTerms = $confirmedTerms;
	}

	/**
	 * Returns the boolean state of confirmedTerms
	 *
	 * @return boolean
	 */
	public function isConfirmedTerms() {
		return $this->getConfirmedTerms();
	}

	/**
	 * Returns the ordered
	 *
	 * @return \DateTime $ordered
	 */
	public function getOrdered() {
		return $this->ordered;
	}

	/**
	 * Sets the ordered
	 *
	 * @param \DateTime $ordered
	 * @return void
	 */
	public function setOrdered($ordered) {
		$this->ordered = $ordered;
	}

	/**
	 * Returns the shipped
	 *
	 * @return \string $shipped
	 */
	public function getShipped() {
		return $this->shipped;
	}

	/**
	 * Sets the shipped
	 *
	 * @param \string $shipped
	 * @return void
	 */
	public function setShipped($shipped) {
		$this->shipped = $shipped;
	}

	/**
	 * Returns the payed
	 *
	 * @return \string $payed
	 */
	public function getPayed() {
		return $this->payed;
	}

	/**
	 * Sets the payed
	 *
	 * @param \string $payed
	 * @return void
	 */
	public function setPayed($payed) {
		$this->payed = $payed;
	}

	/**
	 * Returns the crypt
	 *
	 * @return \string $crypt
	 */
	public function getCrypt() {
		return $this->crypt;
	}

	/**
	 * Sets the crypt
	 *
	 * @param \string $crypt
	 * @return void
	 */
	public function setCrypt($crypt) {
		$this->crypt = $crypt;
	}


	/**
	 * Returns the shippingAddress
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Address $shippingAddress
	 */
	public function getShippingAddress() {
		return $this->shippingAddress;
	}

	/**
	 * Sets the shippingAddress
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $shippingAddress
	 * @return void
	 */
	public function setShippingAddress(\TYPO3\Z3Shop\Domain\Model\Address $shippingAddress) {
		$this->shippingAddress = $shippingAddress;
	}
	
	/**
	 * Adds a ShippingAddress
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $shippingAddress
	 * @return void
	 */
	public function addShippingAddress(\TYPO3\Z3Shop\Domain\Model\Address $shippingAddress) {
		$this->shippingAddresss->attach($shippingAddress);
	}

	/**
	 * Removes a ShippingAddress
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $shippingAddressToRemove The ShippingAddress to be removed
	 * @return void
	 */
	public function removeShippingAddress(\TYPO3\Z3Shop\Domain\Model\Address $shippingAddressToRemove) {
		$this->shippingAddresss->detach($shippingAddressToRemove);
	}

	/**
	 * Returns the billingAddress
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Address $billingAddress
	 */
	public function getBillingAddress() {
		return $this->billingAddress;
	}

	/**
	 * Sets the billingAddress
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $billingAddress
	 * @return void
	 */
	public function setBillingAddress(\TYPO3\Z3Shop\Domain\Model\Address $billingAddress) {
		$this->billingAddress = $billingAddress;
	}
	
	/**
	 * Adds a BillingAddress
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $billingAddress
	 * @return void
	 */
	public function addBillingAddress(\TYPO3\Z3Shop\Domain\Model\Address $billingAddress) {
		$this->billingAddresss->attach($billingAddress);
	}

	/**
	 * Removes a BillingAddress
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $billingAddressToRemove The BillingAddress to be removed
	 * @return void
	 */
	public function removeBillingAddress(\TYPO3\Z3Shop\Domain\Model\Address $billingAddressToRemove) {
		$this->billingAddresss->detach($billingAddressToRemove);
	}

	/**
	 * Returns the cart
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Cart $cart
	 */
	public function getCart() {
		return $this->cart;
	}

	/**
	 * Sets the cart
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Cart $cart
	 * @return void
	 */
	public function setCart(\TYPO3\Z3Shop\Domain\Model\Cart $cart) {
		$this->cart = $cart;
	}
	
	/**
	 * Adds a Cart
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Cart $cart
	 * @return void
	 */
	public function addCart(\TYPO3\Z3Shop\Domain\Model\Cart $cart) {
		$this->carts->attach($cart);
	}

	/**
	 * Removes a Cart
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Cart $cartToRemove The Cart to be removed
	 * @return void
	 */
	public function removeCart(\TYPO3\Z3Shop\Domain\Model\Cart $cartToRemove) {
		$this->carts->detach($cartToRemove);
	}
	
	
	/**
	 * Returns the customer
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Customer $customer
	 */
	public function getCustomer() {
		return $this->customer;
	}

	/**
	 * Sets the customer
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Customer $customer
	 * @return void
	 */
	public function setCustomer(\TYPO3\Z3Shop\Domain\Model\Customer $customer) {
		$this->customer = $customer;
	}
}
?>