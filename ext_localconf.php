<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
$TYPO3_CONF_VARS['FE']['eID_include']['z3shop'] = 'EXT:z3_shop/Classes/Utility/AjaxDispatcher.php';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Products',
	array(
		'Product' => 'list, show, showPriceInfo',
		'Address' => 'list, show, edit, new',
		'Cart' => 'show, update',
		'Order' => 'list, search, show, return',
		'Checkout' => 'index, customerData, custom, chooseModalities, overview, confirm',
	),
	// non-cacheable actions
	array(
		'Cart' => 'show, update',
		'Address' => 'show, edit,new',
		'Order' => 'search, show, return',
		'Checkout' => 'index, customerData, custom, chooseModalities, overview, confirm',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Checkout',
	array(
		'Checkout' => 'checkout, customerData, custom, chooseModalities, overview, confirm',
	),
	// non-cacheable actions
	array(
		'Checkout' => 'checkout, customerData, custom, chooseModalities, overview, confirm',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Cart',
	array(
		'Cart' => 'show,update',
	),
	// non-cacheable actions
	array(
		'Cart' => 'show, update',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Customer',
	array(
		'Address' => 'list,show,new,create,edit,update',
	),
	// non-cacheable actions
	array(
		'Cart' => 'show, new, create edit, update',
	)
);
// Switchable-ControllerAction-onChange
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_befunc.php']['getFlexFormDSClass'][$_EXTKEY] =
 'EXT:' . $_EXTKEY. '/Classes/Hooks/T3libBefunc.php:T3libBefunc';


?>