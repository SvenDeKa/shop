<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_z3shop_domain_model_order'] = array(
	'ctrl' => $TCA['tx_z3shop_domain_model_order']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, number, payment_type, shipping_type, payment_fee, shipping_fee, confirmed_terms, ordered, shipped, payed, crypt, products, customer, shipping_address, billing_address',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, number, payment_type, shipping_type, payment_fee, shipping_fee, confirmed_terms, ordered, shipped, payed, crypt, products, customer, shipping_address, billing_address,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_z3shop_domain_model_order',
				'foreign_table_where' => 'AND tx_z3shop_domain_model_order.pid=###CURRENT_PID### AND tx_z3shop_domain_model_order.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'number' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.number',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'payment_type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.payment_type',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'shipping_type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.shipping_type',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'payment_fee' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.payment_fee',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			),
		),
		'shipping_fee' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.shipping_fee',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			),
		),
		'confirmed_terms' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.confirmed_terms',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'ordered' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.ordered',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'shipped' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.shipped',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'payed' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.payed',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'crypt' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.crypt',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'shipping_address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.shipping_address',
			'config' => array(
				'type' => 'select', //'inline',
				'foreign_table' => 'tx_z3shop_domain_model_address',
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
		'billing_address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.billing_address',
			'config' => array(
				'type' => 'select', //'inline',
				'foreign_table' => 'tx_z3shop_domain_model_address',
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
		'customer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_cart.feuser',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'fe_users',
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
		'cart' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_order.cart',
			'config' => array(
				'type' => 'select', //'inline',
				'foreign_table' => 'tx_z3shop_domain_model_cart',
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
	),
);

?>