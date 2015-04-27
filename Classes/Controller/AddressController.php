<?php
namespace TYPO3\Z3Shop\Controller;

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
class AddressController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	
	/**
	 * addressRepository
	 *
	 * @var \TYPO3\Z3Shop\Domain\Repository\AddressRepository
	 * @inject
	 */
	protected $addressRepository;
	
	/**
	 * Feuser
	 * 
	 * @var \TYPO3\Z3Shop\Domain\Repository\CustomerRepository
	 * @inject
	 */
	protected $customerRepository;
	
	/**
	 * array of madatory fields which are empty after newAction is left
	 * 
	 * @var array
	 */
	protected $requiredFieldEmpty;
	
	/**
	 * existing similar Addresses
	 * 
	 * @var \TYPO3\Z3Shop\Domain\Repository\CustomerRepository
	 * @inject
	 */
	protected $existingAddresses;
	/**
	 * Feuser
	 * 
	 * @var \TYPO3\Z3Shop\Domain\Model\Address
	 * @inject
	 */
	protected $newAddress;
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$user = $GLOBALS['TSFE']->fe_user->user; 
		$this->customer = $this->customerRepository->findByUid($user['uid']);
		
		if( $this->customer !== NULL ){
			$addresses = $this->addressRepository->findByCustomer($this->customer);
			$this->view->assign('feuser', $this->customer);
			$this->view->assign('addresses', $addresses);
		}else{
			$this->flashMessageContainer->add('Bitte loggen Sie sich ein');
		}
		//	load Assets
		$assets = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Utility\Assets');
		$assets->addAssets($this->settings);
	}
	

	/**
	 * action show
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $address
	 * @return void
	 */
	public function showAction(\TYPO3\Z3Shop\Domain\Model\Address $address) {
		$this->view->assign('address', $address);
		
		//	load Assets
		$assets = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Utility\Assets');
		$assets->addAssets($this->settings);
		
	}

	/**
	 * action new
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $newAddress
	 * @dontvalidate $newAddress
	 * @return void
	 */
	public function newAction(\TYPO3\Z3Shop\Domain\Model\Address $newAddress = NULL) {
		
		if ($newAddress == NULL) { // workaround for fluid bug ##5636
			$newAddress = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('\TYPO3\Z3Shop\Domain\Model\Address');
		}
		$this->view->assign('newAddress', $newAddress);
		$this->view->assign('existingAddresses', $this->existingAddresses);
		
	}

	protected function initializeValidateAction() {
//		$propertiesTmp = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', 
//				$this->settings['address']['new']['validate']['existence']['properties'].
//				','.
//				$this->settings['address']['new']['validate']['notEmpty']['requiredProperties']);
//		$properties = array_unique($propertiesTmp);
//		foreach($properties as $property){
			$newAddressConfiguration = $this->arguments['newAddress']->getPropertyMappingConfiguration();
			$newAddressConfiguration->allowAllProperties();
			$newAddressConfiguration->setTypeConverterOption(
				'TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter',
				\TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter::CONFIGURATION_CREATION_ALLOWED,
				TRUE
			);
//		}
	}
	/**
	 * action create
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $newAddress
	 * @return void
	 */
	public function validateAction(\TYPO3\Z3Shop\Domain\Model\Address $newAddress) {
		$this->newAddress = $newAddress;
		
		$haltOnSimilar = FALSE;
		if($this->settings['address']['new']['validate']['existence']['haltOnSimilar'] > 0){
			$haltOnSimilar = TRUE;
		}
		
		$user = $GLOBALS['TSFE']->fe_user->user; 
		$this->customer = $this->customerRepository->findByUid($user['uid']);
		
		if( $this->customer === NULL && $this->settings['address']['new']['feOwnerRequired'] > 0){
			$this->flashMessageContainer->add('Bitte loggen Sie sich ein');
			$this->redirect('new');
		}

		$this->existingAddressesOwn = $this->checkExistence($this->newAddress, $this->customer, FALSE);
		$this->existingAddressesOther = $this->checkExistence($this->newAddress, $this->customer, TRUE);
		$this->requiredFieldEmpty = $this->checkRequiredField($this->newAddress);
		
//		if( (!$this->existingAddresses && !$this->requiredFieldEmpty) || ( !$haltOnSimilar && !$this->requiredFieldEmpty ) ){
//			$this->redirect('create');
//		}
		// errors
//		if($this->existingAddressesOwn !== FALSE){
//			$this->flashMessageContainer->add('a similar address was already present for this customer.');
//		}
//		if($this->existingAddressesOther !== FALSE){
//			$this->flashMessageContainer->add('a similar address was already present for another customer.');
//		}
		if($this->requiredFieldEmpty !== FALSE){
			$this->flashMessageContainer->add('some mandatory Fields are empty.');
		}
		if($this->settings['address']['new']['validate']['returnStandalone'] == 1){
			$this->view->assign('newAddress', $this->newAddress);
			$this->view->assign('existingAddressesOwn', $this->existingAddressesOwn);
			$this->view->assign('existingAddressesOther', $this->existingAddressesOther);
			$this->view->assign('requiredFieldEmpty', $this->requiredFieldEmpty);
			
		}else{
			$this->forward('new', NULL, NULL, $this->request->getArguments());
		}
	}

	/**
	 * action create
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $newAddress
	 * @return void
	 */
	public function createAction(\TYPO3\Z3Shop\Domain\Model\Address $newAddress) {
		
		$user = $GLOBALS['TSFE']->fe_user->user; 
		$this->customer = $this->customerRepository->findByUid($user['uid']);
		
		
		if( $this->settings['address']['new']['feOwnerRequired'] > 0){
			$newAddress->addCustomer($this->customer);
		}
		
		// @workaround
		$newAddress->setTxExtbaseType($this->settings['address']['new']['defaultValues']['extbaseType']);

		$existingAddresses = $this->checkExistence($newAddress);
		$requiredFieldEmpty = $this->checkRequiredField($newAddress);

		$this->addressRepository->add($newAddress);
		$this->flashMessageContainer->add('Your new Address was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $address
	 * @return void
	 */
	public function editAction(\TYPO3\Z3Shop\Domain\Model\Address $address) {
		$this->view->assign('address', $address);
	}
	
	/**
	 * action edit
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $address
	 * @param array $customer
	 * @return void
	 */
	public function checkExistence(\TYPO3\Z3Shop\Domain\Model\Address $address, $customer=NULL) {
		$propertiesConf = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->settings['address']['new']['validate']['existence']['properties']);
		$properties = array();
		foreach( $propertiesConf as $propertyName){
			$getter = 'get'.ucFirst($propertyName);
			$propertyValue = $address->$getter();
//			if($propertyValue !== NULL || $propertyValue != ''){
				$properties[$propertyName] = $propertyValue;
//			}
		}
		
		if($this->settings['address']['new']['validate']['existence']['sameUserOnly'] == 1 && $customer !== NULL) {
			$properties['customer'] = $customer;
		}
		$existence = $this->addressRepository->findByProperties($properties, $customer);
		if(count($existence) == 0){
			$existence = FALSE;
		}
		return $existence;
	}
	
	public function checkRequiredField(\TYPO3\Z3Shop\Domain\Model\Address $address) {
		$propertiesConf = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->settings['address']['new']['validate']['notEmpty']['requiredProperties']);
		$emptyFields = FALSE;
		foreach( $propertiesConf as $propertyName){
			$getter = 'get'.ucFirst($propertyName);
			if ($address->$getter() === NULL || $address->$getter() === '' ){
				if(!$emptyFields){
					$emptyFields=array();
				}
				$emptyFields[] = $propertyName;
			}
		}
		return $emptyFields;
	}
	/**
	 * action edit
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $address
	 * @return void
	 */
	public function jsonCheckExistanceAction(\TYPO3\Z3Shop\Domain\Model\Address $address, $user=NULL) {
	
		$result = $this->getSimilarAddresses($address, $user);

		return json_encode($result);
	}

	/**
	 * action update
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $address
	 * @return void
	 */
	public function updateAction(\TYPO3\Z3Shop\Domain\Model\Address $address) {
		$this->addressRepository->update($address);
		$this->flashMessageContainer->add('Your Address was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Address $address
	 * @return void
	 */
	public function deleteAction(\TYPO3\Z3Shop\Domain\Model\Address $address) {
		$user = $GLOBALS['TSFE']->fe_user->user; 
		
		// only be able to remove own adresses!
		if($user['uid'] > 0 && $user['uid'] == $address->getCustomer()->getUid()){
			$this->addressRepository->remove($address);
			$this->flashMessageContainer->add('Your Address was removed.');
			$this->redirect('list');
		}else{
			$this->flashMessageContainer->add('You don\'t have permission to remove this address.');
			$this->redirect('list');
		}
	}

	
}
?>