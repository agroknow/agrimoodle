<?php

class block_mdedit extends block_base {

	public function init() {
		$this->title = get_string('mdedit', 'block_mdedit');
	}

	// the block can be used only while displaying resources
	public function applicable_formats() {
		return array(
			'all' => false,
			'course-view' => true,
			'mod-resource-view' => true
		);
	}

	public function get_content() {
		if ($this->content !== null) {
			return $this->content;
		}

		$this->content = new stdClass;
		$this->content->footer = '';

		$_txt = '';
		$_res = $this->page->activityrecord;

		$this->page->requires->js('/local/agrimoodle/js/jquery16.js');
		$this->page->requires->js('/local/agrimoodle/js/jquery.boxy.js');
		$this->page->requires->js('/blocks/mdedit/js/md.js');

		$this->page->requires->css('/local/agrimoodle/css/boxy.css');
		$this->page->requires->css('/blocks/mdedit/css/md.css');

//		// check this: http://docs.moodle.org/dev/JavaScript_guidelines
//		$PAGE->requires->js_init_call('M.block_mdedit.hello');
//		$jsmodule = array(
//			'name' => 'block_mdedit',
//			'fullpath' => '/blocks/mdedit/module.js',
//			// 'requires' => array('base', 'io', 'node', 'json'),
//			'strings' => array(
//				array('something', 'mymod'),
//				array('confirmdelete', 'mymod'),
//				array('yes', 'moodle'),
//				array('no', 'moodle')
//			)
//		);
//		$PAGE->requires->js_init_call('M.block_mdedit.init', array('some', 'data', 'from', 'PHP'), false, $jsmodule);

//		$PAGE->requires->js_init_call('M.block_mdedit.init');
//		$this->page->requires->js_init_call('M.block_mdedit.hello');
		
		$_txt .= '<div style="text-align:middle">';
		$_txt .= '<input type="submit" id="medit" value="' . get_string('lbl_button', 'block_mdedit') . '" />';
		$_txt .= '<ul style="font-size:x-small">';
		$_txt .= '<li>COURSE ID  : ' . $this->page->course->id . '</li>';
		$_txt .= '<li>RES ID     : ' . $_res->id . '</li>';
		$_txt .= '<li>RES NAME   : ' . htmlspecialchars($_res->name) . '</li>';
		$_txt .= '<li>RES INTRO  : ' . htmlspecialchars($_res->intro) . '</li>';
		$_txt .= '<li>RES DATE   : ' . htmlspecialchars($_res->timemodified) . '</li>';
		$_txt .= '<li>RES FILE   : ' . htmlspecialchars($_res->mainfile) . '</li>';
		$_txt .= '</ul>';
		$_txt .= '</div>';

		/* Variable we need to pass to JS not in Moodle way :| */
		$data = array(
			'COURSE_ID' => $this->page->course->id,
			'RES_ID' => $_res->id,
			'RES_NAME' => htmlspecialchars($_res->name),
			'RES_INTRO' => htmlspecialchars($_res->intro),
			'RES_DATE' => htmlspecialchars($_res->timemodified),
			'RES_FILE' => htmlspecialchars($_res->mainfile)
		);
		$_txt .= '<script> var MDEData = ' . json_encode($data) . ';</script>';
		$this->content->text = $_txt;

//		print_object(get_context_instance(CONTEXT_BLOCK, $this->page->course->id));
//		print_object($this->page->activityrecord);
		$this->content->footer .= '<span style="font-size: smaller">' . get_string('lbl_footer', 'block_mdedit') . '</span>';

		return $this->content;
	}

	public function specialization() {
		if (!empty($this->config->title)) {
			$this->title = $this->config->title;
		} else {
			$this->config->title = 'Metadata Editor';
		}

		if (empty($this->config->button_text)) {
			$this->config->button_text = 'Enrich metadata ...';
		}
	}

	public function instance_allow_multiple() {
		return false;
	}

}

// Here's the closing bracket for the class definition
?>
