<?php

class block_europeana_edit_form extends block_edit_form {
	protected function specific_definition($mform) {

		// Section header title according to language file.
		$mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

		// A sample string variable with a default value.
		$mform->addElement('text', 'config_instructions', get_string('instructions_title', 'block_europeana'));
		$mform->setDefault('config_instructions', 'These are the instructions ...');
		$mform->setType('config_instructions', PARAM_MULTILANG);
	}

}
