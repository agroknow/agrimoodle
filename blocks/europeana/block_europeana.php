<?php

/**
 * Europeana Block Widjet
 *
 * @developer Tasos Koutoumanos
 * @version 0.1
 */

class block_europeana extends block_base {

	function init() {
		$this->title = get_string('pluginname', 'block_europeana');
	}
	
	// the block can be used only while displaying resources or courses
	public function applicable_formats() {
		return array(
			'all' => false,
			'course-view' => true,
			'mod-resource-view' => true
		);
	}
	
	public function specialization() {
		if (!empty($this->config->title)) {
			$this->title = $this->config->title;
		} else {
			$this->config->title = 'Europeana Widget';
		}

		if (empty($this->config->button_text)) {
			$this->config->button_text = 'Search Europeana ...';
		}
	}

	public function instance_allow_multiple() {
		return false;
	}

	function get_content() {
		global $CFG, $USER, $DB, $COURSE, $PAGE;

		if ($this->content !== NULL) {
			return $this->content;
		}

		$this->content = new stdClass;
		$this->content->text = '';
		$this->content->footer = '';

//		$this->page->requires->js('/local/agrimoodle/js/jquery16.js');
//		$this->page->requires->js('/local/agrimoodle/js/jquery.boxy.js');
//		$this->page->requires->js('/local/agrimoodle/js/prototype.js');
//		$this->page->requires->js('/local/agrimoodle/js/jsonp.js');
//		$PAGE->requires->yui2_lib('yui2-container');
//		$PAGE->requires->yui2_lib('yui2-dragdrop');
		
//		$PAGE->requires->js('/blocks/europeana/js/yui.init.js');
		$PAGE->requires->js('/blocks/europeana/js/europeana.finder.js');

		//get language file .
		$ml_strings = get_strings(array('search_box_text', 'loading_text', 'search_button_text'), 'block_europeana');
		$instr = '';
		if (!empty($this->config->config_instructions)) {
			$instr = $this->config->config_instructions;
		}
		$this->content->text .= "
			<div class='searchform'>
				<form action='javascript:sendQuery(document.getElementById(\"simple_search_fld\").value,\"{$CFG->wwwroot}\"); return false;' >
				<input id='simple_search_fld' name='europeana_search' size='16'						 
					   placeholder='{$ml_strings->search_box_text}'
					   type='text' value='{$COURSE->fullname}' maxlength='340'/>
				<input type='submit' id='submit_search' title='Submit Search' value='>' />
				</form>
			</div>
			<div id='noOfResults'></div>
			<div id='results'>{$ml_strings->loading_text}</div>
		";
		
		$this->content->text .= "
			<input type='button' id='popup' value='Popup' />
			<div id='modalContainer'>
				<div id='modalPanel'>
					<div class='hd'>Moodle</div>
					<div class='bd'>
						Moodle (abbreviation for Modular Object-Oriented Dynamic Learning Environment) is a free and open-source e-learning software platform, also known as a Course Management System, Learning Management System, or Virtual Learning Environment (VLE). As of October 2010 it had a user base of 49,952 registered and verified sites, serving 37 million users in 3.7 million courses.
					</div>
					<div class='ft'>[Footer]</div>
				</div>
			</div>
		";
		
		return $this->content;
	}

	public function getConfigData() {
		$config = dirname(__FILE__);
	}

}

?>
