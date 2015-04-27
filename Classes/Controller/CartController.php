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
class CartController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	
	/**
	 * @var \TYPO3\Z3Shop\Domain\Session\SessionHandler
	 */
	protected $session = NULL;
	
	
	/**
	 * partRepository
	 *
	 * @var \TYPO3\Z3Shop\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository;
	
	/**
	 * partRepository
	 *
	 * @var \TYPO3\Z3Shop\Domain\Repository\CartRepository
	 * @inject
	 */
	protected $cartRepository;
	
	/**
	 * partRepository
	 *
	 * @var \TYPO3\Z3Shop\Domain\Repository\ProductCartRepository
	 * @inject
	 */
	protected $productCartRepository;
	
	
	
	/**
	 * action updateConfigurations
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Product $product
	 * @param int $amount
	 * @param string $mode
	 * @return void
	 */
	public function updateAction( \TYPO3\Z3Shop\Domain\Model\Product $product, $amount, $mode){
		
		
		if($this->request->hasArgument('additionalAttributes')){
			$additionalAttributes = $this->request->getArgument('additionalAttributes');	
		}
		if( intval( $amount) == 0 ){
			$mode='remove';
		}
		
		$cart = array();
		
		switch($mode){
			case 'add': 
				$cart = $this->addToCart( $product, $amount, $additionalAttributes);
				break;
			case 'update': 
				$cart = $this->updateCart( $product, $amount, $additionalAttributes);
				break;
			case 'remove': 
				$cart = $this->removeFromCart( $product );
				break;
			case 'reset': 
				$cart = $this->resetCart();
				break;
			default: 
				$cart = $this->addToCart( $product, $amount, $additionalAttributes);
				break;
		}
		
		// all done. redirect.
		if($this->request->hasArgument('redirectAction')){
			$controllerName = NULL;
			if($this->request->hasArgument('redirectController')){
				$controllerName = $this->request->getArgument('redirectController');
			}
			
			$this->forward($this->request->getArgument('redirectAction'), $controllerName);
		} else {
			$this->forward('show');
		}
		
		
	}
	
