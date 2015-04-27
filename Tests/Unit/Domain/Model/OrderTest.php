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
 * Test case for class \TYPO3\Z3Shop\Domain\Model\Order.
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
class OrderTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \TYPO3\Z3Shop\Domain\Model\Order
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \TYPO3\Z3Shop\Domain\Model\Order();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getNumberReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNumberForStringSetsNumber() { 
		$this->fixture->setNumber('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getNumber()
		);
	}
	
	/**
	 * @test
	 */
	public function getPaymentTypeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPaymentTypeForStringSetsPaymentType() { 
		$this->fixture->setPaymentType('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPaymentType()
		);
	}
	
	/**
	 * @test
	 */
	public function getShippingTypeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setShippingTypeForStringSetsShippingType() { 
		$this->fixture->setShippingType('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getShippingType()
		);
	}
	
	/**
	 * @test
	 */
	public function getPaymentFeeReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getPaymentFee()
		);
	}

	/**
	 * @test
	 */
	public function setPaymentFeeForFloatSetsPaymentFee() { 
		$this->fixture->setPaymentFee(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getPaymentFee()
		);
	}
	
	/**
	 * @test
	 */
	public function getShippingFeeReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getShippingFee()
		);
	}

	/**
	 * @test
	 */
	public function setShippingFeeForFloatSetsShippingFee() { 
		$this->fixture->setShippingFee(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getShippingFee()
		);
	}
	
	/**
	 * @test
	 */
	public function getConfirmedTermsReturnsInitialValueForOolean() { }

	/**
	 * @test
	 */
	public function setConfirmedTermsForOoleanSetsConfirmedTerms() { }
	
	/**
	 * @test
	 */
	public function getOrderedReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setOrderedForDateTimeSetsOrdered() { }
	
	/**
	 * @test
	 */
	public function getShippedReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setShippedForStringSetsShipped() { 
		$this->fixture->setShipped('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getShipped()
		);
	}
	
	/**
	 * @test
	 */
	public function getPayedReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPayedForStringSetsPayed() { 
		$this->fixture->setPayed('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPayed()
		);
	}
	
	/**
	 * @test
	 */
	public function getCryptReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCryptForStringSetsCrypt() { 
		$this->fixture->setCrypt('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCrypt()
		);
	}
	
	/**
	 * @test
	 */
	public function getShippingAddressReturnsInitialValueForAddress() { }

	/**
	 * @test
	 */
	public function setShippingAddressForAddressSetsShippingAddress() { }
	
	/**
	 * @test
	 */
	public function getBillingAddressReturnsInitialValueForAddress() { }

	/**
	 * @test
	 */
	public function setBillingAddressForAddressSetsBillingAddress() { }
	
}
?>