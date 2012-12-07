<?php

require_once(dirname(__FILE__).'/../../../config.php');

$license = optional_param('license', null, PARAM_ALPHANUM);
$language = optional_param('language', null, PARAM_ALPHA);

if ($license == null || $language == null) {
    echo json_encode('Bad request!');
    return;
}

$license_text = null;

switch ($license) {
    case 'cc0':
        $license_text = 'CC0-' . $language;
        break;
    case 'cc1':
        $license_text = 'CC1-' . $language;
        break;
    case 'cc2':
        $license_text = 'CC2-' . $language;
        break;
    default:
        $license_text = 'License not found!';
        break;
}

echo json_encode($license_text);