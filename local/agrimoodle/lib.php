<?php  // $Id: lib.php,v 1.7.2.5 2009/04/22 21:30:57 skodak Exp $

/**
 * Library of functions and constants for module agrimoodle.
 * Automatically included with by config.php
 * This file should have two well differenced parts:
 *   - All the core Moodle functions, neeeded to allow
 *     the module to work integrated in Moodle.
 *   - All the agrimoodle specific functions, needed
 *     to implement all the module logic. Please, note
 *     that, if the module become complex and this lib
 *     grows a lot, it's HIGHLY recommended to move all
 *     these module specific functions to a new php file,
 *     called "locallib.php" (see forum, quiz...). This will
 *     help to save some memory when Moodle is performing
 *     actions across all modules.
 *
 * @author     Tasos Koutoumanos <@tafkey>
 * @version    $Id: version.php,v 1.5.2.2 2009/03/19 12:23:11 mudrd8mz Exp $
 * @package    mod/agrimoodle
 * @copyright  2012 onwards EUMMENA  {@link http://eummena.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


$agrimoodle_EXAMPLE_CONSTANT = 21;     /// an example



/**
 * Execute post-install custom actions for the module
 *
 * @return boolean true if success, false on error
 * @todo Add some logging and maybe send out an email!
 */
function agrimoodle_install() {
    return true;
}


/**
 * Execute post-uninstall custom actions for the module
 * This function was added in 1.9
 *
 * @return boolean true if success, false on error
 * @todo Add some logging and maybe send out an email!
 */
function agrimoodle_uninstall() {
    return true;
}



?>