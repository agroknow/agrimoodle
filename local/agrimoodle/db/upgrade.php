<?php

require_once($CFG->dirroot.'/' . $CFG->admin . '/registration/lib.php');
require_once(dirname(dirname(__FILE__)).'/lib.php');

/**
 * Handles upgrading instances of this block.
 *
 * @param int $oldversion (=0)
 * @return boolean true if success, false on error
 */
function xmldb_local_agrimoodle_upgrade($oldversion) {  
    $huburl = AGRIMOODLE_HUB_MOODLEORGHUBURL;
    
    $registrationmanager = new registration_manager();
    
    $agrimoodlehub = $registrationmanager->get_registeredhub($huburl);
    $amhubnew = false;
    if (!empty($agrimoodlehub->token)) {
      debugging('NOTICE: Site already registerd to agriMoodle hub, with token: ' . $agrimoodlehub->token, DEBUG_DEVELOPER, false);
    } else {
      $amhubnew = true;
      $agrimoodlehub = new stdClass();
      $agrimoodlehub->token = $registrationmanager->get_site_secret_for_hub($huburl);  
      $agrimoodlehub->huburl = $huburl;
    }
    $agrimoodlehub->secret = $agrimoodlehub->token;
    $agrimoodlehub->hubname = AGRIMOODLE_HUB_NAME;
    $agrimoodlehub->confirmed = 1;
    if ($amhubnew) {
      $agrimoodlehub->id = $registrationmanager->add_registeredhub($agrimoodlehub);
      debugging('NOTICE: Site registered to agriMoodle hub, with token: ' . $agrimoodlehub->token, DEBUG_DEVELOPER, false);
    } else {
      $agrimoodlehub->id = $registrationmanager->update_registeredhub($agrimoodlehub);
      debugging('NOTICE: Site registration updated, with token: ' . $agrimoodlehub->token, DEBUG_DEVELOPER, false);
    } 
    
    return true;
}