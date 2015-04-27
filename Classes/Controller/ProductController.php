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
class ProductController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	
	
	/**
	 * productRepository
	 *
	 * @var \TYPO3\Z3Shop\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository;
	/**
	 * priceRepository
	 *
	 * @var \TYPO3\Z3Shop\Domain\Repository\PriceRepository
	 * @inject
	 */
	protected $priceRepository;
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$products = $this->productRepository->findAll();
		$this->view->assign('products', $products);
		
		//	load Assets
		$assets = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Utility\Assets');
		$assets->addAssets($this->settings);
	}

	/**
	 * action show
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Product $product
	 * @return void
	 */
	public function showAction(\TYPO3\Z3Shop\Domain\Model\Product $product) {
		$this->view->assign('product', $product);
		
		//	load Assets
		$assets = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Utility\Assets');
		$assets->addAssets($this->settings);
	}

	/**
	 * action show
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Product $product
	 * @return void
	 */
	public function showPriceInfoAction(\TYPO3\Z3Shop\Domain\Model\Product $product) {
		$this->view->assign('product', $product);
	}
	
	
}

?>
