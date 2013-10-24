<?php

global $DB;

$timestamp = time();

/*
 * JSONP Logger for OER Finder Widget (Block)
 *
 *
 * @package   block_oerfinder
 * @developer Tasos Koutoumanos <anastasios.koutoumanos@gmail.com>
 * @developer Stauros Gkinis <gkista@agroknow.gr>
 * @copyright 2012 AgroKnow Technologies
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @version   1.01
 *
 * It implements a JSON request handler for the oerfinder block.
 *
 */

if (!defined('AJAX_SCRIPT'))
    define('AJAX_SCRIPT', true);
if (!defined('DS'))
    define('DS', DIRECTORY_SEPARATOR);

// require_once(dirname(__FILE__).DS.'ajaxlib.php');
require_once(dirname(__FILE__) . DS . '..' . DS . '..' . DS . '..' . DS . 'config.php');


function bad_request($msg) {
    $response = new object();
    $response->status = 400;
    $response->message = !empty($msg) ? $msg : 'Bad request';
    echo json_encode($response);
}

function dolog($res, $params, $comment, $is_click) {
    global $USER, $COURSE, $DB, $timestamp;

    $tbl = 'block_oerfinder_logs';
    $logdata = new stdClass();
    $logdata->blockid = $timestamp;       // FIXME
    $logdata->user = $USER->username;
    $logdata->course = $COURSE->fullname;
    $logdata->timestamp = $timestamp;
    $logdata->searchstring = $params['search'];
    $logdata->actionsource = $params['action'] || 1;
    $logdata->resourceid = $res;
    $logdata->comment = $comment;

    if ($is_click) {

        // we need to get the ID of the record to be updated!
        $sql = "select * from mdl_$tbl where user = ? and timestamp = ?  and " . $DB->sql_compare_text('resourceid') . " = ? ";
        $clicked = $DB->get_record_sql($sql,
                array('user' => $USER->username,
                      'timestamp' => $params['timestamp'],
                      'resourceid' => $res));
        $clicked_id = $clicked->id;

        // we found the id, now let's update thet database!
        if ($clicked_id > 0) {
            $logdata->id = $clicked_id;
            if (! $DB->update_record($tbl, $logdata)) {
                print_error('db_update_error', 'block_oerfinder');
            }
        } else {
            print_error("Not valid id $(clicked_id)", 'block_oerfinder');
        }
    } else if (! $DB->insert_record($tbl, $logdata)) {
        print_error('insert_error', 'block_oerfinder');
    }
}

//-------------------------------------------------
// JSONP response starts here
// ------------------------------------------------

header('Content-type: application/json');
$callback = "_prototypeJSONPCallback_0";

if (isset($_POST) && isset($_POST["json"])) {
    $json = $_POST["json"];
    $callback = $_POST["callback"];
}
else if (isset($_GET) && isset($_GET["json"])) {
    $json = $_GET["json"];
    $callback = $_GET["callback"];
}
else {
    bad_request("Cannot parse json parameter (request=$_GET)");
    return;
}

$input = json_decode($json, true);
$resources = $input['results'];
// when we get a timestamp, then we have a click!!!
if (is_int($input['timestamp'])) {
    $timestamp = $input['timestamp'];
    dolog($input['results'][0], $input, "CLICK!!!", true);
} else foreach ($resources as $res) {
    dolog($res, $input, "-", false);
}

$response = array();
$response["newLogEntries"] = sizeof($resources);
$response["totalLogEntries"] = $DB->count_records('block_oerfinder_logs');
$response["timestamp"] = $timestamp;
// $response["request"] = $json;

$jenc = json_encode($response);
$jsonp = "$callback($jenc)";

exit($jsonp);
