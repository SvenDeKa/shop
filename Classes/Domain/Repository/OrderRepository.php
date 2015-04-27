<?php
namespace TYPO3\Z3Shop\Domain\Repository;

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
class OrderRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * 
	 * @param array $filtersets
	 * @return 
	 */
	protected $defaultOrderings = array (
		'uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
	);
	
	
	
    public function initializeObject() {
        $querySettings = $this->objectManager->create('Tx_Extbase_Persistence_Typo3QuerySettings');
        $querySettings->setRespectStoragePage(FALSE);
        $this->setDefaultQuerySettings($querySettings);
    }
	
	/**
	 * suche nach Bestellung anhand von email und best.-Nummer
	 * 
	 * @param string $email
	 * @param string $number
	 * @return type
	 */
	public function search($email,$number){
		
		$query = $this->createQuery();

		$query->matching( 
			$query->logicalAnd(
				$query->equals('billingEmail', $email),
				$query->equals('number', $number)
			)
		);
		return $query->execute();
	}
	
	/**
	 * 
	 * @param string $mode
	 * @return string
	 */
	public function countLatest($mode){
		
		$query = $this->createQuery();
		
		// now we only need perDay and maybe all. @ToDo:  add more Modes in the Future
		if($mode=='perDay'){
			$todayMidnight = strtotime('today midnight');
			$query->matching($query->greaterThan('crdate',$todayMidnight));
		}else{
			$query->matching($query->greaterThan('crdate',0));
		}
		
		return $query->execute()->count();
	}
}
?>