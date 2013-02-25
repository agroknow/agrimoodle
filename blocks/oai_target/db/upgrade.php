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

    if ($result && $oldversion < 2013022002) {

        // Define field id to be added to block_oai_target_log
        $table = new xmldb_table('block_oai_target_log');
        $field = new xmldb_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);

        // Conditionally launch add field id
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // oai_target savepoint reached
        upgrade_block_savepoint(true, 2013022002, 'oai_target');
    }    
    

    return $result;
}
