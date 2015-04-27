<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_z3shop_domain_model_address'] = array(
	'ctrl' => $TCA['tx_z3shop_domain_model_address']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, customer, is_default_shipping, is_default_billing, firstname, lastname, address_street, address_number, company, postal_code, city, country, static_country,email,phone,mobile,fax,extra1,extra2',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, customer, is_default_shipping, is_default_billing, firstname, lastname, address_street, address_number, company, postal_code, city, country, static_country,email,phone,mobile,fax,extra1,extra2,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_z3shop_domain_model_address',
				'foreign_table_where' => 'AND tx_z3shop_domain_model_address.pid=###CURRENT_PID### AND tx_z3shop_domain_model_address.sys_language_uid IN (-1,0)',
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
		'customer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.feuser',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		
		'is_default_shipping' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.is_default_shipping',
			'config' => array(
				'type' => 'check',
			),
		),
		'is_default_billing' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.is_default_billing',
			'config' => array(
				'type' => 'check',
			),
		),
		'firstname' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.firstname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
//				'eval' => 'required'
			),
		),
		'lastname' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.lastname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
//				'eval' => 'required'
			),
		),
		'address_street' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.address_street',
			'config' => array(
				'type' => 'input',
				'size' => 30,
//				'eval' => 'required'
			),
		),
		'address_number' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.address_number',
			'config' => array(
				'type' => 'input',
				'size' => 30,
//				'eval' => 'required'
			),
		),
		'company' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.company',
			'config' => array(
				'type' => 'input',
				'size' => 30,
			),
		),
		'extra1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.extra1',
			'config' => array(
				'type' => 'input',
				'size' => 30,
			),
		),
		'extra2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.extra2',
			'config' => array(
				'type' => 'input',
				'size' => 30,
			),
		),
		'postal_code' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.postal_code',
			'config' => array(
				'type' => 'input',
				'size' => 30,
//				'eval' => 'required'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
//				'eval' => 'required'
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.country',
			'config' => array(
				'type' => 'input',
				'size' => 30
			),
		),
//		'static_country' => array(
//			'exclude' => 1,
//			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_addresss.static_country',
//			'config' => array(
//				'type' => 'select',
//				'foreign_table' => 'static_countries',
//				'minitems' => 1,
//				'maxitems' => 1,
//				'default' => 49
//			),
//		),
		
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'email'
			),
		),
		'phone' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.phone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
			),
		),
		'mobile' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.mobile',
			'config' => array(
				'type' => 'input',
				'size' => 30,
			),
		),
		'fax' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_address.fax',
			'config' => array(
				'type' => 'input',
				'size' => 30,
			),
		),
	),
);

?>