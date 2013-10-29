<?php

/**
 * This file keeps track of upgrades to the OER Finder block
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
 * @package   block_oerfinder
 * @developer Tasos Koutoumanos <anastasios.koutoumanos@gmail.com>
 * @copyright 2012 AgroKnow Technologies
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 *
 * @param int $oldversion
 * @param object $block
 */
function xmldb_block_oerfinder_upgrade($oldversion) {
    global $CFG, $DB;

    // Moodle v2.3.0 release upgrade line
    // Put any upgrade step following this

    if (!($this->config->service_url and strlen($this->config->service_url)) > 0) {
        $this->config->service_url = 'http://83.212.96.169:8080/repository2/api/ariadne/restp';
    }    
    
    
    return true;
}
