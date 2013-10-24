<?php  // $Id: lib.php,v 1.7.2.5 2009/04/22 21:30:57 skodak Exp $

/**
 * Library of functions and constants for module agrimoodle.
 *
 * @author     Tasos Koutoumanos <@tafkey>
 * @version    $Id: version.php,v 1.5.2.2 2009/03/19 12:23:11 mudrd8mz Exp $
 * @package    mod/agrimoodle
 * @copyright  2012 onwards EUMMENA  {@link http://eummena.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/**
 * agriMoodle hub directory url (should be under agrimoodle.org)
 */
define('AGRIMOODLE_HUB_HUBDIRECTORYURL', "http://hubdirectory.agrimoodle.org");

/**
 * agriMoodle url (should be under moodle.org)
 */
define('AGRIMOODLE_HUB_MOODLEORGHUBURL', "http://hub.agrimoodle.org");

/**
 * Name of the agriMoodle hub
 */
define('AGRIMOODLE_HUB_NAME', "The agriMoodle hub");




function local_agrimoodle_cron() {
  // nothing yet
}


?>