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
 * agm_zebra theme settings page
 *
 * Based on Zebra theme, modified for Agri-Moodle --tkout
 *
 * @package    theme_agm_zebra
 * @copyright  2012 Agro-Know Technologies
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    //This is the note box for all the settings pages
    $name = 'theme_agm_zebra/notes';
    $heading = get_string('notes', 'theme_agm_zebra');
    $information = get_string('notesdesc', 'theme_agm_zebra');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    //This is the descriptor for the following header settings
    $name = 'theme_agm_zebra/headerinfo';
    $heading = get_string('headerinfo', 'theme_agm_zebra');
    $information = get_string('headerinfodesc', 'theme_agm_zebra');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    //Set the path to the logo image
    $name = 'theme_agm_zebra/logourl';
    $title = get_string('logourl','theme_agm_zebra');
    $description = get_string('logourldesc', 'theme_agm_zebra');
    $default = 'logo/agrimoodle_wide_trans';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $settings->add($setting);

    //Set the minimum height for the logo image
    $name = 'theme_agm_zebra/logourlheight';
    $title = get_string('logourlheight','theme_agm_zebra');
    $description = get_string('logourlheightdesc', 'theme_agm_zebra');
    $default = '120px';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_CLEAN, 5);
    $settings->add($setting);

    //Set alternate text for headermain
    $name = 'theme_agm_zebra/headeralt';
    $title = get_string('headeralt','theme_agm_zebra');
    $description = get_string('headeraltdesc', 'theme_agm_zebra');
    $default = '&nbsp;';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_CLEAN, 20);
    $settings->add($setting);

    //Set body background image url
    $name = 'theme_agm_zebra/backgroundurl';
    $title = get_string('backgroundurl', 'theme_agm_zebra');
    $description = get_string('backgroundurldesc', 'theme_agm_zebra');
