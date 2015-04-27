<?php
namespace TYPO3\Z3Shop\Utility;

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
class Assets {

	public function addAssets($settings){
		// JS
		if($settings['assets']['includeJsInFooter'] == 1){
			if ($settings['assets']['jQueryLib'] != ''){
				$GLOBALS['TSFE']->getPageRenderer()->addJsFooterLibrary('tx_z3event_jquery', $GLOBALS['TSFE']->tmpl->getFileName($settings['assets']['jQueryLib']), 'text/javascript', FALSE, FALSE, '', TRUE);
			}
			if ($settings['assets']['jsFile'] != ''){
				$GLOBALS['TSFE']->getPageRenderer()->addJsFooterLibrary('tx_z3event_events', $GLOBALS['TSFE']->tmpl->getFileName($settings['assets']['jsFile']), 'text/javascript', FALSE, FALSE, '', TRUE);
			}
		}else{
			if ($settings['assets']['jQueryLib'] != ''){
				$GLOBALS['TSFE']->getPageRenderer()->addJsLibrary('tx_z3event_jquery', $GLOBALS['TSFE']->tmpl->getFileName($settings['assets']['jQueryLib']), 'text/javascript', FALSE, FALSE, '', TRUE);
			}
			if ($settings['assets']['jsFile'] != ''){
				$GLOBALS['TSFE']->getPageRenderer()->addJsLibrary('tx_z3event_events', $GLOBALS['TSFE']->tmpl->getFileName($settings['assets']['jsFile']), 'text/javascript', FALSE, FALSE, '', TRUE);
			}
		}
		// CSS
		if($settings['assets']['cssFile'] != ''){
			$GLOBALS['TSFE']->getPageRenderer()->addCssFile($GLOBALS['TSFE']->tmpl->getFileName($settings['assets']['cssFile']), 'stylesheet', 'all', '', FALSE);
		}
	}

}       