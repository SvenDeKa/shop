<?php

namespace TYPO3\Z3Shop\Tests;
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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \TYPO3\Z3Shop\Domain\Model\Product.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Ordermanagement
 *
 * @author Sven Külpmann <sven.kuelpmann@lenz-wie-fruehling>
 */
class ProductTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \TYPO3\Z3Shop\Domain\Model\Product
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \TYPO3\Z3Shop\Domain\Model\Product();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNameForStringSetsName() { 
		$this->fixture->setName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getName()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getAmountInShopReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAmountInShopForStringSetsAmountInShop() { 
		$this->fixture->setAmountInShop('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAmountInShop()
		);
	}
	
	/**
	 * @test
	 */
	public function getWeightReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getWeight()
		);
	}

	/**
	 * @test
	 */
	public function setWeightForIntegerSetsWeight() { 
		$this->fixture->setWeight(12);

		$this->assertSame(
			12,
			$this->fixture->getWeight()
		);
	}
	
	/**
	 * @test
	 */
	public function getRecordTypeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setRecordTypeForStringSetsRecordType() { 
		$this->fixture->setRecordType('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getRecordType()
		);
	}
	
	/**
	 * @test
	 */
	public function getTablenameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTablenameForStringSetsTablename() { 
		$this->fixture->setTablename('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTablename()
		);
	}
	
	/**
	 * @test
	 */
	public function getItemReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getItem()
		);
	}

	/**
	 * @test
	 */
	public function setItemForIntegerSetsItem() { 
		$this->fixture->setItem(12);

		$this->assertSame(
			12,
			$this->fixture->getItem()
		);
	}
	
	/**
	 * @test
	 */
	public function getPricesReturnsInitialValueForPrice() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getPrices()
		);
	}

	/**
	 * @test
	 */
	public function setPricesForObjectStorageContainingPriceSetsPrices() { 
		$price = new \TYPO3\Z3Shop\Domain\Model\Price();
		$objectStorageHoldingExactlyOnePrices = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOnePrices->attach($price);
		$this->fixture->setPrices($objectStorageHoldingExactlyOnePrices);

		$this->assertSame(
			$objectStorageHoldingExactlyOnePrices,
			$this->fixture->getPrices()
		);
	}
	
	/**
	 * @test
	 */
	public function addPriceToObjectStorageHoldingPrices() {
		$price = new \TYPO3\Z3Shop\Domain\Model\Price();
		$objectStorageHoldingExactlyOnePrice = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOnePrice->attach($price);
		$this->fixture->addPrice($price);

		$this->assertEquals(
			$objectStorageHoldingExactlyOnePrice,
			$this->fixture->getPrices()
		);
	}

	/**
	 * @test
	 */
	public function removePriceFromObjectStorageHoldingPrices() {
		$price = new \TYPO3\Z3Shop\Domain\Model\Price();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($price);
		$localObjectStorage->detach($price);
		$this->fixture->addPrice($price);
		$this->fixture->removePrice($price);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getPrices()
		);
	}
	
	/**
	 * @test
	 */
	public function getCartReturnsInitialValueFor() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getCart()
		);
	}

	/**
	 * @test
	 */
	public function setCartForObjectStorageContainingSetsCart() { 
		$cart = new ();
		$objectStorageHoldingExactlyOneCart = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneCart->attach($cart);
		$this->fixture->setCart($objectStorageHoldingExactlyOneCart);

		$this->assertSame(
			$objectStorageHoldingExactlyOneCart,
			$this->fixture->getCart()
		);
	}
	
	/**
	 * @test
	 */
	public function addCartToObjectStorageHoldingCart() {
		$cart = new ();
		$objectStorageHoldingExactlyOneCart = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneCart->attach($cart);
		$this->fixture->addCart($cart);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneCart,
			$this->fixture->getCart()
		);
	}

	/**
	 * @test
	 */
	public function removeCartFromObjectStorageHoldingCart() {
		$cart = new ();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($cart);
		$localObjectStorage->detach($cart);
		$this->fixture->addCart($cart);
		$this->fixture->removeCart($cart);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getCart()
		);
	}
	
}
?>