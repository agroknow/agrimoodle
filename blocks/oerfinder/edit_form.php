<?php

/**
 * OER finder Block Widget - configuration form
 *
 * @developer anastasios.koutoumanos@gmail.com
 * @version 1.01
 */
class block_oerfinder_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        global $COURSE;
        
        //$admin = $this->_customdata['admin'];
        
        // Section header title according to language file.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        // A string for default search
        $mform->addElement('text', 'config_searchvalue', get_string('instructions_searchvalue', 'block_oerfinder'));
        $mform->setDefault('config_searchvalue', $COURSE->fullname); 
        $mform->setType('config_searchvalue', PARAM_MULTILANG);
        
        //Finder's web service URL
        if (is_siteadmin()){
        $mform->addElement('text', 'config_service_url', get_string('config_service_url', 'block_oerfinder'));
        $mform->setDefault('config_service_url', 'http://83.212.96.169:8080/repository2/api/ariadne/restp');
        $mform->setType('config_service_url', PARAM_MULTILANG);
        }
        
        //Enable or not if this course is using the experiment
        $mform->addElement('advcheckbox', 'config_experiment', 'Experiment?', 'Will this block be part of an A/B experiment?', null, array(0, 1));
        $mform->setDefault('config_experiment', 0);
        $mform->setType('config_experiment', PARAM_INT);

        //Enable or not to change the search value
        $mform->addElement('advcheckbox', 'config_search_available', 'Searching?', get_string('search_available', 'block_oerfinder'), null, array(0, 1));
        $mform->setDefault('config_search_available', 1);
        $mform->setType('config_search_available', PARAM_INT);
    }

}
