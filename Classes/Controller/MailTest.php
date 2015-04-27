<?php
class MailTest extends Tx_Extbase_MVC_Controller_ActionController {
	/**
	 * The data repository
	 * @var Tx_MyExt_Domain_Repository_DataRepository
	 */
	protected $dataRepository = NULL;
 
	public function initializeAction() {
		$this->dataRepository = t3lib_div::makeInstance('Tx_MyExt_Domain_Repository_DataRepository');
	}
 
	public function testAction() {
		// first of all, get the data
		$data = $this->dataRepository->findAll();
		// then send the notification
		$this->notify($data);
		// then do the standard stuff...
		$this->view->assign('data', $data);
	}
 
	protected function notify($data) {
		// create a Fluid instance for plain text rendering
		$renderer = $this->getPlainTextEmailRenderer('notify');
		// assign the data to it
		$renderer->assign('data', $data);
		// and do the rendering magic
		$message = $renderer->render();
		// finally, send the mail
		$this->sendMail('recipient@example.com', 'Eine Benachrichtigung!', $message, 'sender@example.com', 'Der Benachrichtiger');
	}
 
	protected function sendMail($recipient, $subject, $message, $senderEMail, $senderName='', $replyToEMail='', $replyToName='', $returnPath='', $organisation='') {
		$htmlMail = t3lib_div::makeInstance('t3lib_htmlmail');
		$htmlMail->start();
		$htmlMail->recipient = $recipient;
		$htmlMail->subject = $subject;
		$htmlMail->from_email = $senderEMail;
		$htmlMail->from_name = $senderName;
		$htmlMail->replyto_email = $replyToEMail != '' ? $replyToEMail : $senderEMail;
		$htmlMail->replyto_name = $replyToName != '' ? $replyToName : $senderName;
		$htmlMail->organisation = $organisation;
		$htmlMail->returnPath = $returnPath;
		$htmlMail->addPlain($message);
		$htmlMail->send($recipient);
	}
 
	/**
	 * This creates another stand-alone instance of the Fluid view to render a plain text e-mail template
	 * @param string $templateName the name of the template to use
	 * @return Tx_Fluid_View_StandaloneView the Fluid instance
	 */
	protected function getPlainTextEmailRenderer($templateName = 'default') {
		$emailView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
		$emailView->setFormat('txt');
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$templatePathAndFilename = $templateRootPath . $this->request->getControllerName().'/' . $templateName . '.txt';
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->assign('settings', $this->settings);
		return $emailView;
 
/* This is a variant for extbase versions prior to 1.3.0
		// create another instance of Fluid
		$renderer = t3lib_div::makeInstance('Tx_Fluid_View_TemplateView');
		// set the controller context
		$controllerContext = $this->buildControllerContext();
		$controllerContext->setRequest($this->request);
		$renderer->setControllerContext($controllerContext);
		// this is the default template path
		$templatePath = t3lib_extMgm::extPath($this->extensionKey) . 'Resources/Private/Templates/EMail/';
		// override the template path with individual settings in TypoScript
		$extbaseFrameworkConfiguration = Tx_Extbase_Dispatcher::getExtbaseFrameworkConfiguration();
		if (isset($extbaseFrameworkConfiguration['view']['templateRootPath']) && strlen($extbaseFrameworkConfiguration['view']['templateRootPath']) > 0) {
			$templatePath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		}
		$templateFile = $templatePath.$templateName.'.txt';
		// set the e-mail template
		$renderer->setTemplatePathAndFilename($templateFile);
		// and return the new Fluid instance
		return $renderer;
*/
	}
}
?>