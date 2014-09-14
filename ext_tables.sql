#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (
	tx_examples_options int(11) DEFAULT '0' NOT NULL,
	tx_examples_special varchar(255) DEFAULT '' NOT NULL
);

#
# Table structure for table 'be_users'
#
CREATE TABLE be_users (
	tx_examples_mobile varchar(60) DEFAULT '' NOT NULL
);

#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tx_examples_noprint tinyint(4) DEFAULT '0' NOT NULL
);

#
# Table structure for example table 'dummy'
#
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

#
# Table structure for example table 'haiku'
#
CREATE TABLE tx_examples_haiku (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(100) DEFAULT '' NOT NULL,
	poem text,
	filename varchar(255) DEFAULT '' NOT NULL,
	filesource tinyint(4) DEFAULT '0' NOT NULL,
	filestatus varchar(255) DEFAULT '' NOT NULL,
	season varchar(100) DEFAULT '' NOT NULL,
	weirdness varchar(100) DEFAULT '0' NOT NULL,
	color varchar(20) DEFAULT '' NOT NULL,
	angle int(11) DEFAULT '0' NOT NULL,
	image1 text,
	image2 text,
	image3 text,
	image4 text,
	image5 text,
	image6 text,
	image_fal_group text,
	image_fal_irre text,
	reference_page int(11) DEFAULT '0' NOT NULL,
	related_records text,
	related_content text,

	PRIMARY KEY (uid),
);
