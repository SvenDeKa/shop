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
class Address extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {


	/**
	 * customer
	 *
	 * @var \TYPO3\Z3Shop\Domain\Model\Customer $customer
	 */
	protected $customer;
	
	/**
	 * isDefaultBilling
	 *
	 * @var boolean
	 */
	protected $isDefaultBilling;
	
	/**
	 * isDefaultShipping
	 *
	 * @var boolean
	 */
	protected $isDefaultShipping;
	
	/**
	 * salutation
	 *
	 * @var string
	 */
	protected $salutation;
	
	/**
	 * firstname
	 *
	 * @var string
	 */
	protected $firstname;
	
	/**
	 * lastname
	 *
	 * @var string
	 */
	protected $lastname;
	
	/**
	 * streetNr
	 *
	 * @var string
	 */
	protected $addressStreet;
	
	/**
	 * streetNr
	 *
	 * @var string
	 */
	protected $addressNumber;
	
	/**
	 * company
	 *
	 * @var string
	 */
	protected $company;
	/**
	 * extrafeld1
	 *
	 * @var string
	 */
	protected $extra1;
	/**
	 * extrafeld2
	 *
	 * @var string
	 */
	protected $extra2;
	
	/**
	 * postalCode
	 *
	 * @var string
	 */
	protected $postalCode;
	
	/**
	 * city
	 *
	 * @var string
	 */
	protected $city;
	
	/**
	 * country
	 *
	 * @var string
	 */
	protected $country;
	
	/**
	 * staticCountry
	 *
	 * @var \SJBR\StaticInfoTables\Domain\Model\Country
	 */
	protected $staticCountry;
	
	/**
	 * email
	 *
	 * @var string
	 */
	protected $email;
	/**
	 * phone
	 *
	 * @var string
	 */
	protected $phone;
	/**
	 * mobile-phone
	 *
	 * @var string
	 */
	protected $mobile;
	/**
	 * fax
	 *
	 * @var string
	 */
	protected $fax;
	
	/**
	 * tx_extbase_type
	 *
	 * @var string
	 */
	protected $txExtbaseType;
	

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
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->customer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->staticCountry = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	
	/**
	 * Adds a customer
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Customer $customer
	 * @return void
	 */
	public function addCustomer(\TYPO3\Z3Shop\Domain\Model\Customer $customer) {
		$this->customer->attach($customer);
	}

