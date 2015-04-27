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
class Price extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Preis
	 *
	 * @var \float
	 * @validate NotEmpty
	 */
	protected $price;
	
	/**
	 * variante (variantenname bei variante über preis)
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $variant;
	
	/**
	 * startzeit
	 * 
	 * @var \DateTime $validfrom
	 */
	protected $validfrom;
	
	/**
	 * endzeit
	 * 
	 * @var \DateTime $validuntil
	 */
	protected $validuntil;
	
	/**
	 * Preis inkl Tax
	 * notInDB
	 *
	 * @var \float
	 * @validate NotEmpty
	 */
	protected $priceGross;
	/**
	 * MWSt-betrag
	 * notInDB
	 *
	 * @var \float
	 * @validate NotEmpty
	 */
	protected $tax;

	/**
	 * MWSt-Satz
	 *
	 * @var \float
	 * @validate NotEmpty
	 */
	protected $taxrate;

	/**
	 * Ist Sonderpreis
	 *
	 * @var \boolean
	 * @validate NotEmpty
	 */
	protected $isHighlight;
	
	/**
	 * staffel: ab Menge
	 *
	 * @var \int
	 */
	protected $quantity;

	
// removed due to bug in static_info_tables. as we dont need it right now, this is no problem.
//	
//	/**
//	 * währung aus StaticInfoTables
//	 *
//	 * @var \SJBR\StaticInfoTables\Domain\Model\Currency
//	 */
//	protected $currency;


	/**
	 * Returns the Validfrom
	 *
	 * @return \DateTime $Validfrom
	 */
	public function getvalidfrom() {
		return $this->Validfrom;
	}

	/**
	 * Sets the Validfrom
	 *
	 * @param \DateTime $Validfrom
	 * @return void
	 */
	public function setvalidfrom($Validfrom) {
		$this->Validfrom = $Validfrom;
	}

	/**
	 * Returns the validuntil
	 *
	 * @return \DateTime $validuntil
	 */
	public function getValiduntil() {
		return $this->validuntil;
	}
	

	/**
	 * Sets the validuntil
	 *
	 * @param \DateTime $validuntil
	 * @return void
	 */
	public function setValiduntil($validuntil) {
		$this->validuntil = $validuntil;
	}
	
	/**
	 * Returns the price
	 *
	 * @return \float $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param \float $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}
	
	/**
	 * Returns the variant
	 *
	 * @return \float $variant
	 */
	public function getVariant() {
		return $this->variant;
	}

	/**
	 * Sets the variant
	 *
	 * @param \float $variant
	 * @return void
	 */
	public function setVariant($variant) {
		$this->variant = $variant;
	}

	/**
	 * Returns the tax
	 *
	 * @return \float $taxrate
	 */
	public function getTaxrate() {
		
		//@ToDo: set default taxrate via TS!!!
		if($this->taxrate === NULL || $this->taxrate === 0){
			$this->taxrate = 19.00;
		}
		return $this->taxrate;
	}

	/**
	 * Sets the tax
	 *
	 * @param \float $taxrate
	 * @return void
	 */
	public function setTaxrate($taxrate) {
		
		//@ToDo: set default taxrate via TS!!!
		if($taxrate === NULL || $taxrate === 0){
			$taxrate = 19.00;
		}
		$this->tax = $taxrate;
	}

	/**
	 * Returns the tax
	 *
	 * @return \int $quantity
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * Sets the tax
	 *
	 * @param \int $quantity
	 * @return void
	 */
	public function setQuantity($quantity) {
		$this->tax = $quantity;
	}

	/**
	 * Returns the isHighlight
	 *
	 * @return \boolean $isHighlight
	 */
	public function getIsHighlight() {
		return $this->isHighlight;
	}

	/**
	 * Sets the isHighlight
	 *
	 * @param \boolean $isHighlight
	 * @return void
	 */
	public function setIsHighlight($isHighlight) {
		$this->isHighlight = $isHighlight;
	}

// removed due to bug in static_info_tables. as we dont need it right now, this is no problem.
//	
//	/**
//	 * Returns the currency
//	 *
//	 * @return \SJBR\StaticInfoTables\Domain\Model\Currency $currency
//	 */
//	public function getCurrency() {
//		return $this->currency;
//	}
//
//	/**
//	 * Sets the currency
//	 *
//	 * @param \SJBR\StaticInfoTables\Domain\Model\Currency $currency
//	 * @return void
//	 */
//	public function setCurrency(\SJBR\StaticInfoTables\Domain\Model\Currency $currency) {
//		$this->currency = $currency;
//	}

	
	/**
	 *	generated Attributes >>>
	 */
	/**
	 * Returns the price inkl Tax
	 *
	 * @return \float $price
	 */
	public function getPriceGross() {
		$priceGross = round( $this->price + ($this->price / 100 * $this->taxrate), 2);
		return $priceGross;
	}
	/**
	 * Returns the Tax
	 *
	 * @return \float $price
	 */
	public function getTax() {
		$tax = round( ($this->price / 100 * $this->taxrate), 2);
		return $tax;
	}
	
	/**
	 *	generated Attributes <<<
	 */
}
?>