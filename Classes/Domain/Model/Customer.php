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
class Customer extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser {

	
	/**
	 * Kundennummer
	 *
	 * @var string
	 */
	protected $number;
	
	/**
	 * Preise
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Order>
	 */
	protected $orders;
	
	/**
	 * Preise
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Address>
	 */
	protected $addresses;
	
	/**
	 * Preise
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Cart
	 */
	protected $cart;
	
	/**
	 * Preise
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Address
	 */
	protected $defaultShippingAddress;
	
	/**
	 * Preise
	 * notInDB
	 * 
	 * @var \TYPO3\Z3Shop\Domain\Model\Address
	 */
	protected $defaultBillingAddress;
	

	/**
	 * __construct
	 *
	 * @return Address
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
		$this->orders = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->cart = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->addresses = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the staticCountry
	 *
	 * @return \string $staticCountry
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
	 * Adds a Order
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Order $order
	 * @return void
	 */
	public function addOrder(\TYPO3\Z3Shop\Domain\Model\Order $order) {
		$this->orders->attach($order);
	}

	/**
	 * Removes a Order
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Order $orderToRemove The Order to be removed
	 * @return void
	 */
	public function removeOrder(\TYPO3\Z3Shop\Domain\Model\Order $orderToRemove) {
		$this->orders->detach($orderToRemove);
	}

	/**
	 * Returns the orders ordered - 
	 * Get them via Repo, so we can sort them. 
	 * Not nice, but there's -by now- no other possiblity to sort them.
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Order> $orderedOrders
	 */
	public function getOrders() {
		return $this->orders;
	}

	/**
	 * Sets the orders
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Order> $orders
	 * @return void
	 */
	public function setOrders(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $orders) {
		$this->orders = $orders;
	}
	
	
	/**
	 * Adds a Address
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $address
	 * @return void
	 */
	public function addAddress(\TYPO3\Z3Shop\Domain\Model\Address $address) {
		$this->addresses->attach($address);
	}

	/**
	 * Removes a Address
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $addressToRemove The Address to be removed
	 * @return void
	 */
	public function removeAddress(\TYPO3\Z3Shop\Domain\Model\Address $addressToRemove) {
		$this->addresses->detach($addressToRemove);
	}

	/**
	 * Returns the addresses addressed - 
	 * Get them via Repo, so we can sort them. 
	 * Not nice, but there's -by now- no other possiblity to sort them.
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Address> $addressedAddresses
	 */
	public function getAddresses() {
		return $this->addresses;
	}

	/**
	 * Sets the addresses
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Address> $addresses
	 * @return void
	 */
	public function setAddresses(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $addresses) {
		$this->addresses = $addresses;
	}
	
	
	
	/**
	 * Adds a Cart
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Cart $cart
	 * @return void
	 */
	public function addCart(\TYPO3\Z3Shop\Domain\Model\Cart $cart) {
		$this->cart->attach($cart);
	}

	/**
	 * Removes a Cart
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Cart $cartToRemove The Cart to be removed
	 * @return void
	 */
	public function removeCart(\TYPO3\Z3Shop\Domain\Model\Cart $cartToRemove) {
		$this->cart->detach($cartToRemove);
	}

	/**
	 * Returns the cart carted - 
	 * Get them via Repo, so we can sort them. 
	 * Not nice, but there's -by now- no other possiblity to sort them.
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Cart> $cartedCart
	 */
	public function getCart() {
		return $this->cart;
	}

	/**
	 * Sets the cart
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Cart> $cart
	 * @return void
	 */
	public function setCart(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $cart) {
		$this->cart = $cart;
	}
	
	public function getDefaultShippingAddress(){
		
		$addresses = $this->getAddresses();
		foreach($addresses as $address){
			if($address->getIsDefaultShipping()){
				return $address;
			}
		}
		return $addresses[0];
	}
	
	public function getDefaultBillingAddress(){
		$addresses = $this->getAddresses();
		foreach($addresses as $address){
			if($address->getIsDefaultBilling()){
				return $address;
			}
		}
		return $addresses[0];
	}
	

}
	
?>