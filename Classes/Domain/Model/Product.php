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
 * @package z3_shop
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Beschreibung
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * amountInShop
	 *
	 * @var integer
	 */
	protected $amountInShop;
	
	/**
	 * true is product is in Cart
	 *
	 * @var boolean
	 */
	protected $isInCart;
	
	/**
	 * weight
	 *
	 * @var integer
	 */
	protected $weight;
	
	// not needed since we outsource to z3_extend
//	/**
//	 * recordType
//	 *
//	 * @var string
//	 */
//	protected $recordType;
//
//	/**
//	 * tablename
//	 *
//	 * @var string
//	 */
//	protected $tablename;
//
//	/**
//	 * Artikel
//	 *
//	 * @var integer
//	 */
//	protected $item;
//	
//	/**
//	 * Artikel
//	 *
//	 * @var \TYPO3\Z3Shop\Domain\Model\ProductItem
//	 */
//	protected $productItem;

	/**
	 * Preise
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Price>
	 */
	protected $prices;

	/**
	 * tatsächlicher Preise
	 * notInDB
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Price
	 * @lazy
	 */
	protected $actualPrice;

	/**
	 * tatsächlicher Preise
	 * notInDB
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Price
	 * @lazy
	 */
	protected $basicPrice;

	/**
	 * tatsächlicher Preise
	 * notInDB
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Price
	 * @lazy
	 */
	protected $specialPrice;
	
	/**
	 * tatsächlicher Preis bei MengenStaffel
	 * notInDB
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Price
	 * @lazy
	 */
	protected $amountPrice;
	
	/**
	 * tatsächlicher Sonderpreis bei MengenStaffel
	 * notInDB
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Price
	 * @lazy
	 */
	protected $amountSpecialPrice;


	/**
	 * __construct
	 *
	 * @return Product
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
		$this->prices = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		
		$this->cart = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		
		$this->productItem = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the name
	 *
	 * @return \string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param \string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the description
	 *
	 * @return \string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param \string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the amountInShop
	 *
	 * @return \integer $amountInShop
	 */
	public function getAmountInShop() {
		return $this->amountInShop;
	}

	/**
	 * Sets the amountInShop
	 *
	 * @param \integer $amountInShop
	 * @return void
	 */
	public function setAmountInShop($amountInShop) {
		$this->amountInShop = $amountInShop;
	}
	
	/**
	 * Returns the weight
	 *
	 * @return \integer $weight
	 */
	public function getWeight() {
		return $this->weight;
	}

	/**
	 * Sets the weight
	 *
	 * @param \integer $weight
	 * @return void
	 */
	public function setWeight($weight) {
		$this->weight = $weight;
	}

	// not needed since we outsource to z3_extend
