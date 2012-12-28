<?php

/**
 * OER finder Block Widget - configuration form
 *
 * @developer anastasios.koutoumanos@gmail.com
 * @version 1.01
 */

class block_oerfinder_edit_form extends block_edit_form {
	protected function specific_definition($mform) {
        // Section header title according to language file.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        // A sample string variable with a default value.
        $mform->addElement('text', 'config_instructions', get_string('instructions_title', 'block_oerfinder'));
        $mform->setDefault('config_instructions', 'These are the instructions ...');
        $mform->setType('config_instructions', PARAM_MULTILANG);

        $mform->addElement('advcheckbox', 'config_experiment',
                 'Experiment?', 'Will this block be part of an A/B experiment?', null, array(0,1));
        $mform->setDefault('config_experiment', 0);
        $mform->setType('config_experiment', PARAM_INT);
    }

}
