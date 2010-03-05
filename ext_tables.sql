# $Id$
#
# Table structure for table 'fe_users'
#

CREATE TABLE fe_users (
	tx_examples_options int(11) not null default 0,
	tx_examples_special varchar(255) not null default ''
);

#
# Table structure for example table 'dummy'

CREATE TABLE tx_examples_dummy (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	record_type tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(100) DEFAULT '' NOT NULL,
	some_date int(11) DEFAULT '0' NOT NULL,
	enforce_date tinyint(4) DEFAULT '0' NOT NULL,
	description text,

	PRIMARY KEY (uid),
);
