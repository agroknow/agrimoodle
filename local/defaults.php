<?php

 /*
  * These new defaults are used during installation, upgrade and later are
  * displayed as default values in admin settings. This means that the content
  * of the defaults files is usually updated BEFORE installation or upgrade.
  */

// NOTE: First bracket contains string from column plugin of config_plugins table.
//       Second bracket is the name of setting. In the admin settings UI the 
//       plugin and name of setting is separated by "|".

$defaults['moodle']['forcelogin'] = 1;  // new default for $CFG->forcelogin
$defaults['scorm']['maxgrade'] = 20;    // default for get_config('scorm', 'maxgrade')
$defaults['moodlecourse']['numsections'] = 11;
$defaults['moodle']['hiddenuserfields'] = array('city', 'country');