//    $default = 'core/background';
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $settings->add($setting);

    //Set the home icon display option
    $name = 'theme_agm_zebra/homeicon';
    $visiblename = get_string('homeicon', 'theme_agm_zebra');
    $title = get_string('homeicon', 'theme_agm_zebra');
    $description = get_string('homeicondesc', 'theme_agm_zebra');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 1);
    $settings->add($setting);

    //Set the home icon display option
    $name = 'theme_agm_zebra/callink';
    $visiblename = get_string('callink', 'theme_agm_zebra');
    $title = get_string('callink', 'theme_agm_zebra');
    $description = get_string('callinkdesc', 'theme_agm_zebra');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 1);
    $settings->add($setting);

    //Set the calendar link display option
    $name = 'theme_agm_zebra/dateformat';
    $title = get_string('dateformat', 'theme_agm_zebra');
    $description = get_string('dateformatdesc', 'theme_agm_zebra');
    $default = 'F j, Y';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_CLEAN, 10);
    $settings->add($setting);

    //Set the user profile picture display option
    $name = 'theme_agm_zebra/userpic';
    $visiblename = get_string('userpic', 'theme_agm_zebra');
    $title = get_string('userpic', 'theme_agm_zebra');
    $description = get_string('userpicdesc', 'theme_agm_zebra');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 1);
    $settings->add($setting);

    //This is the descriptor for the following general color settings
    $name = 'theme_agm_zebra/colorsinfo';
    $heading = get_string('colorsinfo', 'theme_agm_zebra');
    $information = get_string('colorsinfodesc', 'theme_agm_zebra');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    //Set body background color
    $name = 'theme_agm_zebra/bodybgcolor';
    $title = get_string('bodybgcolor','theme_agm_zebra');
    $description = get_string('bodybgcolordesc', 'theme_agm_zebra');
    $default = '#ddd';
    $previewconfig = array('selector'=>'html', 'style'=>'backgroundColor');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set links and menu color
    $name = 'theme_agm_zebra/linkcolor';
    $title = get_string('linkcolor','theme_agm_zebra');
    $description = get_string('linkcolordesc', 'theme_agm_zebra');
    $default = '#1a8f40';
	$previewconfig = array('selector'=>'a', 'style'=>'color');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set hovering color
    $name = 'theme_agm_zebra/hovercolor';
    $title = get_string('hovercolor','theme_agm_zebra');
    $description = get_string('hovercolordesc', 'theme_agm_zebra');
    $default = '#104221';
    $previewconfig = array('selector'=>'a:hover', 'style'=>'color');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set font color
    $name = 'theme_agm_zebra/fontcolor';
    $title = get_string('fontcolor','theme_agm_zebra');
    $description = get_string('fontcolordesc', 'theme_agm_zebra');
    $default = '#2F2F2F';
	$previewconfig = array('selector'=>'html', 'style'=>'color');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set main content background color
    $name = 'theme_agm_zebra/contentbgcolor';
    $title = get_string('contentbgcolor','theme_agm_zebra');
    $description = get_string('contentbgcolordesc', 'theme_agm_zebra');
    $default = '#f4f6f8';
	$previewconfig = array('selector'=>'#region-main', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set column background color
    $name = 'theme_agm_zebra/columnbgcolor';
    $title = get_string('columnbgcolor','theme_agm_zebra');
    $description = get_string('columnbgcolordesc', 'theme_agm_zebra');
    $default = '#fff';
	$previewconfig = array('selector'=>'#region-main', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set page-header background color
    $name = 'theme_agm_zebra/headerbgcolor';
    $title = get_string('headerbgcolor','theme_agm_zebra');
    $description = get_string('headerbgcolordesc', 'theme_agm_zebra');
    $default = 'transparent';
	$previewconfig = array('selector'=>'#page-header-wrapper', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set page-footer background color
    $name = 'theme_agm_zebra/footerbgcolor';
    $title = get_string('footerbgcolor','theme_agm_zebra');
    $description = get_string('footerbgcolordesc', 'theme_agm_zebra');
    $default = '#DDD';
	$previewconfig = array('selector'=>'#page-footer', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //This is the descriptor for the following Moodle color settings
    $name = 'theme_agm_zebra/moodlecolorsinfo';
    $heading = get_string('moodlecolorsinfo', 'theme_agm_zebra');
    $information = get_string('moodlecolorsinfodesc', 'theme_agm_zebra');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    //Set calendar course events color
    $name = 'theme_agm_zebra/calcourse';
    $title = get_string('calcourse','theme_agm_zebra');
    $description = get_string('calcoursedesc', 'theme_agm_zebra');
    $default = '#FFD3BD';
	$previewconfig = array('selector'=>'.calendar_event_course', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set calendar global events color
    $name = 'theme_agm_zebra/calglobal';
    $title = get_string('calglobal','theme_agm_zebra');
    $description = get_string('calglobaldesc', 'theme_agm_zebra');
    $default = '#D6F8CD';
	$previewconfig = array('selector'=>'.calendar_event_global', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set calendar group events color
    $name = 'theme_agm_zebra/calgroup';
    $title = get_string('calgroup','theme_agm_zebra');
    $description = get_string('calgroupdesc', 'theme_agm_zebra');
    $default = '#FEE7AE';
	$previewconfig = array('selector'=>'.calendar_event_group', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set calendar user events color
    $name = 'theme_agm_zebra/caluser';
    $title = get_string('caluser','theme_agm_zebra');
    $description = get_string('caluserdesc', 'theme_agm_zebra');
    $default = '#DCE7EC';
	$previewconfig = array('selector'=>'.calendar_event_user', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set calendar weekend color
    $name = 'theme_agm_zebra/calweekend';
    $title = get_string('calweekend','theme_agm_zebra');
    $description = get_string('calweekenddesc', 'theme_agm_zebra');
    $default = '#A00';
	$previewconfig = array('selector'=>'td.weekend', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set OK font color
    $name = 'theme_agm_zebra/okfontcolor';
    $title = get_string('okfontcolor','theme_agm_zebra');
    $description = get_string('okfontcolordesc', 'theme_agm_zebra');
    $default = '#060';
	$previewconfig = array('selector'=>'.backup-ok', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set warning font color
    $name = 'theme_agm_zebra/warningfontcolor';
    $title = get_string('warningfontcolor','theme_agm_zebra');
    $description = get_string('warningfontcolordesc', 'theme_agm_zebra');
    $default = '#F0E000';
	$previewconfig = array('selector'=>'.statuswarning', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set serious font color
    $name = 'theme_agm_zebra/seriousfontcolor';
    $title = get_string('seriousfontcolor','theme_agm_zebra');
    $description = get_string('seriousfontcolordesc', 'theme_agm_zebra');
    $default = '#F07000';
	$previewconfig = array('selector'=>'.statusserious', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //Set critical font color
    $name = 'theme_agm_zebra/criticalfontcolor';
    $title = get_string('criticalfontcolor','theme_agm_zebra');
    $description = get_string('criticalfontcolordesc', 'theme_agm_zebra');
    $default = '#F00000';
	$previewconfig = array('selector'=>'.statuscritical', 'style'=>'background');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    //This is the descriptor for the following color scheme settings
    $name = 'theme_agm_zebra/schemeinfo';
    $heading = get_string('schemeinfo', 'theme_agm_zebra');
    $information = get_string('schemeinfodesc', 'theme_agm_zebra');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    //Set gradient style for blocks, navbar, etc...
    $name = 'theme_agm_zebra/colorscheme';
    $title = get_string('colorscheme','theme_agm_zebra');
    $description = get_string('colorschemedesc', 'theme_agm_zebra');
    $default = 'none';
    $choices = array('none'=>get_string('schemenone', 'theme_agm_zebra'), 'dark'=>get_string('schemedark', 'theme_agm_zebra'), 'light'=>get_string('schemelight', 'theme_agm_zebra'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    //Set gradient style for custommenu
    $name = 'theme_agm_zebra/menucolorscheme';
    $title = get_string('menucolorscheme','theme_agm_zebra');
    $description = get_string('menucolorschemedesc', 'theme_agm_zebra');
    $default = 'none';
    $choices = array('none'=>get_string('schemenone', 'theme_agm_zebra'), 'dark'=>get_string('schemedark', 'theme_agm_zebra'), 'light'=>get_string('schemelight', 'theme_agm_zebra'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    //This is the descriptor for the following page layout settings
    $name = 'theme_agm_zebra/columninfo';
    $heading = get_string('columninfo', 'theme_agm_zebra');
    $information = get_string('columninfodesc', 'theme_agm_zebra');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    //Set min width for two column layout
    $name = 'theme_agm_zebra/twocolmin';
    $title = get_string('twocolmin','theme_agm_zebra');
    $description = get_string('twocolmindesc', 'theme_agm_zebra');
    $default = '481px';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_CLEAN, 5);
    $settings->add($setting);

    //Set min width for three column layout
    $name = 'theme_agm_zebra/threecolmin';
    $title = get_string('threecolmin','theme_agm_zebra');
    $description = get_string('threecolmindesc', 'theme_agm_zebra');
    // FIXME check whether this breaks something
//  $default = '769px';
    $default = '740px';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_CLEAN, 5);
    $settings->add($setting);

    //Set max width for page content
    $name = 'theme_agm_zebra/pagemaxwidth';
    $title = get_string('pagemaxwidth','theme_agm_zebra');
    $description = get_string('pagemaxwidthdesc', 'theme_agm_zebra');
    $default = '100%';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_CLEAN, 5);
    $settings->add($setting);

    //Set whether or not to use the simple login layout
    $name = 'theme_agm_zebra/simplelogin';
    $visiblename = get_string('simplelogin', 'theme_agm_zebra');
    $title = get_string('simplelogin', 'theme_agm_zebra');
    $description = get_string('simplelogindesc', 'theme_agm_zebra');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 0);
    $settings->add($setting);

    //Set column width for region-pre and region-post
    $name = 'theme_agm_zebra/colwidth';
    $title = get_string('colwidth','theme_agm_zebra');
    $description = get_string('colwidthdesc','theme_agm_zebra');
    $default = '200px';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_CLEAN, 5);
    $settings->add($setting);

    //This is the descriptor for the following browser compatibility settings
    $name = 'theme_agm_zebra/compatibilityinfo';
    $heading = get_string('compatinfo', 'theme_agm_zebra');
    $information = get_string('compatinfodesc', 'theme_agm_zebra');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    //Enable inclusion of respond.js in the footer
    $name = 'theme_agm_zebra/userespond';
    $visiblename = get_string('userespond', 'theme_agm_zebra');
    $title = get_string('userespond', 'theme_agm_zebra');
    $description = get_string('useresponddesc', 'theme_agm_zebra');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 0);
    $settings->add($setting);

    //Enable prompt of Google Chrome Frame
    $name = 'theme_agm_zebra/usecf';
    $visiblename = get_string('usecf', 'theme_agm_zebra');
    $title = get_string('usecf', 'theme_agm_zebra');
    $description = get_string('usecfdesc', 'theme_agm_zebra');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 0);
    $settings->add($setting);

    //Set maximum version for Chrome Frome prompt
    $name = 'theme_agm_zebra/cfmaxversion';
    $title = get_string('cfmaxversion','theme_agm_zebra');
    $description = get_string('cfmaxversiondesc', 'theme_agm_zebra');
    $default = '6';
    $choices = array('ie6'=>'6', 'ie7'=>'7', 'ie8'=>'8');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    //This is the descriptor for the following miscellaneous settings
    $name = 'theme_agm_zebra/miscinfo';
    $heading = get_string('miscinfo', 'theme_agm_zebra');
    $information = get_string('miscinfodesc', 'theme_agm_zebra');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    //Include the Autohide css rules
    $name = 'theme_agm_zebra/useautohide';
    $visiblename = get_string('useautohide', 'theme_agm_zebra');
    $title = get_string('useautohide', 'theme_agm_zebra');
    $description = get_string('useautohidedesc', 'theme_agm_zebra');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 1);
    $settings->add($setting);

    //Set custom css for theme
    $name = 'theme_agm_zebra/customcss';
    $title = get_string('customcss', 'theme_agm_zebra');
    $description = get_string('customcssdesc', 'theme_agm_zebra');
    $setting = new admin_setting_configtextarea($name, $title, $description, null);
    $settings->add($setting);

    //Set custom JS for theme
    $name = 'theme_agm_zebra/customjs';
    $title = get_string('customjs', 'theme_agm_zebra');
    $description = get_string('customjsdesc', 'theme_agm_zebra');
    $setting = new admin_setting_configtextarea($name, $title, $description, null);
    $settings->add($setting);

    //Display branded footer logos
    $name = 'theme_agm_zebra/branding';
    $visiblename = get_string('branding', 'theme_agm_zebra');
    $title = get_string('branding', 'theme_agm_zebra');
    $description = get_string('brandingdesc', 'theme_agm_zebra');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 1);
    $settings->add($setting);

    //Beg for money
    $name = 'theme_zebra/donate';
    $heading = get_string('donate', 'theme_zebra');
    $information = get_string('donatedesc', 'theme_zebra');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);
}