//	
//	/**
//	 * action show
//	 *
//	 * @param \TYPO3\Z3Shop\Domain\Model\Product $product
//	 * @return void
//	 */
//	public function showPriceInfoAction(\TYPO3\Z3Shop\Domain\Model\Product $product) {
//		$this->view->assign('product', $product);
//	}
	

	
	/**
	 * action showCart
	 * 
	 * @return void
	 */
	public function showAction(){
		
		$this->session = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Session\SessionHandler');
		$cart = NULL;
		
		if($this->session->has('cart') ) {
			$cart = $this->cartRepository->findByUid($this->session->get('cart'));
		}
		$this->view->assign('cart', $cart);

	}


	/**
	 * 
	 * @param \TYPO3\Z3Shop\Domain\Model\Product $product
	 * @param int $amount
	 * @return array
	 */
	public function addToCart( \TYPO3\Z3Shop\Domain\Model\Product $product, $amount, $additionalArrtibutes=NULL){
		
//		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Object_ObjectManager');
//		$this->persistenceManager = $objectManager->get('Tx_Extbase_Persistence_Manager');

		$this->session = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Session\SessionHandler');
		
		if($this->session->has('cart') ) {
			$cartUid = $this->session->get('cart');
			$cart = $this->cartRepository->findByUid($cartUid);
			// If part exists in Cart: change amount | else add it
			$productCart = $this->productCartRepository->findByCartAndProduct($cart, $product);
			$productCart = $productCart[0];
			if($productCart !== NULL){
				$amountInCart = $productCart->setAmount();
				$productCart->setAmount( intval($amountInCart) + intval($amount) );
				$this->productCartRepository->update($productCart);
			}else{ 
				$this->writeProductToCart($cart, $product, $amount, $additionalArrtibutes);
			}
			
		}else{
			$newCart = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Model\Cart');
			$this->cartRepository->add($newCart);
			$this->persistenceManager->persistAll();
			
			$this->writeProductToCart($newCart, $product, $amount, $additionalArrtibutes);
			
			$cartUid = $newCart->getUid();
			$this->session->store('cart', $cartUid);
		}
		
		return $cart;
	}


	/**
	 * 
	 * @param \TYPO3\Z3Shop\Domain\Model\Product $product
	 * @return array
	 */
	public function removeFromCart(\TYPO3\Z3Shop\Domain\Model\Product $product){
		$this->session = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Session\SessionHandler');
		
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Object_ObjectManager');
		$this->persistenceManager = $objectManager->get('Tx_Extbase_Persistence_Manager');

		if($this->session->has('cart') ) {
			$cartUid = $this->session->get('cart');
			$cart = $this->cartRepository->findByUid($cartUid);
			// If part exists in Cart: change amount | else add it
			$productCart = $this->productCartRepository->findByCartAndProduct($cart, $product);
			$productCart = $productCart[0];
			if($productCart !== NULL){
				$cart->removeProduct($productCart);
				$this->productCartRepository->remove($productCart);
			}
			
			$this->persistenceManager->persistAll();
			return $cart;
		}else{
			return false;
		}
		
	}
	
	
	/**
	 * 
	 * @param \TYPO3\Z3Shop\Domain\Model\Product $product
	 * @param int $amount
	 * @return array
	 */
	public function updateCart(\TYPO3\Z3Shop\Domain\Model\Product $product, $amount, $additionalAttributes=NULL){

		$amount = intval($amount);
//		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Object_ObjectManager');
//		$this->persistenceManager = $objectManager->get('Tx_Extbase_Persistence_Manager');

		$this->session = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Session\SessionHandler');
			
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Object_ObjectManager');
		$this->persistenceManager = $objectManager->get('Tx_Extbase_Persistence_Manager');
			
		
		if($this->session->has('cart') && $this->session->get('cart') > 0) {
						
			$cartUid = $this->session->get('cart');
			$cart = $this->cartRepository->findByUid($cartUid);
			// If part exists in Cart: change amount | else add it
			$productCart = $this->productCartRepository->findByCartAndProduct($cart, $product);
			$productCart = $productCart[0];
			if($productCart !== NULL){
				$productCart->setAmount( $amount );
				
				foreach($additionalAttributes as $name => $value){
					$setter = 'set'.ucfirst($name);
					$productCart->$setter($value);
				}
				$this->productCartRepository->update($productCart);
			}else{ 
				$this->writeProductToCart($cart, $product, $amount, $additionalAttributes);
			}
			$this->persistenceManager->persistAll();
		}else{
			
			$newCart = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Model\Cart');
			$newCart->setSessionId(1234567890);
			$this->cartRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Repository\CartRepository');
			$this->cartRepository->add( $newCart );
			
			
			$this->writeProductToCart($newCart, $product, $amount, $additionalAttributes);
			$this->persistenceManager->persistAll();
			$cartUid = $newCart->getUid();
			$this->session->store('cart', $cartUid);
		}
		
		return $cart;
	}
	
	/**
	 * 
	 * @return void
	 */
	public function resetCart(){
		
		$this->session = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Session\SessionHandler');
		
//		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Object_ObjectManager');
//		$this->persistenceManager = $objectManager->get('Tx_Extbase_Persistence_Manager');
		
		if( $this->session->has('cart') ) {
			$this->session->store('cart', NULL);
		}
		return $this->session->has('cart');
	}
	
	
	/**
	 * 
	 * @param \TYPO3\Z3Shop\Domain\Model\Cart $cart
	 * @param \TYPO3\Z3Shop\Domain\Model\Cart $product
	 * @param \int $amount
	 * @return \TYPO3\Z3Shop\Domain\Model\ProductCart
	 */
	private function writeProductToCart(\TYPO3\Z3Shop\Domain\Model\Cart $cart,\TYPO3\Z3Shop\Domain\Model\Product $product, $amount, $additionalArrtibutes){
		
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Object_ObjectManager');
		$this->persistenceManager = $objectManager->get('Tx_Extbase_Persistence_Manager');
		
		$newProductCart = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Model\ProductCart');
		$newProductCart->setCart($cart);
		$newProductCart->setProduct($product);
		$newProductCart->setAmount($amount);
		foreach($additionalArrtibutes as $name => $value){
			$setter = 'set'.ucfirst($name);
			$newProductCart->$setter($value);
		}
		$this->productCartRepository->add($newProductCart);
		
		$cart->addProduct($newProductCart);
		
		$this->persistenceManager->persistAll();
		
		return $newProductCart;
	}
}
?>