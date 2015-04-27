<?php
namespace TYPO3\Z3Shop\Utility;

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
class OrderNum {
	
	/**
	 * 
	 * @return string
	 */
	public function buildNum(){
		
		// get settings
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$configurationManager = $objectManager->get('TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface');
		$settings = $configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Z3Shop', 'Shop'
		);	
		
		foreach($settings['orderNum'] as $substrConf){
			switch($substrConf['type']){
				case'text':
					$orderNum .= $substrConf['value'];
					break;
				case'date':
					$orderNum .= $this->buildDate($substrConf);
					break;
				case'increment':
					$orderNum .= $this->buildIncrement($substrConf);
					break;
			}
		}
		
		return $orderNum;
	}
	
	
	private function buildDate($conf){
		$datetime = new \DateTime();
		$date = $datetime->format($conf['format']);
		
		return $date;
	}
	
	private function buildIncrement($conf){
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Object_ObjectManager');
		$this->persistenceManager = $objectManager->get('Tx_Extbase_Persistence_Manager');
		$this->orderRepository = $objectManager->get('TYPO3\Z3Shop\Domain\Repository\OrderRepository');
		
		$increment = $this->orderRepository->countLatest($conf['mode']);
		$increment++;
				
		return $increment;
	}
}

?>
