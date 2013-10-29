<?php

if (! defined('AJAX_SCRIPT')) define('AJAX_SCRIPT', true);

if (! defined('DS')) define('DS', DIRECTORY_SEPARATOR);

require_once(dirname(__FILE__).DS.'params_handler.php');

$params = block_mdeditor_get_action_params();
extract($params);
/* the following variables are now defined (due to calling `extract' above):
 *  $type string; name of the mod (and lom sub-dir) (eg course, resource, page)
 *  $id integer; (self-explanatory)
 *  $base string; a relative path (/-terminated) leading to the sub-dir for
 *      $type loms (this sub-dir is parent to sub-dirs 'complete' and 'partial')
 *  $file string; the name of the file for this LO
 */

// print_object($_POST);
// error_log('POST is: ' . print_r($_POST, true));

/* remove any previous data that have been stored under a different state */
$previous = ($state == 'complete') ? 'partial' : 'complete';
$previous .= DS;

$previous = $base.$previous.$id.'.json';
if (file_exists($previous)) {
    unlink($previous);
}

$response = new object();
try {
	// We need to create the directory structure if it doesn't exist!
	is_dir($base.$state) ||  mkdir($base.$state, 0755, true);
	// Encode to json format and save to file
    file_put_contents($base.$state.DS.$file, json_encode($_POST));
    $response->status = 200;
    $response->message = 'Changes have been saved.';

} catch (Exception $e) {
    $response->status = 400;
    $response->message = 'An error has occured. Changes have not been saved!';
}

echo json_encode($response);
