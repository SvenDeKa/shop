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
 * Test case for class \TYPO3\Z3Shop\Domain\Model\Price.
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
class PriceTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \TYPO3\Z3Shop\Domain\Model\Price
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \TYPO3\Z3Shop\Domain\Model\Price();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getPriceReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getPrice()
		);
	}

	/**
	 * @test
	 */
	public function setPriceForFloatSetsPrice() { 
		$this->fixture->setPrice(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getPrice()
		);
	}
	
	/**
	 * @test
	 */
	public function getTaxReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getTax()
		);
	}

	/**
	 * @test
	 */
	public function setTaxForFloatSetsTax() { 
		$this->fixture->setTax(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getTax()
		);
	}
	
	/**
	 * @test
	 */
	public function getIsHighlightReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIsHighlightForStringSetsIsHighlight() { 
		$this->fixture->setIsHighlight('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIsHighlight()
		);
	}
	
	/**
	 * @test
	 */
	public function getCurrencyReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getCurrency()
		);
	}

	/**
	 * @test
	 */
	public function setCurrencyForIntegerSetsCurrency() { 
		$this->fixture->setCurrency(12);

		$this->assertSame(
			12,
			$this->fixture->getCurrency()
		);
	}
	
}
?>