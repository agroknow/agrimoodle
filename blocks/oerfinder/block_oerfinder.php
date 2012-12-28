<?php


/**
 * OER Finder Block Widget
 *
 * @developer Tasos Koutoumanos <anastasios.koutoumanos@gmail.com>
 * @version 1.05
 *
 * Based on the Ariadne Block widget originally
 * developed by A.Shukr <ahshukr@eummena.org>
 */
// NOTE: config link http://ariadne.cs.kuleuven.be/finder/ariadne/

class block_oerfinder extends block_base {


    function has_config() {
        return true;
    }


    function get_required_javascript() {
        
    }


    function instance_allow_config() {
        return true;
    }


    // FIXME maybe remove this for production
    public function instance_allow_multiple() {
        return true;
    }


    function init() {
        $this->title = get_string('pluginname', 'block_oerfinder');
    }


    /**
     * Called immediately after init()
     */
//    public function specialization() {
//    }

    function get_content() {
        global $PAGE, $CFG, $DB, $COURSE;

        // FIXME is this caching valid ???
        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text = '';
        $this->content->footer = '';

        // check to see if this is part of an A-B Experiment
        if (!empty($this->config->experiment) AND ($this->config->experiment > 0)) {
            $this->content->text .= '<p>Experiment</p>';
        }


        $PAGE->requires->js('/local/agrimoodle/js/jquery16.js');
        $PAGE->requires->js('/local/agrimoodle/js/jquery.boxy.js');
        // FIXME +++ prototype clashes with yui, and tree controls will not work
//        $PAGE->requires->js('/local/agrimoodle/js/prototype.js');
//        $PAGE->requires->js('/local/agrimoodle/js/jsonp.js');
        $PAGE->requires->css('/local/agrimoodle/css/boxy.css');

        $PAGE->requires->js('/blocks/oerfinder/lib/oerfinder.js');

        $id = $_GET['id'];
        $_SESSION['__cc_id'] = $id;

        //get language strings .
        $ml_strings = get_strings(array('search_box_text', 'loading_text', 'search_button_text'), 'block_oerfinder');

        $this->content->text .= "
			<div class='searchform'>
				<input id='simple_search_fld' name='oerfinder_search' size='16'
					   placeholder='{$ml_strings->search_box_text}'
					   type='text' value='{$COURSE->fullname}' maxlength='300'/>
				<input type='submit' id='submit_search' title='Submit Search' value='{$ml_strings->search_button_text}' />
			</div>
			<div id='noOfResults'></div>
			<div id='results'>{$ml_strings->loading_text}</div>
             <div id='debug'>{$DB->count_records('block_oerfinder_logs', null)} records in logs</div>
		";
        $this->content->text .= $this->getUserInfoJSObject();
        return $this->content;
    }


    public function getUserInfoJSObject() {
        global $USER, $DB, $COURSE;
        $table = 'course_sections';
        $select = "course = $COURSE->id";
        $results = $DB->get_records_select($table, $select);
        //get question sequence for this course
        $sections = '[';
        $len = count($results);
        $i = 0;
        foreach ($results as
                $result) {
            $sections.=$result->section . ( ( $i != $len - 1 ) ? "," : "]" );
            $i+=1;
        }

        return
        '<script type="text/javascript">
            var page ={
                "user_id":"' . $USER->id . '",
                "course_id":"' . $COURSE->id . '",
                "sesskey":"' . $USER->sesskey . '",
                "sections":' . $sections . ',
                "course_name":"' . $COURSE->fullname . '"
            };
         </script>';
    }


    function hide_header() {
        return false;
    }


    function preferred_width() {
        return 310;
    }

}