//	
//	/**
//	 * Returns the recordType
//	 *
//	 * @return \string $recordType
//	 */
//	public function getRecordType() {
//		return $this->recordType;
//	}
//
//	/**
//	 * Sets the recordType
//	 *
//	 * @param \string $recordType
//	 * @return void
//	 */
//	public function setRecordType($recordType) {
//		$this->recordType = $recordType;
//	}
//
//	/**
//	 * Returns the tablename
//	 *
//	 * @return \string $tablename
//	 */
//	public function getTablename() {
//		return $this->tablename;
//	}
//
//	/**
//	 * Sets the tablename
//	 *
//	 * @param \string $tablename
//	 * @return void
//	 */
//	public function setTablename($tablename) {
//		$this->tablename = $tablename;
//	}
//
//	/**
//	 * Returns the item
//	 *
//	 * @return \integer $item
//	 */
//	public function getItem() {
//		return $this->item;
//	}
//
//	/**
//	 * Returns the item
//	 *
//	 * @return $productItem
//	 */
//	public function getProductItem() {
//		
//		$respositoryName = str_replace('Model', 'Repository', $this->getRecordType()).'Repository';
//		$productItemRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance($respositoryName);
//		return $productItemRepository->findByUid($this->getItem());
//		
//	}
//
//	/**
//	 * Sets the item
//	 *
//	 * @param \integer $item
//	 * @return void
//	 */
//	public function setItem($item) {
//		$this->item = $item;
//	}

	/**
	 * Adds a Price
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Price $price
	 * @return void
	 */
	public function addPrice(\TYPO3\Z3Shop\Domain\Model\Price $price) {
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->prices,'product-Model: $this->prices');
		$this->prices->attach($price);
	}

	/**
	 * Removes a Price
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Price $priceToRemove The Price to be removed
	 * @return void
	 */
	public function removePrice(\TYPO3\Z3Shop\Domain\Model\Price $priceToRemove) {
		$this->prices->detach($priceToRemove);
	}

	/**
	 * Returns the prices ordered - 
	 * Get them via Repo, so we can sort them. 
	 * Not nice, but there's -by now- no other possiblity to sort them.
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Price> $orderedPrices
	 */
	public function getPrices() {
		$priceRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Repository\PriceRepository');
		return $priceRepository->findByProduct($this);
	}

	/**
	 * Sets the prices
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Shop\Domain\Model\Price> $prices
	 * @return void
	 */
	public function setPrices(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $prices) {
		$this->prices = $prices;
	}
	
	/**
	 *	generates Attributes >>>
	 */
	
	/**
	 * Returns the basic price
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Price $basicPrice
	 */
	public function getBasicPrice($variant) {
		$prices = $this->getPrices();
		$basicPrice = NULL;
		
		if($prices !== NULL){
			foreach($prices as $price){
				if( !$price->getIsHighlight() && $basicPrice === NULL && $price->getVariant() == $variant){
					$basicPrice = $price;
				}
			}
		}
		return $basicPrice;
	}


	/**
	 * Returns the actual price
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Price $specialPrice
	 */
	public function getSpecialPrice($variant) {
		$prices = $this->getPrices();
		$specialPrice = NULL;
		
		if($prices !== NULL){
			foreach($prices as $price){
				if( $price->getIsHighlight() && $specialPrice === NULL && $price->getVariant() == $variant){
					$specialPrice = $price;
				}
			}
		}
		return $specialPrice;
	}
	
	/**
	 * Returns the actual price
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Price $amountPrice
	 */
	public function getAmountPrice($amount, $variant) {
		$prices = $this->getPrices();
		$amountPrice = NULL;
		$qntTemp = 0;
		if($prices !== NULL){
			foreach($prices as $price){
				$priceQnt = $price->getQuantity();
				if($priceQnt === NULL) $priceQnt = 0;
				if(  $amount >= $priceQnt && $priceQnt >= $qntTemp && !$price->getIsHighlight() && $price->getVariant() == $variant){
					$amountPrice = $price;
					$qntTemp = $priceQnt;
				}
			}
		}
		return $amountPrice;
	}
	
	/**
	 * Returns the actual price
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Price $amountPrice
	 */
	public function getAmountSpecialPrice($amount, $variant) {
		$prices = $this->getPrices();
		$amountSpecialPrice = NULL;
		$qntTemp = 0;
		if($prices !== NULL){
			foreach($prices as $price){
				$priceQnt = $price->getQuantity();
				if($priceQnt === NULL) $priceQnt = 0;
				if(  $amount >= $priceQnt && $priceQnt >= $qntTemp && $price->getIsHighlight() && $price->getVariant() == $variant){
					$amountSpecialPrice = $price;
					$qntTemp = $priceQnt;
				}
			}
		}
		return $amountSpecialPrice;
	}

	/**
	 * Returns the actual price
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Price $actualPrice
	 */
	public function getActualPrice($amount = NULL, $variant=0) {
//		$actualPrice = NULL;
		
		$actualPrice = NULL;
		
		if($amount !== NULL) {
			if($actualPrice === NULL){
				$actualPrice = $this->getAmountPrice($amount, $variant);
			}else{
				$actualPrice = $this->getAmountSpecialPrice($amount, $variant);
			}
		}else{
			$actualPrice = $this->getSpecialPrice($variant);			
		}
		if($actualPrice === NULL){
			$actualPrice = $this->getBasicPrice($variant);
		}
		
		return $actualPrice;
	}
	
	/**
	 * Returns true is probuct is already in Cart
	 *
	 * @return \TYPO3\Z3Shop\Domain\Model\Price $actualPrice
	 */
	public function getIsInCart(){
		$this->isInCart = FALSE;
		
		$session = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Session\SessionHandler');
		$cartRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Repository\CartRepository');
		$productCartRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Repository\ProductCartRepository');
			
		
		if($session->has('cart') && $session->get('cart') > 0) {
						
			$cartUid = $session->get('cart');
			$cart = $cartRepository->findByUid($cartUid);
			$productCart = $productCartRepository->findByCartAndProduct($cart, $this);
			if($productCart[0] !== NULL){
				$this->isInCart = $productCart[0];
			}
		}
		
		
		return $this->isInCart;
	}
	
	/**
	 *	generated Attributes <<<
	 */

}
?>