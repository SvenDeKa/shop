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
class ProductShoporder extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Bestellmenge
	 *
	 * @var \integer
	 */
	protected $amount;

	/**
	 * Preis zum Zeitpunkt der Bestellung
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
	 * MWSt-Satz zum Zeitpunkt der Bestellung
	 *
	 * @var \float
	 */
	protected $tax;

	/**
	 * product
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Product
	 */
	protected $product;

	/**
	 * shoporder
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Order
	 */
	protected $shoporder;

	/**
	 * \Tx_Extbase_Domain_Model_FrontendUser
	 *
	 * @var
	 * @lazy
	 */
	protected $reciever;

	/**
	 * Returns the amount
	 *
	 * @return \integer $amount
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * Sets the amount
	 *
	 * @param \integer $amount
	 * @return void
	 */
	public function setAmount($amount) {
		$this->amount = $amount;
	}

	/**
	 * Returns the single price
	 *
	 * @return \float $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the single price
	 *
	 * @param \float $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Returns the single price with tax
	 *
	 * @return \float $priceGross
	 */
	public function getPriceGross() {
		$priceGross = round( $this->price*$this->tax , 2 );
		return $priceGross;
	}

	/**
	 * Sets the single price with tax
	 *
	 * @param \float $priceGross
	 * @return void
	 */
	public function setPriceGross($priceGross) {
		$this->priceGross = $priceGross;
	}
	
	/**
	 * Returns the price per amount of Pieces
	 *
	 * @return \float $priceSum
	 */
	public function getPriceSum() {
		$priceSum = round( $this->price*$this->amount , 2 );
		return $priceSum;
	}

	/**
	 * Sets the price per amount of Pieces
	 *
	 * @param \float $price
	 * @return void
	 */
	public function setPriceSum($priceSum) {
		$this->priceSum = $priceSum;
	}

	/**
	 * Returns the price per amount of Pieces with tax
	 *
	 * @return \float $price
	 */
	public function getPriceSumGross() {
		$priceSumGross = round( $this->priceGross*$this->amount , 2 );
		return $priceSumGross;
	}

	/**
	 * Sets the price per amount of Pieces with tax
	 *
	 * @param \float $priceSumGross
	 * @return void
	 */
	public function setPriceSumGross($priceSumGross) {
		$this->priceSumGross = $priceSumGross;
	}

	/**
	 * Returns the tax
	 *
	 * @return \float $tax
	 */
	public function getTax() {
		return $this->tax;
	}

	/**
	 * Sets the tax
	 *
	 * @param \float $tax
	 * @return void
	 */
	public function setTax($tax) {
		$this->tax = $tax;
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
	 * Returns the shoporder
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Order $shoporder
	 */
	public function getShoporder() {
		return $this->shoporder;
	}

	/**
	 * Sets the shoporder
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Order $shoporder
	 * @return void
	 */
	public function setShoporder(\TYPO3\Z3Shop\Domain\Model\Order $shoporder) {
		$this->shoporder = $shoporder;
	}

	/**
	 * Returns the reciever
	 *
	 * @return  $reciever
	 */
	public function getReciever() {
		return $this->reciever;
	}

	/**
	 * Sets the reciever
	 *
	 * @param  $reciever
	 * @return void
	 */
	public function setReciever($reciever) {
		$this->reciever = $reciever;
	}

}
?>