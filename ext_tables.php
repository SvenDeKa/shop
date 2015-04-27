<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

/**
 *  register Plugins
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Products',
	'Products'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Checkout',
	'Checkout'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Cart',
	'Cart'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Customer',
	'Customer'
);

/**
 * FLEXFORMS
 */
$pluginSignature = str_replace('_','',$_EXTKEY) . '_products';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_products.xml');

$pluginSignature = str_replace('_','',$_EXTKEY) . '_cart';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_cart.xml');

$pluginSignature = str_replace('_','',$_EXTKEY) . '_checkout';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_checkout.xml');

$pluginSignature = str_replace('_','',$_EXTKEY) . '_customer';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_customer.xml');


/**
 * CONTENT-ELEMENT-WIZARD
 */
if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['TYPO3\Z3Shop\Hooks\EventWizicon'] =
		t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Hooks/BeWizard.php';
}

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'TYPO3.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'beorders',	// Submodule key
		'',						// Position
		array(
			'Product' => 'list, show','Order' => 'list, show, new, create, edit, update, delete, search, return','Cart' => 'show, ','Address' => 'list, show, new, create, edit, update, delete, ',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_beorders.xlf',
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Ordermanagement');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_z3shop_domain_model_product', 'EXT:z3_shop/Resources/Private/Language/locallang_csh_tx_z3shop_domain_model_product.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_z3shop_domain_model_product');
$TCA['tx_z3shop_domain_model_product'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_product',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,description,amount_in_shop,weight,record_type,tablename,item,prices,cart,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Product.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_z3shop_domain_model_product.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_z3shop_domain_model_order', 'EXT:z3_shop/Resources/Private/Language/locallang_csh_tx_z3shop_domain_model_order.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_z3shop_domain_model_order');
$TCA['tx_z3shop_domain_model_order'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order',
		'label' => 'number',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'number,payment_type,shipping_type,payment_fee,shipping_fee,confirmed_terms,ordered,shipped,payed,crypt,cart,shipping_address,billing_address,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Order.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_z3shop_domain_model_order.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_z3shop_domain_model_cart', 'EXT:z3_shop/Resources/Private/Language/locallang_csh_tx_z3shop_domain_model_cart.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_z3shop_domain_model_cart');
$TCA['tx_z3shop_domain_model_cart'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_cart',
		'label' => 'session_id',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'session_id,product_type,feuser,products,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Cart.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_z3shop_domain_model_cart.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_z3shop_domain_model_price', 'EXT:z3_shop/Resources/Private/Language/locallang_csh_tx_z3shop_domain_model_price.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_z3shop_domain_model_price');
$TCA['tx_z3shop_domain_model_price'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_price',
		'label' => 'price',
		'sortBy' => 'validfrom',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'validfrom',
			'endtime' => 'validuntil',
		),
		'searchFields' => 'validfrom, validuntil, price,taxrate,is_highlight,currency,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Price.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_z3shop_domain_model_price.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_z3shop_domain_model_address', 'EXT:z3_shop/Resources/Private/Language/locallang_csh_tx_z3shop_domain_model_address.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_z3shop_domain_model_address');
$TCA['tx_z3shop_domain_model_address'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address',
		'label' => 'customer',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'customer,is_default_shipping,is_default_billing,email,firstname,lastname,salutation,address_street,address_number,company,postal_code,city,country,static_country',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Address.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_z3shop_domain_model_address.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_z3shop_domain_model_productcart', 'EXT:z3_shop/Resources/Private/Language/locallang_csh_tx_z3shop_domain_model_productcart.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_z3shop_domain_model_productcart');
$TCA['tx_z3shop_domain_model_productcart'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_productcart',
		'label' => 'amount',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'amount,product,cart,reciever,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/ProductCart.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_z3shop_domain_model_productcart.gif'
	),
);





if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['fe_users']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['fe_users']['ctrl']['dynamicConfigFile']);
	}
//	// no type field defined, so we define it here. This will only happen the first time the extension is installed!!
//	$GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
//	$tempColumns = array();
//	$tempColumns[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = array(
//		'exclude' => 1,
//		'label'   => 'LLL:EXT:z3_uuid/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type',
//		'config' => array(
//			'type' => 'select',
//			'items' => array(),
//			'size' => 1,
//			'maxitems' => 1,
//		)
//	);
//	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumns, 1);
}
$tmp_feusers_columns = array(

	'number' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_customer.number',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim,required'
		),
	),
	'addresses' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_customer.addresses',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_z3shop_domain_model_address',
			'foreign_field' => 'customer',
			'minitems' => 0,
			'maxitems' => 1,
			'appearance' => array(
				'collapseAll' => 0,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1
			),
		),
	),
	'orders' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_customer.orders',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_z3shop_domain_model_order',
//			'foreign_field'=>'customer',
			'minitems' => 0,
			'maxitems' => 100000,
			'appearance' => array(
				'collapseAll' => 0,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1
			),
		),
	),
	'cart' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_customer.cart',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_z3shop_domain_model_cart',
//			'foreign_field' => 'customer',
			'minitems' => 0,
			'maxitems' => 1,
			'appearance' => array(
				'collapseAll' => 0,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1
			),
		),
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_feusers_columns);
$GLOBALS['TCA']['fe_users']['types']['0']['showitem'] .= ',--div--;LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_customer,';
$GLOBALS['TCA']['fe_users']['types']['0']['showitem'] .= 'number,addresses,orders,cart';
//$GLOBALS['TCA']['tx_z3shop_domain_model_address']['columns'][$TCA['tx_z3shop_domain_model_address']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:z3_uuid/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.tx_extbase_type.Tx_Z3Uuid_Address','Tx_Z3Uuid_Address');


?>