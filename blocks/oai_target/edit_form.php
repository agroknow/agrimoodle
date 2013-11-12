<?php
class block_oai_target_edit_form extends block_edit_form {
    protected function specific_definition( $mform ) {
		global $CFG;
		global $COURSE;

		$Course = new Course();
		$course_oai_target_setting = $Course->get_registration( $COURSE->id );
        // Fields for editing HTML block title and contents.
		$mform->addElement( 'header', 'configheader', get_string( 'blocksettings', 'block' ) );

		$attributes = array();
		$attributes['disabled'] = 'disabled';
		$attributes['group'] = 'oai_target_settings';


		//if( $CFG->block_oai_target_pmh_channel == 1 ) {
        	//$mform->addElement( 'checkbox', 'notify_by_pmh', get_string('notify_by_pmh', 'block_oai_target') );
		//} else {
        	//$mform->addElement( 'advcheckbox', 'notify_by_pmh', get_string('notify_by_pmh', 'block_oai_target'), null, $attributes );
		//}

		//if ( isset($course_oai_target_setting->notify_by_pmh) and $course_oai_target_setting->notify_by_pmh == 1 ) {
        	//$mform->setDefault( 'notify_by_pmh', 1 );
		//}

		//if ( $CFG->block_oai_target_pmh_channel == 1 ) {
	 	//	$options = array();
		//	for( $i=1; $i<25; ++$i ) {
		//		$options[$i] = $i;
		//	}
        	//$mform->addElement( 'select', 'update_frequency', get_string('update_frequency', 'block_oai_target'), $options );
        	//$mform->setDefault( 'update_frequency', $course_oai_target_setting->update_frequency/3600 );
		//}


        //$mform->addElement( 'html', '<br /><div class="qheader">'.get_string('course_configuration_presets_comment', 'block_oai_target').'</div>' );

    }

    function set_data( $defaults ) {
		$block_config = new Object();
		$block_config->notify_by_pmh = file_get_submitted_draft_itemid( 'notify_by_pmh' );
		$block_config->update_frequency = file_get_submitted_draft_itemid( 'update_frequency' );
        unset( $this->block->config->text );
		parent::set_data( $defaults );
        $this->block->config = $block_config;
	}
}

?>
