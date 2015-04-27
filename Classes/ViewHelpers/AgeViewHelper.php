<?php
namespace TYPO3\Z3Shop\ViewHelpers;

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
class AgeViewHelper extends \Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	* @var array
	*/
	protected $labels = array(
		'y' => array('year', 'years'),
		'm' => array('month', 'months'),
		'd' => array('day', 'days'),
		'h' => array('hour', 'hours'),
		'i' => array('minute', 'minutes'),
		's' => array('second', 'seconds')
	);
	/**
	* Renders the output of this view helper
	*
	* 
	* @param \DateTime $date
	* @param \string $format
	* @return string Identity
	* @api
	*/
	public function render($date, $format) {
//		$date = $this->renderChildren();
		if (!$date instanceof \DateTime) {
			throw new \TYPO3\CMS\Fluid\Exception('age expects a DateTime object, ' . \gettype($date) . ' given.', 1286531071);
		}
		$age = $this->formatDateDifference($date, NULL, $format) * -1;
		return $age;
	}

	/**
	* @param \DateTime $startDate
	* @param type $endDate
	* @param \string $format
	* @return string
	*/
	protected function formatDateDifference(\DateTime $startDate, $endDate, $format) {
		if($endDate === NULL) {
			$endDate = new \DateTime();
		}
		$dateInterval = $endDate->diff($startDate);
		
		return $dateInterval->format('%R%a');
	}

}
 
?>