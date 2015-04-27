<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_z3shop_domain_model_price'] = array(
	'ctrl' => $TCA['tx_z3shop_domain_model_price']['ctrl'],
	'interface' => array(
//		'showRecordFieldList' => 'hidden, validfrom, validuntil, price, taxrate, is_highlight, currency, quantity',
		'showRecordFieldList' => 'hidden, validfrom, validuntil, price, variant, taxrate, is_highlight, quantity',
	),
	'types' => array(
//		'1' => array('showitem' => ';;;1-1-1, hidden;;1, validfrom, validuntil, price, taxrate, is_highlight, currency, quantity'),
		'1' => array('showitem' => ';;;1-1-1, hidden;;1, validfrom, validuntil, price, variant, taxrate, is_highlight, quantity'),
	),
	'palettes' => array(
		'0' => array('showitem' => ''),
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
				'foreign_table' => 'tx_z3shop_domain_model_price',
				'foreign_table_where' => 'AND tx_z3shop_domain_model_price.pid=###CURRENT_PID### AND tx_z3shop_domain_model_price.sys_language_uid IN (-1,0)',
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
				'default' => 1,
			),
		),
		
		
		
		'validfrom' => array(
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
		'validuntil' => array(
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
		
		
		'price' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_price.price',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2,required'
			),
		),
		
		'variant' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_price.variant',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
		'taxrate' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_price.taxrate',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2,required'
			),
		),
		'is_highlight' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_price.is_highlight',
			'config' => array(
				'type' => 'check',
			),
		),
		'quantity' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_price.quantity',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'integer'
			),
		),
// removed due to bug in static_info_tables. as we dont need it right now, this is no problem.
//		'currency' => array(
//			'exclude' => 1,
//			'label' => 'LLL:EXT:z3_shop/Resources/Private/Language/locallang_db.xlf:tx_z3shop_domain_model_price.currency',
//			'config' => array(
//				'type' => 'select',
//				'foreign_table' => 'static_currencies',
//				'minitems' => 1,
//				'maxitems' => 1,
//				'default' => 49
//			),
//		),
		'product' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);

?>