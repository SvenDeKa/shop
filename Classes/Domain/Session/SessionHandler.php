<?php
namespace TYPO3\Z3Shop\Domain\Session;

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
class SessionHandler  implements \t3lib_Singleton {
 
	
	/**
	 * checks if object is stored in the user´s session
	 * @param string $key
	 * @return boolean
	 */
	public function has($sessionKey) {
		$sessionData = $this->getFrontendUser()->getKey('ses', $sessionKey);
		if ($sessionData == '') {
			return false;
		}
		return true;
	}
	
    /**
     * Return stored session data
     * @return Object the stored object
     */
    public function get($sessionKey, $serial=true) {
        $sessionData = $this->getFrontendUser()->getKey('ses', $sessionKey);
		
		
		if(!$serial){
			return $sessionData;
		}else{
			return unserialize($sessionData);
		}

    }
 
    /**
     * Write session data
     * @param $object
     * @return \TYPO3\Z3Shop\Domain\Session\SessionHandler $this
     */
    public function store($sessionKey, $data, $serial=true) {
		
		if(!$serial){
			$sessionData = $data;
		}else{
			$sessionData = serialize($data);
		}
		
        $this->getFrontendUser()->setKey('ses', $sessionKey, $sessionData);
        $this->getFrontendUser()->storeSessionData();
		
    }
 
    /**
     * Clean up session
     * @return \TYPO3\Z3Shop\Domain\Session\SessionHandler $this
     */
    public function cleanUp($sessionKey) {

		$this->getFrontendUser()->setKey('ses', $sessionKey, NULL);
        $this->getFrontendUser()->storeSessionData();

		return $this;
    }
	
	
	/**
	 * Gets a frontend user which is taken from the global registry or as fallback from TSFE->fe_user.
	 *
	 * @return	ux_tslib_feUserAuth	The current extended frontend user object
	 * @throws	LogicException
	 */
	protected function getFrontendUser() {
		if ($GLOBALS['TSFE']->fe_user) {
			return $GLOBALS['TSFE']->fe_user;
		}
		throw new LogicException ( 'No Frontentuser found in session!' );
	}
}
?>
