<?php

/**
 * This file keeps track of upgrades to the oai_target block
 *
 * Sometimes, changes between versions involve alterations to database structures
 * and other major things that may break installations.
 *
 * The upgrade function in this file will attempt to perform all the necessary
 * actions to upgrade your older installation to the current version.
 *
 * If there's something it cannot do itself, it will tell you what you need to do.
 *
 * The commands in here will all be database-neutral, using the methods of
 * database_manager class
 *
 * Please do not forget to use upgrade_set_timeout()
 * before any action that may take longer time to finish.
 *
 * @package   block_oai_target
 * @developer Tasos Koutoumanos <anastasios.koutoumanos@gmail.com>
 * @copyright 2013 AgroKnow Technologies
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 *
 * @param int $oldversion
 * @param object $block
 */
function xmldb_block_oai_target_upgrade($oldversion = 0) {
   global $DB;
    $dbman = $DB->get_manager();

    $result = true;

	    if ($oldversion < 2013022401) {

        // Define table block_oai_target_lom_records to be created
        $table = new xmldb_table('block_oai_target_lom_records');

        // Adding fields to table block_oai_target_lom_records
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('provider', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('url', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->add_field('enterdate', XMLDB_TYPE_DATETIME, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('oai_identifier', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('oai_set', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('datestamp', XMLDB_TYPE_DATETIME, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('deleted', XMLDB_TYPE_CHAR, '5', null, null, null, 'None');
        $table->add_field('dc_title', XMLDB_TYPE_CHAR, '8000', null, null, null, null);
        $table->add_field('dc_creator', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('dc_subject', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('dc_description', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('dc_contributor', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('dc_publisher', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('dc_date', XMLDB_TYPE_DATETIME, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('dc_type', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('dc_format', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('dc_identifier', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('dc_source', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('dc_language', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('dc_relation', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('dc_coverage', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('dc_rights', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('lom_record', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);

        // Adding keys to table block_oai_target_lom_records
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Conditionally launch create table for block_oai_target_lom_records
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // oai_target savepoint reached
        upgrade_block_savepoint(true, 2013022401, 'oai_target');
    }    
    

    return $result;
}
