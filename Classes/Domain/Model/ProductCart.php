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
class ProductCart extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Menge
	 *
	 * @var \int
	 */
	protected $amount;
	/**
	 * Menge
	 *
	 * @var \int
	 */
	protected $amountSpecial;

	/**
	 * Produkt
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Product
	 * @lazy
	 */
	protected $product;
	
	/**
	 * Produkt
	 *
	 * @var \string
	 * @lazy
	 */
	protected $variant;

	/**
	 * Warenkorb
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Cart
	 * @lazy
	 */
	protected $cart;
	
	/**
	 * Warenkorb
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Order
	 * @lazy
	 */
	protected $order;
	

	/**
	 * reciever
	 *
	 * @var \Tx_Extbase_Domain_Model_FrontendUser
	 * @lazy
	 */
	protected $reciever;

	/**
	 *	generated Attributes >>>
	 */
	/**
	 * Preis zum Zeitpunkt der Bestellung
	 * notInDB
	 *
	 * @var \float
	 */
	protected $price;
	
	/**
	 * Brutto-Preis zum Zeitpunkt der Bestellung 
	 * notInDB!
	 *
	 * @var \float
	 */
	protected $priceGross;
	
	/**
	 * Brutto-GesamtPreis zum Zeitpunkt der Bestellung 
	 * notInDB!
	 *
	 * @var \float
	 */
	protected $priceSum;
	
	/**
	 * Brutto-GesamtPreis zum Zeitpunkt der Bestellung 
	 * notInDB!
	 *
	 * @var \float
	 */
	protected $priceSumGross;

	/**
	 * MWSt-Betrag zum Zeitpunkt der Bestellung
	 * notInDB!
	 * @var \float
	 */
	protected $tax;
	
	/**
	 * MWSt-Satz zum Zeitpunkt der Bestellung
	 * notInDB!
	 * @var \float
	 */
	protected $taxrate;
	
	/**
	 *	generated Attributes <<<
	 */

	/**
	 * Returns the amount
	 *
	 * @return \int $amount
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * Sets the amount
	 *
	 * @param \string $amount
	 * @return void
	 */
	public function setAmount($amount) {
		$this->amount = $amount;
	}
	
	/**
	 * Returns the amountSpecial
	 *
	 * @return \int $amountSpecial
	 */
	public function getAmountSpecial() {
		return $this->amountSpecial;
	}

	/**
	 * Sets the amountSpecial
	 *
	 * @param \string $amountSpecial
	 * @return void
	 */
	public function setAmountSpecial($amountSpecial) {
		$this->amountSpecial = $amountSpecial;
	}	
	/**
	 * Returns the variant chosen to buy
	 *
	 * @return \string $variant
	 */
	public function getVariant() {
		return $this->variant;
	}

	/**
	 * Sets the variant chosen to buy
	 *
	 * @param \int $variant
	 * @return void
	 */
	public function setVariant($variant) {
		$this->variant = $variant;
	}	
	
	/**
	 * Returns the product
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Product $product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * Sets the product
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Product $product
	 * @return void
	 */
	public function setProduct(\TYPO3\Z3Shop\Domain\Model\Product $product) {
		$this->product = $product;
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
	 * Returns the order
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Order $order
	 */
	public function getOrder() {
		return $this->order;
	}

	/**
	 * Sets the order
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Order $order
	 * @return void
	 */
	public function setOrder(\TYPO3\Z3Shop\Domain\Model\Order $order) {
		$this->order = $order;
	}

	/**
	 * Returns the reciever
	 *
	 * @return \Tx_Extbase_Domain_Model_FrontendUser $reciever
	 */
	public function getReciever() {
		return $this->reciever;
	}

	/**
	 * Sets the reciever
	 *
	 * @param \Tx_Extbase_Domain_Model_FrontendUser $reciever
	 * @return void
	 */
	public function setReciever(\Tx_Extbase_Domain_Model_FrontendUser $reciever) {
		$this->reciever = $reciever;
	}
	
	
	
	/**
	 *	generated Attributes >>>
	 */
	
	/**
	 * Returns the single price
	 *
	 * @return \float $price
	 */
	public function getPrice() {
		$product = $this->getProduct();
		$price = $product->getActualPrice($this->getAmount(), $this->getVariant());
		return $price->getPrice();
	}

	/**
	 * Returns the single price with tax
	 *
	 * @return \float $priceGross
	 */
	public function getPriceGross() {
		$wTaxPerc = intval(100 + $this->getTaxrate()) / 100;
		$priceGross = $this->getPrice() * $wTaxPerc;
		return round( $priceGross , 2 );
	}
	
	/**
	 * Returns the price per amount of Pieces
	 *
	 * @return \float $priceSum
	 */
	public function getPriceSum() {
		$priceSum = round( $this->getPrice() * $this->getAmount() , 2 );
		return $priceSum;
	}

	/**
	 * Returns the price per amount of Pieces with tax
	 *
	 * @return \float $priceSumGross
	 */
	public function getPriceSumGross() {
		$priceSumGross = round( $this->getPriceGross() * $this->getAmount() , 2 );
		return $priceSumGross;
	}

	/**
	 * Returns the taxrate
	 *
	 * @return \float $taxrate
	 */
	public function getTaxrate() {
		$product = $this->getProduct();
		$price = $product->getActualPrice();
		return $price->getTaxrate();
	}
	/**
	 * Returns the taxrate
	 *
	 * @return \float $taxrate
	 */
	public function getTax() {
		$tax = round( $this->getPriceSum() / 100 * $this->getTaxrate() , 2 );
		return $tax;
	}
	
	/**
	 *	generated Attributes <<<
	 */

}
?>