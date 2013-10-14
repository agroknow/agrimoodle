<?php

if (! defined('AJAX_SCRIPT')) define('AJAX_SCRIPT', true);

if (! defined('DS')) define('DS', DIRECTORY_SEPARATOR);

require_once(dirname(__FILE__).DS.'params_handler.php');

$params = block_mdeditor_get_action_params(true);
extract($params);
/* the following variables are now defined (due to calling `extract' above):
 *  $type string; name of the mod (and lom sub-dir) (eg course, resource, page)
 *  $id integer; (self-explanatory)
 *  $base string; a relative path (/-terminated) leading to the sub-dir for
 *      $type loms (this sub-dir is parent to sub-dirs 'complete' and 'partial')
 *  $file string; the name of the file for this LO
 */

$json = array();
$target = $base.'complete'.DS.$file;
if (file_exists($target)) {
    $json = file_get_contents($target);
} else {
    $target = $base.'partial'.DS.$file;
    if (file_exists($target)) {
        $json = file_get_contents($target);
    }
}

if (! empty($json)) {
    echo $json; //json_encode(json_decode($json, true));
    return;
}

/* if no LOM record is found, gather information from the database */

global $DB, $USER;

/* Check whether the exact same fields are supported for some mods and 'group'
 * them into one branch/case */
if ($type == 'resource' || $type == 'page') {
    $resource = $DB->get_record($type,
                                array('id' => $id),
                               'id, name, intro',
                                MUST_EXIST);

    $json['title'][0] = array('value' => $resource->name);

    // remove html tags
    $json['description'][0][0] = array(
            'value' => strip_tags($resource->intro));

    $editor_name = "{$USER->firstname} {$USER->lastname}";

} else { // type == 'course'
    $course = $DB->get_record('course',
                              array('id' => $id),
                              'id, fullname, summary, lang',
                              MUST_EXIST);

    $json['title'][0] = array('value' => $course->fullname);

    // remove html tags
    $json['description'][0][0]['value'] = strip_tags($course->summary);
}

/* TODO; Should not override previously set values, or should it? */
$json['contribute3'][0]['date'] = date('d/m/Y');
$json['contribute3'][0]['role'] = 'creator';
$json['contribute3'][0]['entity'][0]['firstname'] = $USER->firstname;
$json['contribute3'][0]['entity'][0]['lastname'] = $USER->lastname;
$json['contribute3'][0]['entity'][0]['email'] = $USER->email;

// Need to echo the json back to the javascript code (module.js)
// in order for this to drive the form's pre-fill with details.
echo json_encode($json, true);
