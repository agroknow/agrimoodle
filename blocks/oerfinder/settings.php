<?php

/**
 * oerfinder block settings
 *
 * @package    oerfinder
 * @copyright  2012 Agro-Know Technologies
 * @developer  <anastasios.koutoumanos@gmail.com>
 * @version    1.05
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

$BA = "block_oerfinder";

if ($ADMIN->fulltree) {

  $settings->add(
      new admin_setting_heading('oerfinder/headerconfig',
        new lang_string('hdr_config', $BA),
        new lang_string('dsc_config', $BA)));
  $settings->add(
      new admin_setting_configtext('oerfinder/service_url', 
              get_string('config_service_url_label', 'block_oerfinder'),
              get_string('config_service_url_help', 'block_oerfinder'),
              get_string('config_service_url_default', 'block_oerfinder')),
              PARAM_URL);
}

