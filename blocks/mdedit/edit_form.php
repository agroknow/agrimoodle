<?php

class block_mdedit_edit_form extends block_edit_form {

	protected function specific_definition($mform) {

		// Section header title according to language file.
		$mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

		// The block's title with a default value.
		$mform->addElement('text', 'config_title', get_string('blocktitle', 'block_mdedit'));
		$mform->setDefault('config_title', 'Metadata Editor');
		$mform->setType('config_title', PARAM_MULTILANG);

		// The label of the main button.
		$mform->addElement('text', 'config_block_mdedit', get_string('blocktitle', 'block_mdedit'));
		$mform->setDefault('config_block_mdedit', 'Enrich metadata ...');
		$mform->setType('config_block_mdedit', PARAM_MULTILANG);
	}

}

?>
