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
 * override the New-Controller from femanager
 *
 * @package z3_shop
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class RegisterAbstractController extends \In2\Femanager\Controller\AbstractController{
	
	/**
	 * Redirect
	 *
	 * @param \string $action		"new", "edit"
	 * @param \string $category		"redirect", "requestRedirect" value from TypoScript
	 * @return void
	 */
	protected function redirectByAction($action = 'new', $category = 'redirect') {
//		$target = NULL;
//		// redirect from TypoScript cObject
//		/*
//		if ($this->cObj->cObjGetSingle($this->config[$action . '.'][$category], $this->config[$action . '.'][$category . '.'])) {
//			$target = $this->cObj->cObjGetSingle($this->config[$action . '.'][$category], $this->config[$action . '.'][$category . '.']);
//		}
//
//		// if redirect target
//		if ($target) {
//			$this->uriBuilder->setTargetPageUid($target);
//			$this->uriBuilder->setLinkAccessRestrictedPages(TRUE);
//			$link = $this->uriBuilder->build();
//			$this->redirectToUri($link);
//		}
//		*/
//		$linkConf = $this->config[$action . '.'][$category . '.']['typolink.']['parameter'];
//		$this->uriBuilder = $this->objectManager->get('Tx_Extbase_MVC_Web_Routing_UriBuilder');
//		$this->uriBuilder->reset();
//		$this->uriBuilder->setRequest($this->request);
//		$uri = $this->uriBuilder
//				->setTargetPageUid($linkConf)
//				->setCreateAbsoluteUri(TRUE)
//				->buildFrontendUri();
		
		$this->redirectToURI('/buchung/?tx_z3shop_checkout[step]=customerData&tx_z3shop_checkout[checkoutMode]=0&tx_z3shop_checkout[action]=checkout&tx_z3shop_checkout[controller]=Checkout');
	}
}
