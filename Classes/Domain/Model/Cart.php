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
class Cart extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * sessionId
	 *
	 * @var \string
	 */
	protected $sessionId;

	/**
	 * Produkt-Typ
	 *
	 * @var \string
	 */
	protected $productType;

	/**
	 * customer
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Customer
	 * 
	 */
	protected $customer;

	/**
	 * products
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\ProductCart>
	 */
	protected $products;

	/**
	 *	generated Attributes >>>
	 */
	
	/**
	 * price
	 * @var float
	 */
	protected $price;
	
	/**
	 * priceGross
	 * @var float
	 */
	protected $priceGross;
	
	/**
	 * tax
	 * taxes[i][taxrate] = 19;
	 * taxes[i][tax] = xy;
	 * taxes[i][price] = 19;
	 * taxes[i][priceGross] = 19; 
	 * 
	 * @var array
	 */
	protected $taxes;
	
	
	/**
	 *	generated Attributes <<<
	 */
	
	
	/**
	 * __construct
	 *
	 * @return Cart
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
		$this->products = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the sessionId
	 *
	 * @return \string $sessionId
	 */
	public function getSessionId() {
		return $this->sessionId;
	}

	/**
	 * Sets the sessionId
	 *
	 * @param \string $sessionId
	 * @return void
	 */
	public function setSessionId($sessionId) {
		$this->sessionId = $sessionId;
	}

	/**
	 * Returns the productType
	 *
	 * @return \string $productType
	 */
	public function getProductType() {
		return $this->productType;
	}

	/**
	 * Sets the productType
	 *
	 * @param \string $productType
	 * @return void
	 */
	public function setProductType($productType) {
		$this->productType = $productType;
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

	/**
	 * Adds a ProductCart
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\ProductCart $product
	 * @return void
	 */
	public function addProduct(\TYPO3\Z3Shop\Domain\Model\ProductCart $product) {
		$this->products->attach($product);
	}

	/**
	 * Removes a ProductCart
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\ProductCart $productToRemove The ProductCart to be removed
	 * @return void
	 */
	public function removeProduct(\TYPO3\Z3Shop\Domain\Model\ProductCart $productToRemove) {
		$this->products->detach($productToRemove);
	}

	/**
	 * Returns the products
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\ProductCart> $products
	 */
	public function getProducts() {
		return $this->products;
	}

	/**
	 * Sets the products
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\ProductCart> $products
	 * @return void
	 */
	public function setProducts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $products) {
		$this->products = $products;
	}
	
	
	/**
	 *	generated Attributes >>>
	 */
	
	/**
	 * Returns the price over all products
	 *
	 * @return \array $price
	 */
	public function getPrice() {
		$price = 0.00;
		foreach($this->products as $product){
			$price = $price + $product->getPriceSum();
		}
		return $price;
	}
	
	/**
	 * Returns the price over all products with tax
	 *
	 * @return \array $price
	 */
	public function getPriceGross() {
		$priceGross = 0.00;
		foreach($this->products as $product){
			$priceGross = $priceGross + $product->getPriceSumGross();
		}
		return $priceGross;
	}
	/**
	 * Returns the Taxes
	 * tax
	 * taxes[i][taxrate] = 19;
	 * taxes[i][tax] = xy;
	 * taxes[i][price] = 19;
	 * taxes[i][priceGross] = 19; 
	 *
	 * @return \array $price
	 */
	public function getTaxes() {
		$taxes = array();
		foreach($this->products as $product){
			$currTaxrate = intval( $product->getTaxrate() );
			if( !array_key_exists($currTaxrate, $taxes)){
				$taxes[$currTaxrate]['taxrate'] = $product->getTaxrate();
				$taxes[$currTaxrate]['tax'] = $product->getTax();
				$taxes[$currTaxrate]['price'] = $product->getPrice();
				$taxes[$currTaxrate]['priceGross'] = $product->getPriceGross();
			}else{
				$taxes[$currTaxrate]['tax'] = $taxes[$currTaxrate]['tax'] + $product->getTax();
				$taxes[$currTaxrate]['price'] = $taxes[$currTaxrate]['price'] + $product->getPrice();
				$taxes[$currTaxrate]['priceGross'] = $taxes[$currTaxrate]['priceGross'] + $product->getPriceGross();
			}
		}
		return $taxes;
	}
	
	/**
	 *	generated Attributes <<<
	 */

}
?>