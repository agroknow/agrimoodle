<?php
include_once realpath( dirname( __FILE__ ).DIRECTORY_SEPARATOR ).DIRECTORY_SEPARATOR."common.php";

defined( 'MOODLE_INTERNAL' ) || die;
global $CFG;

if ( $ADMIN->fulltree ) {

	$settings->add( new admin_setting_heading('block_oai_target_settings', '',
            get_string('global_configuration_comment', 'block_oai_target')) );
	$settings->add( new admin_setting_configcheckbox('block_oai_target_pmh_channel',
            get_string('pmh', 'block_oai_target'), '', 1) );

	$options = array();
	for( $i=1; $i<25; ++$i ) {
		$options[$i] = $i;
	}

	$default = 3;
	if( isset($CFG->block_update_frequency) ) {
		$default = $CFG->block_update_frequency;
	}

    $settings->add( new admin_setting_configselect('block_update_frequency',
            get_string('update_frequency', 'block_oai_target'),
            get_string('update_frequency_comment', 'block_oai_target'), $default , $options) );

	$settings->add( new admin_setting_heading('block_oai_target_presets', '',
            get_string('global_configuration_presets_comment', 'block_oai_target')) );

}