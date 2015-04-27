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
class CheckoutController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	
	/**
	 * session
	 * 
	 * @var \TYPO3\Z3Shop\Domain\Session\SessionHandler
	 * @inject
	 */
	protected $session;
	
	
	/**
	 * Feuser
	 * 
	 * @var Tx_Extbase_Domain_Repository_FrontendUserRepository
	 * @inject
	 */
	protected $frontendUserRepository;
	
	
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
	 * customerRepository
	 *
	 * @var \TYPO3\Z3Shop\Domain\Repository\CustomerRepository
	 * @inject
	 */
	protected $customerRepository;
	
	
	/**
	 * orderRepository
	 *
	 * @var \TYPO3\Z3Shop\Domain\Repository\OrderRepository
	 * @inject
	 */
	protected $orderRepository;
	
	
	/**
	 * addressRepository
	 *
	 * @var \TYPO3\Z3Shop\Domain\Repository\AddressRepository
	 * @inject
	 */
	protected $addressRepository;
	
	
	

	/**
	 * checkoutData
	 * @var array
	 */
	protected $checkoutInputData;
	
	
	/**
	 * 
	 */
	protected $feUser;
	/**
	 * 
	 */
	protected $customer;
	
	
	
	public function init(){

//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings, 'checkout ->init');
		$this->persistenceManager = $this->objectManager->get('\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager');
//		$this->setOrderData();
		
		if( !empty($GLOBALS['TSFE']->fe_user->user) ){
			$this->customer = $this->customerRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
//			\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->customer,'$this->customer');
		}else{
			$this->customer = $this->objectManager->get('\TYPO3\Z3Shop\Domain\Model\Customer');
		}
		
		$this->checkoutInputData = $this->setCheckoutSession();
	}
	
	public function checkoutAction(){
		$this->init();
		
		// go to other steps if step-argument is given:
		$arguments = $this->request->getArguments();
		
		if( $this->request->hasArgument('step') && $arguments['step'] !== '' && $arguments['step'] !== 'index' ){
			
			$step = $this->request->getArgument('step');
			if($step !== '' && $step !='checkout'){
				$this->forward($step, NULL, NULL, $arguments);
			}
		}else if( $GLOBALS["TSFE"]->fe_user->user["uid"] > 0 ){
			$this->forward('customerData', NULL, NULL, $arguments);
		}
		$this->view->assign('cart', $this->getCart());
		$this->view->assign('arguments', $arguments );
		$this->view->assign('customer', $this->customer );
		$this->view->assign('order', $this->order );
//		$this->view->assign('settings', $this->settings );
	}
	
	
	
	public function customerDataAction(){
		$this->init();
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings);
		$this->view->assign('settings', $this->settings );

		$arguments = $this->request->getArguments();
		$this->view->assign('arguments', $arguments );
		
		$this->view->assign('cart', $this->getCart());
		$this->view->assign('customer', $this->customer );
		$this->view->assign('order', $this->order );
	}
	
	
	
	public function customAction(){
		$this->init();
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings , '$settings');
		$this->view->assign('cart', $this->getCart());
		
		$arguments = $this->request->getArguments();
		$this->view->assign('arguments', $arguments );
		
		$this->view->assign('customer', $this->customer );
		$this->view->assign('order', $this->order );
	}
	
	
	
	public function chooseModalitiesAction(){
		$this->init();
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings);
		$this->view->assign('cart', $this->getCart());
		
		$arguments = $this->request->getArguments();
		$this->view->assign('arguments', $arguments );
		
		$this->view->assign('customer', $this->customer );
		$this->view->assign('order', $this->order );
	}
	
	
	
	public function overviewAction(){
		$this->init();
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings);
		$this->view->assign('cart', $this->getCart());
		
		$arguments = $this->request->getArguments();
		$this->view->assign('arguments', $arguments );
		
		$this->view->assign('customer', $this->customer );
		$this->view->assign('order', $this->order );
	}
	
	
	
	public function confirmationAction(){
		$this->init();
		
		//	save order
		if($this->settings['checkout']['confirmation']['saveOrderOnConfirmation']!=0){
			$this->orderRepository->add($this->order);
			$this->persistenceManager->persistAll();
		}
		//	send mails
		$orderedCart = $this->order->getCart();
		foreach($this->settings['ordermail'] as $mailTemplate => $mailSettings){
			if($mailSettings['perProduct']==1){
				
				$orderedProducts = $orderedCart->getProducts();
				for( $i=0; $i < sizeof($orderedCart->getProducts()); $i++ ){
					$this->confirmByMail($mailTemplate, $this->customer, $this->order, $orderedProducts[$i], $mailSettings);
				}
			}else{
				$this->confirmByMail($mailTemplate, $this->customer, $this->order, NULL, $mailSettings);
			}
		}
		
		
		//	is this still needed?
		$arguments = $this->request->getArguments();
		$this->view->assign('arguments', $arguments );
		//	assign template vars
		$this->view->assign('customer', $this->customer );
		$this->view->assign('order', $this->order );
		$this->view->assign('cart', $this->getCart());
		
		//	clean up the cart, if wanted.
		if($this->settings['checkout']['confirmation']['cleanCartOnConfirmation']==1){
			$this->session->cleanUp('cart');
		}
		//	clean up the checkout-session
		if($this->settings['checkout']['confirmation']['cleanCheckoutOnConfirmation']==1){
			$this->session->cleanUp('checkout');
		}
	}
	
	
	
	private function confirmByMail($mailTemplate, $customer, $order, $product=NULL, $mailSettings){
		$mail = $this->plainEmailTemplate($mailTemplate);
		$mail->assign('customer', $customer);
		$mail->assign('order', $order);
		$mail->assign('cart', $product);
//		$mail->assign('test', 'die TEST-Variable wird auch vom Controller gefüllt. astrein. \n viele Gruesse, dein Z3Shop-Checkout.');
		$messageBody = $mail->render();
		$this->sendMail_SwiftMsg($mailSettings, $messageBody);
	}
	
	
	/**
	 * Mailing via Swift - Testing
	 * 
	 * @param type $mailSettings
	 * @param type $messageBody
	 */
	protected function sendMail_SwiftMsg($mailSettings, $messageBody){
		$mail = new \TYPO3\CMS\Core\Mail\MailMessage();

		$mail->setContentType('text');
		// make this configurable!!! [TS]
		$encoder = $this->setEmailEncoding($mailSettings);
		$mail->setEncoder($encoder);
		$mail->setSubject($mailSettings['subject']);
		
		$mail->setFrom(array($mailSettings['sender']['email'] => $mailSettings['sender']['name']))
			->setTo(array($mailSettings['recipient']['email'] => $mailSettings['recipient']['name']))
			->setBody($messageBody);
		$mail->send();
		if($mail->isSent()) {
			$this->flashMessageContainer->add('Mail erfolgreich versandt');
		} else {
			$this->flashMessageContainer->add('Die Mail wurde nicht versandt.');
		}
	}
	
	/**
	 * 
	 * @param type $arguments
	 * @dontvalidate $arguments
	 * @return type
	 */
	public function mapOrderData($arguments){
		
		$this->order = $this->getCheckoutSession();
		if(!$this->order){
			$this->order = $this->objectManager->get('\TYPO3\Z3Shop\Domain\Model\Order');
		}
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->order,'order in CheckoutController::mapOrderData');
		
		//processing Adressdata
		$refferingStep = NULL;
		if( $this->request->hasArgument('refferingStep')){
			$refferingStep = $this->request->getArgument('refferingStep');
		}
		if($refferingStep == 'customerData'){
			//billing Address
			$billingAddress = $this->addressRepository->findByUid($arguments['order']['billingAddress']);
			if($billingAddress !== NULL){
				if( is_array($arguments['order']['billingAddressAttributes']) ){
					$billingAddress = $this->mapAddressData($arguments['order']['billingAddressAttributes'], $billingAddress);
					$this->addressRepository->update($billingAddress);
				}
			}else{
				$billingAddress = $this->mapAddressData($arguments['order']['billingAddressAttributes'], $billingAddress);
				$this->addressRepository->add($billingAddress);
			}
			
			$this->persistenceManager->persistAll();
			$this->order->setBillingAddress( $billingAddress );
			
			if($this->settings['checkout']['noSeperateShippingAddress'] == 1){
				$this->order->setShippingAddress( $billingAddress );
			}else{
//				
//				shippingAddress  not for now.....
				$this->order->setShippingAddress( $billingAddress ); //samesame...
//				
//				$shippingAddress = $this->addressRepository->findByUid($arguments['order']['shippingAddress']);
//				if($shippingAddress !== NULL){
//					if( is_array($arguments['order']['shippingAddressAttributes']) ){
//						$shippingAddress = $this->mapAddressData($arguments['order']['shippingAddressAttributes'], $shippingAddress);
//						$this->addressRepository->update($shippingAddress);
//					}
//				}else{
//					$shippingAddress = $this->mapAddressData($arguments['order']['shippingAddressAttributes'], $shippingAddress);
//					$this->addressRepository->add($shippingAddress);
//				}
//				
//				$this->order->setShippingAddress( $shippingAddress );
			
			}
			
			
//			else if($defaultAddress !== NULL){
//				$defaultAddress = $this->customer->getDefaultShippingAddress();
//				$this->order->setShippingAddress($defaultAddress);
//			}
			
////			\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->customer->getDefaultBillingAddress());
//			$defaultAddress = $this->customer->getDefaultBillingAddress();
//			if(is_array($arguments['order']['billingAddress']) && $arguments['order']['separateBilling']){
//				$this->order->setBillingAddress( $this->mapAddressData($arguments['order']['billingAddress']) );
//			}else if($defaultAddress !== NULL){
//				$this->order->setBillingAddress($defaultAddress);
//			}
		
		}
		
		if(is_array($arguments['customer'])){
			
		}
		// we should always check the cart session, so we dont loose tack of changes. (for now)
		
		$this->order->setCart($this->getCart());
	
		
		return $this->order;
		
	}
	/**
	 * 
	 * @param type $address
	 * @dontvalidate $address
	 * @return type
	 */
	public function mapAddressData($addressProperties, $addressObj = NULL){
		if($addressObj === NULL){
			$addressObj = $this->objectManager->get('\TYPO3\Z3Shop\Domain\Model\Address');
		}
		foreach ($addressProperties as $property => $value){
			
			$setter = 'set'.ucfirst($property);
			$getter = 'set'.ucfirst($property);
			
			if($addressObj->$getter() != $addressProperties[$property]){
				$addressObj->$setter($value);
			}
		}
		return $addressObj;
	}
	
	/**
	 * @ToDo: write Checkout-Data into ssession
	 * @return type
	 */
	public function getCheckoutSession(){
		if($this->session->has('checkout')){
			return $this->session->get('checkout');
		}else{
			return FALSE;
		}
	}
	
	/**
	 * @ToDo: write Checkout-Data into ssession
	 * @return type
	 */
	public function setCheckoutSession(){
		$this->mapOrderData($this->request->getArguments());
		$this->session->store('checkout', $this->order);
		return $this->session->get('checkout');
	}
	
	
	
	public function getCart(){
		
		$this->session = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Domain\Session\SessionHandler');
		$cart = NULL;
		
		if( $this->session->has('cart') ) {
			$cart = $this->cartRepository->findByUid($this->session->get('cart'));
		} else {
			new \Exception('nothing in Cart / no cart');
		}
		return $cart;
	}
	
	protected function setEmailEncoding($mailSetting){
		switch ($mailSetting['encoding']){
			case 'Plain_7bit':
				$encoding = new \Swift_Mime_ContentEncoder_PlainContentEncoder('7bit');
				break;
			case 'Base64':
				$encoding = new \Swift_Mime_ContentEncoder_Base64ContentEncoder();
				break;
			default:
				$encoding = new \Swift_Mime_ContentEncoder_Base64ContentEncoder();
				
		}
		return $encoding;
	}
	
	
	protected function plainEmailTemplate($templateName = 'defaultMail') {
		$emailView = $this->objectManager->create('\TYPO3\CMS\Fluid\View\StandaloneView');
		$emailView->setFormat('txt');
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$templatePathAndFilename = $templateRootPath .'/'. $this->request->getControllerName().'/' . $templateName . '.txt';
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->assign('settings', $this->settings);
		return $emailView;
	}
	
}
?>