	/**
	 * Removes a customer
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Customer $customerToRemove The  to be removed
	 * @return void
	 */
	public function removeCustomer(\TYPO3\Z3Shop\Domain\Model\Customer $customerToRemove) {
		$this->customer->detach($customerToRemove);
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
	public function setCustomer(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $customer) {
		$this->customer = $customer;
	}


	/**
	 * Returns the isDefaultShipping
	 *
	 * @return \boolean $isDefaultShipping
	 */
	public function getIsDefaultShipping() {
		return $this->isDefaultShipping;
	}

	/**
	 * Sets the isDefaultShipping
	 *
	 * @param \boolean $isDefaultShipping
	 * @return void
	 */
	public function setIsDefaultShipping($isDefaultShipping) {
		$this->isDefaultShipping = $isDefaultShipping;
	}

	/**
	 * Returns the isDefaultBilling
	 *
	 * @return \boolean $isDefaultBilling
	 */
	public function getIsDefaultBilling() {
		return $this->isDefaultBilling;
	}

	/**
	 * Sets the isDefaultBilling
	 *
	 * @param \boolean $isDefaultBilling
	 * @return void
	 */
	public function setIsDefaultBilling($isDefaultBilling) {
		$this->isDefaultBilling = $isDefaultBilling;
	}


	/**
	 * Returns the salutation
	 *
	 * @return \string $salutation
	 */
	public function getSalutation() {
		return $this->salutation;
	}

	/**
	 * Sets the salutation
	 *
	 * @param \string $salutation
	 * @return void
	 */
	public function setSalutation($salutation) {
		$this->salutation = $salutation;
	}


	/**
	 * Returns the firstname
	 *
	 * @return \string $firstname
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * Sets the firstname
	 *
	 * @param \string $firstname
	 * @return void
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}


	/**
	 * Returns the lastname
	 *
	 * @return \string $lastname
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * Sets the lastname
	 *
	 * @param \string $lastname
	 * @return void
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}
	
	/**
	 * Returns the addressStreet
	 *
	 * @return \string $addressStreet
	 */
	public function getAddressStreet() {
		return $this->addressStreet;
	}

	/**
	 * Sets the addressStreet
	 *
	 * @param \string $addressStreet
	 * @return void
	 */
	public function setAddressStreet($addressStreet) {
		$this->addressStreet = $addressStreet;
	}
	
	/**
	 * Returns the addressNumber
	 *
	 * @return \string $addressNumber
	 */
	public function getAddressNumber() {
		return $this->addressNumber;
	}

	/**
	 * Sets the addressNumber
	 *
	 * @param \string $addressNumber
	 * @return void
	 */
	public function setAddressNumber($addressNumber) {
		$this->addressNumber = $addressNumber;
	}
	
	/**
	 * Returns the company
	 *
	 * @return \string $company
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * Sets the company
	 *
	 * @param \string $company
	 * @return void
	 */
	public function setCompany($company) {
		$this->company = $company;
	}
	
	/**
	 * Returns the extra1
	 *
	 * @return \string $extra1
	 */
	public function getExtra1() {
		return $this->extra1;
	}

	/**
	 * Sets the extra1
	 *
	 * @param \string $extra1
	 * @return void
	 */
	public function setExtra1($extra1) {
		$this->extra1 = $extra1;
	}
	
	/**
	 * Returns the extra2
	 *
	 * @return \string $extra2
	 */
	public function getExtra2() {
		return $this->extra2;
	}

	/**
	 * Sets the extra2
	 *
	 * @param \string $extra2
	 * @return void
	 */
	public function setExtra2($extra2) {
		$this->extra2 = $extra2;
	}

	/**
	 * Returns the postalCode
	 *
	 * @return \string $postalCode
	 */
	public function getPostalCode() {
		return $this->postalCode;
	}

	/**
	 * Sets the postalCode
	 *
	 * @param \string $postalCode
	 * @return void
	 */
	public function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;
	}

	/**
	 * Returns the city
	 *
	 * @return \string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param \string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}


	/**
	 * Returns the country
	 *
	 * @return \string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Returns the staticCountry
	 *
	 * @return @param \SJBR\StaticInfoTables\Domain\Model\Country $staticCountry
	 */
	public function getStaticCountry() {
		return $this->staticCountry;
	}

	/**
	 * Sets the staticCountry
	 *
	 * @param \SJBR\StaticInfoTables\Domain\Model\Country $staticCountry
	 * @return void
	 */
	public function setStaticCountry($staticCountry) {
		$this->staticCountry = $staticCountry;
	}


	/**
	 * Returns the email
	 *
	 * @return \string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param \string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the phone
	 *
	 * @return \string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 *
	 * @param \string $phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Returns the mobile
	 *
	 * @return \string $mobile
	 */
	public function getMobile() {
		return $this->mobile;
	}

	/**
	 * Sets the mobile
	 *
	 * @param \string $mobile
	 * @return void
	 */
	public function setMobile($mobile) {
		$this->mobile = $mobile;
	}

	/**
	 * Returns the fax
	 *
	 * @return \string $fax
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * Sets the fax
	 *
	 * @param \string $fax
	 * @return void
	 */
	public function setFax($fax) {
		$this->fax = $fax;
	}
	
	/**
	 * Returns the txExtbaseType
	 *
	 * @return \string $txExtbaseType
	 */
	public function getTxExtbaseType() {
		return $this->txExtbaseType;
	}

	/**
	 * Sets the txExtbaseType
	 *
	 * @param \string $txExtbaseType
	 * @return void
	 */
	public function setTxExtbaseType($txExtbaseType) {
		$this->txExtbaseType = $txExtbaseType;
	}
	
	

}
?>