--
-- Table structure for table 'oai_records'
--
-- Copyright (c) 2003 Heinrich Stamerjohanns
--                   stamer@uni-oldenburg.de
--
-- $Id: oai_records.sql,v 1.1.1.1 2003/04/08 12:05:18 stamer Exp $
--
--
CREATE TABLE oai_records (
	serial serial,
	provider varchar(255),
	url varchar(255),
	enterdate timestamp,
	oai_identifier varchar(255),
	oai_set varchar(255),
	datestamp timestamp,
	deleted boolean default false,
	dc_title varchar(255),
	dc_creator text,
	dc_subject varchar(255),
	dc_description text,
	dc_contributor varchar(255),
	dc_publisher varchar(255),
	dc_date date,
	dc_type varchar(255),
	dc_format varchar(255),
	dc_identifier varchar(255),
	dc_source varchar(255),
	dc_language varchar(255),
	dc_relation varchar(255),
	dc_coverage varchar(255),
	dc_rights varchar(255),
	PRIMARY KEY (serial)
);
