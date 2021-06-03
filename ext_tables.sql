#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (
	tx_examples_options INT(11) DEFAULT '0'     NOT NULL,
	tx_examples_special VARCHAR(255) DEFAULT '' NOT NULL
);

#
# Table structure for table 'be_users'
#
CREATE TABLE be_users (
	tx_examples_mobile VARCHAR(60) DEFAULT '' NOT NULL
);

#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tx_examples_noprint TINYINT(4) DEFAULT '0' NOT NULL,
	tx_examples_separator VARCHAR(255) DEFAULT '0' NOT NULL,
	tx_examples_main_category INT(11) DEFAULT '0' NOT NULL,
);

#
# Table structure for table 'pages'
#
CREATE TABLE pages (
	tx_examples_related_pages text,
    tx_examples_import_data_control INT(11) DEFAULT '0' NOT NULL,
);

#
# Table structure for example table 'dummy'
#
CREATE TABLE tx_examples_dummy (
	uid          INT(11)                 NOT NULL AUTO_INCREMENT,
	pid          INT(11) DEFAULT '0'     NOT NULL,
	tstamp       INT(11) DEFAULT '0'     NOT NULL,
	crdate       INT(11) DEFAULT '0'     NOT NULL,
	cruser_id    INT(11) DEFAULT '0'     NOT NULL,
	deleted      TINYINT(4) DEFAULT '0'  NOT NULL,
	hidden       TINYINT(4) DEFAULT '0'  NOT NULL,
	record_type  TINYINT(4) DEFAULT '0'  NOT NULL,
	title        VARCHAR(100) DEFAULT '' NOT NULL,
	some_date    INT(11) DEFAULT '0'     NOT NULL,
	enforce_date TINYINT(4) DEFAULT '0'  NOT NULL,
	description  TEXT,

	PRIMARY KEY (uid)
);

#
# Table structure for example table 'haiku'
#
CREATE TABLE tx_examples_haiku (
	uid             INT(11)                  NOT NULL AUTO_INCREMENT,
	pid             INT(11) DEFAULT '0'      NOT NULL,
	tstamp          INT(11) DEFAULT '0'      NOT NULL,
	crdate          INT(11) DEFAULT '0'      NOT NULL,
	cruser_id       INT(11) DEFAULT '0'      NOT NULL,
	deleted         TINYINT(4) DEFAULT '0'   NOT NULL,
	hidden          TINYINT(4) DEFAULT '0'   NOT NULL,
	title           VARCHAR(100) DEFAULT ''  NOT NULL,
	poem            TEXT,
	image        		INT(11) DEFAULT '0'      NOT NULL,
	season          VARCHAR(100) DEFAULT ''  NOT NULL,
	weirdness       VARCHAR(100) DEFAULT '0' NOT NULL,
	color           VARCHAR(20) DEFAULT ''   NOT NULL,
	angle           INT(11) DEFAULT '0'      NOT NULL,
	reference_page  INT(11) DEFAULT '0'      NOT NULL,
	related_records TEXT,
	related_content TEXT,

	PRIMARY KEY (uid)
);

# Table structure for table 'tx_examples_log'
#
# The KEY on request_id is optional
#
CREATE TABLE tx_examples_log (
	request_id varchar(13) DEFAULT '' NOT NULL,
	time_micro double(16,4) NOT NULL default '0.0000',
	component varchar(255) DEFAULT '' NOT NULL,
	level tinyint(1) unsigned DEFAULT '0' NOT NULL,
	message text,
	data text,

	KEY request (request_id)
);
