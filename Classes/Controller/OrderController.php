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
class OrderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	
	/**
	 * orderRepository
	 *
	 * @var \TYPO3\Z3Shop\Domain\Repository\OrderRepository
	 * @inject
	 */
	protected $orderRepository;
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$orders = $this->orderRepository->findAll();
		$this->view->assign('orders', $orders);
		
		//	load Assets
		$assets = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Utility\Assets');
		$assets->addAssets($this->settings);
	}

	/**
	 * action show
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Order $order
	 * @return void
	 */
	public function showAction(\TYPO3\Z3Shop\Domain\Model\Order $order) {
		$this->view->assign('order', $order);
		
		//	load Assets
		$assets = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Shop\Utility\Assets');
		$assets->addAssets($this->settings);
		
	}

	/**
	 * action new
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Order $newOrder
	 * @dontvalidate $newOrder
	 * @return void
	 */
	public function newAction(\TYPO3\Z3Shop\Domain\Model\Order $newOrder = NULL) {
		if ($newOrder == NULL) { // workaround for fluid bug ##5636
			$newOrder = t3lib_div::makeInstance('');
		}
		$this->view->assign('newOrder', $newOrder);
		
	}

	/**
	 * action create
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Order $newOrder
	 * @return void
	 */
	public function createAction(\TYPO3\Z3Shop\Domain\Model\Order $newOrder) {
		$this->orderRepository->add($newOrder);
		$this->flashMessageContainer->add('Your new Order was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Order $order
	 * @return void
	 */
	public function editAction(\TYPO3\Z3Shop\Domain\Model\Order $order) {
		$this->view->assign('order', $order);
	}

	/**
	 * action update
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Order $order
	 * @return void
	 */
	public function updateAction(\TYPO3\Z3Shop\Domain\Model\Order $order) {
		$this->orderRepository->update($order);
		$this->flashMessageContainer->add('Your Order was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \TYPO3\Z3Shop\Domain\Model\Order $order
	 * @return void
	 */
	public function deleteAction(\TYPO3\Z3Shop\Domain\Model\Order $order) {
		$this->orderRepository->remove($order);
		$this->flashMessageContainer->add('Your Order was removed.');
		$this->redirect('list');
	}

	/**
	 * action search
	 *
	 * @return void
	 */
	public function searchAction() {

	}

	/**
	 * action return
	 *
	 * @return void
	 */
	public function returnAction() {

	}

}
?>