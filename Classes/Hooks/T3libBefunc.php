<?php
namespace TYPO3\Z3Shop\Hooks;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Sven Külpmann <sven.kuelpmann@lenz-wie-fruehling.de>, Ziegelei3
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
class T3libBefunc{

	
	/**
	* Which fields to be removed in which View
	* @var array
	*/
	public $removedFieldsInProductList = array(
		'sDEF' => 'orderList.pid,productList.pid,cartShow.isEditable'
	);
	public $removedFieldsInProductShow = array(
		'sDEF' => 'orderList.pid,cartShow.isEditable'
	);
	public $removedFieldsInCartShow = array(
		'sDEF' => 'productList.pid,cartShow.pid'
	);
	public $removedFieldsInCartShowMini = array(
		'sDEF' => 'productList.pid,cartShow.pid'
	);
	public $removedFieldsInOrderList = array(
		'sDEF' => 'cartShow.pid,productList.pid,cartShow.isEditable'
	);
	
	
	/**
	* Hook function of t3lib_befunc
	*
	* @param array &$dataStructure Flexform structure
	* @param array $conf some strange configuration
	* @param array $row row of current record
	* @param string $table table anme
	* @param string $fieldName some strange field name
	* @return void
	*/
	public function getFlexFormDS_postProcessDS(&$dataStructure, $conf, $row, $table, $fieldName) {
		if ($table === 'tt_content' && $row['list_type'] === 'z3shop_shop' && is_array($dataStructure)) {
			$this->updateFlexforms($dataStructure, $row);
		}
	}

	/**
	* Update flexform configuration if a action is selected
	*
	* @param array|string &$dataStructure flexform structur
	* @param array $row row of current record
	* @return void
	*/
	protected function updateFlexforms(array &$dataStructure, array $row) {
		$selectedView = '';

		// get the first selected action
		$flexformSelection = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($row['pi_flexform']);
		if (is_array($flexformSelection) && is_array($flexformSelection['data'])) {
			$selectedView = $flexformSelection['data']['sDEF']['lDEF']['switchableControllerActions']['vDEF'];
			if (!empty($selectedView)) {
				$actionParts = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(';', $selectedView, TRUE);
				$selectedView = $actionParts[0];
			}

		// new plugin element
		} elseif(t3lib_div::isFirstPartOfStr($row['uid'], 'NEW')) {
			// use List as starting view
			// @todo dynamic check, getting view from $flexformSelection
			$selectedView = 'Product->list';
		}

		if (!empty($selectedView)) {
			// modify the flexform structure depending on the first found action
			switch ($selectedView) {
				case 'Product->list':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInProductList);
					break;
				case 'Product->show':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInProductShow);
					break;
				case 'Cart->show':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInCartShow);
					break;
				case 'Cart->showMini':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInCartShowMini);
					break;
				case 'Order->list':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInOrderList);
					break;
			}
		}
	}

	
	/**
	* Remove fields from flexform structure
	*
	* @param array &$dataStructure flexform structure
	* @param array $fieldsToBeRemoved fields which need to be removed
	* @return void
	*/
	private function deleteFromStructure(array &$dataStructure, array $fieldsToBeRemoved) {
		foreach ($fieldsToBeRemoved as $sheetName => $sheetFields) {
			$fieldsInSheet = t3lib_div::trimExplode(',', $sheetFields, TRUE);

			foreach ($fieldsInSheet as $fieldName) {
				unset($dataStructure['sheets'][$sheetName]['ROOT']['el']['settings.' . $fieldName]);
			}
		}
	}


}
?>
