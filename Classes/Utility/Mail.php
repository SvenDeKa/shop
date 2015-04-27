<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mail
 *
 * @author sven.kuelpmann
 */
class Mail {
	
	/**
	 * This creates another stand-alone instance of the Fluid view to render a plain text e-mail template
	 * @param string $templateName the name of the template to use
	 * @return Tx_Fluid_View_StandaloneView the Fluid instance
	 */
	protected function renderPlainTextEmail($templateName = 'default') {
		$emailView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
		$emailView->setFormat('txt');
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$templatePathAndFilename = $templateRootPath . $this->request->getControllerName().'/' . $templateName . '.txt';
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->assign('settings', $this->settings);
		return $emailView;
	}
}
