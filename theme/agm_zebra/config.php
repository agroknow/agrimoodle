<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * agm_zebra theme config page
 * 
 * Based on Zebra theme, modified for Agri-Moodle --tkout
 *
 * @package    theme_agm_zebra
 * @copyright  2012 Agro-Know Technologies
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->name = 'agm_zebra';

$THEME->parents = array('base');

$THEME->parents_exclude_sheets  = array(
    'base'=>array(  //We don't want these because we have our own
	    'dock',
	    'pagelayout'
	)
);

$THEME->sheets = array(
    'pagelayout',   //Generate the layout of the pages - need this first
    'core',         //Overrides for the core sheet from Base - need this second
    'filemanager',  //Overrides for the filemanager sheet
    'admin',	    //Overrides for the admin sheet from Base
    'blocks',	    //Overrides for the blocks sheet from Base
    'calendar',	    //Overrides for the calendar sheet from Base
    'course',	    //Overrides for the course sheet from Base
    'gradebook',    //Overrides for the gradebook from YUI
    'custommenu',   //Applies style to the custommenu
    'dock',         //Derived from Rebase
    'mod_forum',    //Overrides for forum
    'mod_resource', //Overrides for resources
    'extra',        //Extra stuff that doesn't fit the above
    'ie'            //Special Internet Explorer rules
);

$THEME->layouts = array(
    'base' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true, 'noblocks'=>true)
    ),
    'standard' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true)
    ),
    'course' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true)
    ),
    'coursecategory' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true)
    ),
    'incourse' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true)
    ),
    'frontpage' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true)
    ),
    'admin' => array(
        'file' => 'general.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true)
    ),
    'mydashboard' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true)
    ),
    'mypublic' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true)
    ),
    'login' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('langmenu'=>false, 'nologininfo'=>true)
    ),
    'popup' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'noblocks'=>true, 'nonavbar'=>true, 'nocustommenu'=>true, 'nologininfo'=>true, 'nocourseheaderfooter'=>true)
    ),
    'frametop' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nocoursefooter'=>true)
    ),
    'maintenance' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'noblocks'=>true, 'nonavbar'=>true, 'nocustommenu'=>true, 'nologininfo'=>true, 'nocourseheaderfooter'=>true)
    ),
    'embedded' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'noblocks'=>true, 'nonavbar'=>true, 'nocustommenu'=>true, 'nologininfo'=>true)
    ),
    'print' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'noblocks'=>true, 'nonavbar'=>true, 'nocustommenu'=>true, 'nologininfo'=>true, 'nocourseheaderfooter'=>true)
    ),
    'redirect' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'noblocks'=>true, 'nonavbar'=>true, 'nocustommenu'=>true, 'nologininfo'=>true, 'nocourseheaderfooter'=>true)
    ),
    'report' => array(
        'file' => 'general.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array()
    ),
    'secure' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('nofooter'=>true, 'nonavbar'=>true, 'nocustommenu'=>true, 'nologinlinks'=>true, 'nocourseheaderfooter'=>true),
    ),
);

$THEME->enable_dock = true;

$THEME->csspostprocess = 'agm_zebra_process_css'; //Process the settings page (colors, widths, etc.)

$THEME->javascripts = array();
$THEME->javascripts_footer = array();