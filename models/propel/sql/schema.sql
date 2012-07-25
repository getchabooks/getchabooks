
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- campus
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `campus`;

CREATE TABLE `campus`
(
	`shallow_spidered_at` DATETIME,
	`name` VARCHAR(255),
	`slug` VARCHAR(255),
	`school_id` INTEGER,
	`spidered_at` DATETIME,
	`touched` TINYINT(1),
	`b_id` VARCHAR(255),
	`bookstore_type` VARCHAR(32),
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `campus_FI_1` (`school_id`),
	CONSTRAINT `campus_FK_1`
		FOREIGN KEY (`school_id`)
		REFERENCES `school` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- school
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `school`;

CREATE TABLE `school`
(
	`shallow_spidered_at` DATETIME COMMENT 'Last time of spidereding completely down to department-awareness.',
	`enabled` TINYINT(1) DEFAULT 1 COMMENT 'Whether the school should be shown in the index selector and   allow selection and results to be reached.',
	`name` VARCHAR(255) NOT NULL COMMENT 'The full name of the school, like \'Tufts University\'.',
	`short_name` VARCHAR(255) COMMENT 'The name commonly used to refer to the school, like \'Tufts\'.',
	`slug` VARCHAR(255) COMMENT 'The school\'s slug for URLs on our site.',
	`state` VARCHAR(2) COMMENT 'The state the school is located in.',
	`zip` VARCHAR(5) COMMENT 'The school\'s zip code.',
	`local_tax` DECIMAL(5,2) COMMENT 'The local tax rate (e.g. 6.25), which overrides the state tax   rate if set.',
	`amazon_tag` VARCHAR(255) COMMENT 'The default Amazon referral tag for this school.',
	`subdomain` VARCHAR(255) COMMENT 'The school\'s subdomain on its bookstore site, or other   uniquely identifying information.',
	`depts_to_ignore` VARCHAR(255) COMMENT 'A comma-separated list of departments to exclude from   spidering and display, i.e. bad data.',
	`nb_campuses` INTEGER,
	`spidered_at` DATETIME,
	`touched` TINYINT(1),
	`b_id` VARCHAR(255),
	`bookstore_type` VARCHAR(32),
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- term
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `term`;

CREATE TABLE `term`
(
	`shallow_spidered_at` DATETIME,
	`name` VARCHAR(255) NOT NULL,
	`slug` VARCHAR(255) NOT NULL,
	`status` INTEGER DEFAULT -1 COMMENT 'Guess as to the timeframe. -1 = past, 0 = current (only one),   1 = future',
	`has_course_info` TINYINT(1) DEFAULT 0 COMMENT 'Whether we have extra metadata for depts, courses, and   sections in this term.',
	`campus_id` INTEGER,
	`spidered_at` DATETIME,
	`touched` TINYINT(1),
	`b_id` VARCHAR(255),
	`bookstore_type` VARCHAR(32),
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `term_FI_1` (`campus_id`),
	CONSTRAINT `term_FK_1`
		FOREIGN KEY (`campus_id`)
		REFERENCES `campus` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- dept
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `dept`;

CREATE TABLE `dept`
(
	`abbr` VARCHAR(255) NOT NULL,
	`name` VARCHAR(255),
	`term_id` INTEGER,
	`spidered_at` DATETIME,
	`shallow_spidered_at` DATETIME,
	`touched` TINYINT(1),
	`b_id` VARCHAR(255),
	`bookstore_type` VARCHAR(32),
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `dept_FI_1` (`term_id`),
	CONSTRAINT `dept_FK_1`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- section
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `section`;

CREATE TABLE `section`
(
	`num` VARCHAR(255) NOT NULL,
	`requires_books` TINYINT(1) DEFAULT 1 COMMENT 'Whether it\'s not the case that this section explicitly doesn\'t   require any books.',
	`name` VARCHAR(255) COMMENT 'The full name of the section, like \'COMP20: Web Programming (Chow)\'',
	`slug` VARCHAR(255),
	`school_slug` VARCHAR(255),
	`campus_slug` VARCHAR(255),
	`term_slug` VARCHAR(255),
	`f_id` VARCHAR(255),
	`nb_items` INTEGER DEFAULT 0,
	`professor` VARCHAR(255),
	`course_id` INTEGER,
	`spidered_at` DATETIME,
	`shallow_spidered_at` DATETIME,
	`touched` TINYINT(1),
	`b_id` VARCHAR(255),
	`bookstore_type` VARCHAR(32),
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `section_FI_1` (`course_id`),
	CONSTRAINT `section_FK_1`
		FOREIGN KEY (`course_id`)
		REFERENCES `course` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- course
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `course`;

CREATE TABLE `course`
(
	`num` VARCHAR(255) NOT NULL,
	`nb_sections` INTEGER,
	`name` VARCHAR(255),
	`dept_id` INTEGER,
	`spidered_at` DATETIME,
	`shallow_spidered_at` DATETIME,
	`touched` TINYINT(1),
	`b_id` VARCHAR(255),
	`bookstore_type` VARCHAR(32),
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `course_FI_1` (`dept_id`),
	CONSTRAINT `course_FK_1`
		FOREIGN KEY (`dept_id`)
		REFERENCES `dept` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- item
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `item`;

CREATE TABLE `item`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`isbn` VARCHAR(13),
	`package_id` INTEGER,
	`is_package` TINYINT(1) DEFAULT 0,
	`title` VARCHAR(255),
	`author` VARCHAR(255),
	`edition` VARCHAR(255),
	`publisher` VARCHAR(255),
	`b_new` DECIMAL(6,2),
	`b_used` DECIMAL(6,2),
	`b_ebook` DECIMAL(6,2),
	`image_url` VARCHAR(255),
	`product_id` VARCHAR(255),
	`part_number` VARCHAR(255),
	`spidered_at` DATETIME,
	`shallow_spidered_at` DATETIME,
	`touched` TINYINT(1),
	`b_id` VARCHAR(255),
	`bookstore_type` VARCHAR(32),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `item_FI_1` (`isbn`),
	INDEX `item_FI_2` (`package_id`),
	CONSTRAINT `item_FK_1`
		FOREIGN KEY (`isbn`)
		REFERENCES `book` (`isbn`)
		ON DELETE SET NULL,
	CONSTRAINT `item_FK_2`
		FOREIGN KEY (`package_id`)
		REFERENCES `item` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- section_has_item
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `section_has_item`;

CREATE TABLE `section_has_item`
(
	`section_id` INTEGER NOT NULL,
	`item_id` INTEGER NOT NULL,
	`required_status` SMALLINT DEFAULT 0,
	`spidered_at` DATETIME,
	`shallow_spidered_at` DATETIME,
	`touched` TINYINT(1),
	`b_id` VARCHAR(255),
	`bookstore_type` VARCHAR(32),
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `section_has_item_FI_1` (`section_id`),
	INDEX `section_has_item_FI_2` (`item_id`),
	CONSTRAINT `section_has_item_FK_1`
		FOREIGN KEY (`section_id`)
		REFERENCES `section` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `section_has_item_FK_2`
		FOREIGN KEY (`item_id`)
		REFERENCES `item` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- book
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book`
(
	`isbn` VARCHAR(13),
	`title` VARCHAR(255) DEFAULT '',
	`author` VARCHAR(255),
	`publisher` VARCHAR(255),
	`edition` VARCHAR(255),
	`edition_num` VARCHAR(255),
	`pubdate` VARCHAR(255),
	`is_paperback` TINYINT(1) DEFAULT 0,
	`image_url` VARCHAR(255),
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `book_U_1` (`isbn`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
