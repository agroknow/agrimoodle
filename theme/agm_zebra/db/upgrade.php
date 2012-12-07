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
defined('MOODLE_INTERNAL') || die();


function xmldb_theme_agm_zebra_upgrade($oldversion) {
    global $CFG, $DB;
    $dbman = $DB->get_manager();

    if ($oldversion = 2012120703) {
//        $currentsetting = get_config('theme_agm_zebra');
        unset_all_config_for_plugin('theme_agm_zebra');
        upgrade_plugin_savepoint(true, 2012120703, 'theme', 'agm_zebra');
        return true;
    }

    if ($oldversion < 2011111004) { // New Settings in 2.1
        $currentsetting = get_config('theme_agm_zebra');
        set_config('linkcolor', $currentsetting->firstcolor, 'theme_agm_zebra'); // Create linkcolor
        unset_config('firstcolor', 'theme_agm_zebra'); // Remove firstcolor

        set_config('hovercolor', $currentsetting->secondcolor, 'theme_agm_zebra'); // Create hovercolor
        unset_config('secondcolor', 'theme_agm_zebra'); // Remove secondcolor

        set_config('fontcolor', $currentsetting->thirdcolor, 'theme_agm_zebra'); // Create fontcolor
        unset_config('third', 'theme_agm_zebra'); // Remove thirdcolor

        set_config('hovercolor', $currentsetting->fourthcolor, 'theme_agm_zebra'); // Create contentbgcolor
        unset_config('fourthcolor', 'theme_agm_zebra'); // Remove fourthcolor

        set_config('columnbgcolor', $currentsetting->fifthcolor, 'theme_agm_zebra'); // Create columnbgcolor
        unset_config('fifthcolor', 'theme_agm_zebra'); // Remove fifthcolor

        set_config('headerbgcolor', $currentsetting->sixthcolor, 'theme_agm_zebra'); // Create headerbgcolor
        unset_config('sixthcolor', 'theme_agm_zebra'); // Remove sixthcolor

        set_config('footerbgcolor', $currentsetting->seventhcolor, 'theme_agm_zebra'); // Create footerbgcolor
        unset_config('seventhcolor', 'theme_agm_zebra'); // Remove seventhcolor

        // Upgrade version number
        upgrade_plugin_savepoint(true, 2011111004, 'theme', 'agm_zebra');
    }

    if ($oldversion < 2011120500) { // New Settings in 2.1.1
        $currentsetting = get_config('theme_agm_zebra');
        unset_config('onecolmax', 'theme_agm_zebra'); // Remove onecolmax
        unset_config('twocolmax', 'theme_agm_zebra'); // Remove twocolmax

        set_config('pagemaxwidth', $currentsetting->threecolmax, 'theme_agm_zebra'); // Create pagemaxwidth
        unset_config('threecolmax', 'theme_agm_zebra'); // Remove threecolmax
    }

    if ($oldversion < 2012011500) { // New Settings in 2.2.0
	$currentsetting = get_config('theme_agm_zebra');
	set_config('userespond', 0, 'theme_agm_zebra'); // Create userespond
	set_config('usecf', 0, 'theme_agm_zebra'); // Create usecf
	set_config('maxcfversion', 6, 'theme_agm_zebra'); // Create maxcfversion
	upgrade_plugin_savepoint(true, 2012011500, 'theme', 'agm_zebra');
    }

    if ($oldversion < 2012011501) { // New Settings in 2.2.0
        unset_config('enablezoom', 'theme_agm_zebra'); // Remove enablezoom
	upgrade_plugin_savepoint(true, 2012011501, 'theme', 'agm_zebra');
    }

    if ($oldversion < 2012042300) { // New Settings in 2.2.5
	$currentsetting = get_config('theme_agm_zebra');
	unset_config('colwidth', 'theme_agm_zebra'); //Remove the old colwidth
	set_config('colwidth', '200px', 'theme_agm_zebra'); //Set the new colwidth
	upgrade_plugin_savepoint(true, 2012042300, 'theme', 'agm_zebra');
    }

    if ($oldversion < 2012050900) { // New Settings in 2.2.8
	unset_config('editingnotify', 'theme_agm_zebra'); //Remove the old colwidth
	upgrade_plugin_savepoint(true, 2012050900, 'theme', 'agm_zebra');
    }

    return true;
}