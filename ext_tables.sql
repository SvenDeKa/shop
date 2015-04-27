#
# Table structure for table 'tx_z3shop_domain_model_product'
#
CREATE TABLE tx_z3shop_domain_model_product (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	description text NOT NULL,
	amount_in_shop varchar(255) DEFAULT '' NOT NULL,
	weight int(11) DEFAULT '0' NOT NULL,
	record_type varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	item int(11) DEFAULT '0' NOT NULL,
	prices int(11) unsigned DEFAULT '0' NOT NULL,
	cart int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_z3shop_domain_model_productreference'
#
CREATE TABLE tx_z3shop_domain_model_productreference (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	uid_local int(11) unsigned DEFAULT '0',
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0',
	sorting_foreign int(11) unsigned DEFAULT '0',
	tablename varchar(255) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_z3shop_domain_model_order'
#
CREATE TABLE tx_z3shop_domain_model_order (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	number varchar(255) DEFAULT '' NOT NULL,
	payment_type varchar(255) DEFAULT '' NOT NULL,
	shipping_type varchar(255) DEFAULT '' NOT NULL,
	payment_fee double(11,2) DEFAULT '0.00' NOT NULL,
	shipping_fee double(11,2) DEFAULT '0.00' NOT NULL,
	confirmed_terms tinyint(1) unsigned DEFAULT '0' NOT NULL,
	ordered int(11) DEFAULT '0' NOT NULL,
	shipped varchar(255) DEFAULT '' NOT NULL,
	payed varchar(255) DEFAULT '' NOT NULL,
	crypt varchar(255) DEFAULT '' NOT NULL,
	products int(11) unsigned DEFAULT '0' NOT NULL,
	cart int(11) unsigned DEFAULT '0' NOT NULL,
	shipping_address int(11) unsigned DEFAULT '0',
	billing_address int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_z3shop_domain_model_cart'
#
CREATE TABLE tx_z3shop_domain_model_cart (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	session_id varchar(255) DEFAULT '' NOT NULL,
	product_type varchar(255) DEFAULT '' NOT NULL,
	customer int(11) unsigned DEFAULT '0',
	products int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_z3shop_domain_model_price'
#
CREATE TABLE tx_z3shop_domain_model_price (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	product int(11) unsigned DEFAULT '0' NOT NULL,

	variant varchar(255) DEFAULT '' NOT NULL,
	price double(11,2) DEFAULT '0.00' NOT NULL,
	taxrate double(11,2) DEFAULT '0.00' NOT NULL,
	is_highlight int(11) DEFAULT '0' NOT NULL,
	quantity int(11) DEFAULT '0' NOT NULL,
	currency int(11) DEFAULT '0' NOT NULL,
	validfrom int(11) unsigned DEFAULT '0' NOT NULL,
	validuntil int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_z3shop_domain_model_address'
#
CREATE TABLE tx_z3shop_domain_model_address (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	customer int(11) unsigned DEFAULT '0' NOT NULL,

	is_default_shipping int(11) unsigned DEFAULT '0' NOT NULL,
	is_default_billing int(11) unsigned DEFAULT '0' NOT NULL,
	salutation varchar(255) DEFAULT '' NOT NULL,
	firstname varchar(255) DEFAULT '' NOT NULL,
	lastname varchar(255) DEFAULT '' NOT NULL,
	address_street varchar(255) DEFAULT '' NOT NULL,
	address_number varchar(255) DEFAULT '' NOT NULL,
	company varchar(255) DEFAULT '' NOT NULL,
	extra1 varchar(255) DEFAULT '' NOT NULL,
	extra2 varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	phone varchar(255) DEFAULT '' NOT NULL,
	mobile varchar(255) DEFAULT '' NOT NULL,
	fax varchar(255) DEFAULT '' NOT NULL,
	postal_code varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	country varchar(255) DEFAULT '' NOT NULL,
	static_country int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_z3shop_domain_model_productcart'
#
CREATE TABLE tx_z3shop_domain_model_productcart (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	cart int(11) unsigned DEFAULT '0' NOT NULL,

	amount varchar(255) DEFAULT '' NOT NULL,
	amount_special varchar(255) DEFAULT '' NOT NULL,
	product int(11) unsigned DEFAULT '0',
	variant varchar(255) DEFAULT '' NOT NULL,
	cart int(11) unsigned DEFAULT '0',
	reciever int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);
 
-- #
-- # Table structure for table 'tx_z3shop_domain_model_productorder'
-- #
-- CREATE TABLE tx_z3shop_domain_model_productorder (
-- 
-- 	uid int(11) NOT NULL auto_increment,
-- 	pid int(11) DEFAULT '0' NOT NULL,
-- 
-- 	amount int(11) DEFAULT '0' NOT NULL,
-- 	price double(11,2) DEFAULT '0.00' NOT NULL,
-- 	tax double(11,2) DEFAULT '0.00' NOT NULL,
-- 	product int(11) unsigned DEFAULT '0',
-- 	shoporder int(11) unsigned DEFAULT '0',
-- 	reciever int(11) unsigned DEFAULT '0',
-- 
-- 	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
-- 	crdate int(11) unsigned DEFAULT '0' NOT NULL,
-- 	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
-- 	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
-- 	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
-- 	starttime int(11) unsigned DEFAULT '0' NOT NULL,
-- 	endtime int(11) unsigned DEFAULT '0' NOT NULL,
-- 
-- 	t3ver_oid int(11) DEFAULT '0' NOT NULL,
-- 	t3ver_id int(11) DEFAULT '0' NOT NULL,
-- 	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
-- 	t3ver_label varchar(255) DEFAULT '' NOT NULL,
-- 	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
-- 	t3ver_stage int(11) DEFAULT '0' NOT NULL,
-- 	t3ver_count int(11) DEFAULT '0' NOT NULL,
-- 	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
-- 	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
-- 
-- 	t3_origuid int(11) DEFAULT '0' NOT NULL,
-- 	sys_language_uid int(11) DEFAULT '0' NOT NULL,
-- 	l10n_parent int(11) DEFAULT '0' NOT NULL,
-- 	l10n_diffsource mediumblob,
-- 
-- 	PRIMARY KEY (uid),
-- 	KEY parent (pid),
-- 	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
-- 	KEY language (l10n_parent,sys_language_uid)
-- 
-- );


#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (

	number varchar(255) DEFAULT '' NOT NULL,
	orders int(11) unsigned DEFAULT '0' NOT NULL,
	addresses int(11) unsigned DEFAULT '0' NOT NULL,
	cart int(11) unsigned DEFAULT '0' NOT NULL,

	tx_extbase_type varchar(255) DEFAULT '' NOT NULL,

);
