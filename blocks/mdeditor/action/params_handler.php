<?php

if (! defined('AJAX_SCRIPT')) die;

if (! defined('DS')) define('DS', DIRECTORY_SEPARATOR);

//FIXME: is this really needed?
require_once(dirname(__FILE__).DS.'..'.DS.'..'.DS.'..'.DS.'config.php');

function block_mdeditor_bad_request($msg) {
    $response = new object();
    $response->status = 400;
    $response->message = ! empty($msg) ? $msg : 'Bad request';
    echo json_encode($response);
}

/* required params: state, type, id
 * If any of the above parameters are not specified, return an error message.
 * state: requested action: possible values 'complete', 'partial'
 * type: the type this LOM refers to: possible values 'course', 'resource'
 * id: the id of the target: any id the corresponds to a course or resource
 */

/* validation should take place to ensure:
 * user has appropriate privileges
 * $id corresponds to the type specified
 */

function block_mdeditor_get_action_params($ignore_state = false) {
    $supported_types = array('course', 'resource', 'page');

    if (! $ignore_state) {
        $state = optional_param('state', null, PARAM_ALPHA);
        if (empty($state))
            return block_mdeditor_bad_request('Missing required param: state');
        if ($state != 'partial' && $state != 'complete')
            return block_mdeditor_bad_request('Invalid state');
    }


    /* Need to determine the type and the id of the requested LO from the
     * composite param 'id' */
    $composite = optional_param('id', null, PARAM_ALPHANUMEXT);
    if (empty($composite))
        return block_mdeditor_bad_request('Missing required param: id');

    $i_delimiter = strrpos($composite, '_');
    if ($i_delimiter === false)
        return block_mdeditor_bad_request('Invalid id');

    $type = substr($composite, 0, $i_delimiter);
    if (! in_array($type, $supported_types))
        return block_mdeditor_bad_request('Invalid type');

    $id = substr($composite, $i_delimiter + 1);

    $params = array(
        'type'  => $type,
        'id'    => $id,
        'base'  => dirname(__FILE__).DS.'..'.DS.'lom'.DS.$type.DS,
        'file'  => $id.'.json');

    if (! $ignore_state) $params['state'] = $state;

    return $params;
}
