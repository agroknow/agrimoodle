<?php
include_once realpath(dirname( __FILE__ ).DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR."common.php";
include_once LIB_DIR."Course.php";

class block_oai_target extends block_base {

//***************************************************
// Init
//***************************************************
	function init() {
		$this->title = get_string('pluginname', 'block_oai_target');
	}

	function has_config() { return true; }

	function after_install() {
		global $CFG;
		// initialize the global configuration
		$global_config = array(
			"block_oai_target_pmh_channel" => 1,
			"block_update_frequency" => 12
		);
		return parent::config_save($global_config);
	}

	function before_delete() {
		global $CFG;
		unset($CFG->block_oai_target_pmh_channel);
		unset($CFG->block_update_frequency);
		return true;
	}

	function applicable_formats() {
		return array('course-view' => true);
	}


//***************************************************
// Configurations
//***************************************************
	function specialization() {
		global $COURSE;
		$Course = new Course();
		// if the course has not been registered so far
		// then register the course and set the starting time
		// for oai_target
		if( !$Course->is_registered($COURSE->id) ) {
			$Course->register($COURSE->id, time());
		}
		// intialize logs; perform this operation just once
		if( !$Course->log_exists($COURSE->id) ) {
			$Course->initialize_log($COURSE);
		}
	}

	function instance_allow_config() {
		return true;
	}

	function instance_config_save($data, $nolongerused = false) {
		global $COURSE;
		$Course = new Course();
		$Course->update_course_settings($COURSE->id, $data);
  		return true;
	}


//***************************************************
// Block content
//***************************************************
	function get_content() {
		if ($this->content !== NULL) {
			return $this->content;
		}

		global $COURSE;
		global $CFG;

		$this->content   = new stdClass;
		$Course = new Course();
		$course_registration = $Course->get_registration($COURSE->id);
		

        // last update info
        $this->content->text = "<span style='font-size: small'>";
//        if ($course_registration->notify_by_pmh == 1)
//            $this->content->text.= get_string('course_registered', 'block_oai_target');
//        else
//            $this->content->text.= get_string('course_not_registered', 'block_oai_target');
//        $this->content->text.= "<br/>";
//        $this->content->text.= get_string('last_update', 'block_oai_target');
//        $this->content->text.= ": ".date("j M Y G:i:s",$course_registration->last_update_time);
//        $this->content->text.= "</span><br />";

//        if ( $CFG->block_oai_target_pmh_channel == 1 and $course_registration->notify_by_pmh == 1 ) {
            $this->content->text.="<div style='float:right'>";
            $this->content->text.= "<a target='_blank' href='$CFG->wwwroot/blocks/oai_target/lib/PMH.php?id=$COURSE->id'>";
            $this->content->text.= "<img src='$CFG->wwwroot/blocks/oai_target/images/OAI-icon.png' ";
            $this->content->text.= "alt='OAI icon' ";
            $this->content->text.= "title='".get_string('pmh_icon_tooltip', 'block_oai_target')."' />";
            $this->content->text.= "</a>";
            $this->content->text.="</div>";
            //
            $this->content->text.="<ol>";
            $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/lib/PMH.php?verb=GetRecord'>GetRecord</a></li>";
            $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/lib/PMH.php?verb=Identify'>Identify</a></li>";
            $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/lib/PMH.php?verb=ListIdentifiers'>ListIdentifiers</a></li>";
            $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/lib/PMH.php?verb=ListMetadataFormats'>ListMetadataFormats</a></li>";
            $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/lib/PMH.php?verb=ListRecords'>ListRecords</a></li>";
            $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/lib/PMH.php?verb=ListSets'>ListSets</a></li>";
            $this->content->text.="</ol>";
//		}
		$this->content->footer = '<b>Note:</b> under construction!';
		return $this->content;
	}

//***************************************************
// Cron
//***************************************************

function cron() {
		global $CFG;
		echo "\n\n****** oai_target :: begin ******";

		$Course = new Course();
		// clean deleted courses data
		$Course->collect_garbage();

		// get the list of courses that are using this block
		$courses = $Course->get_all_courses_using_oai_target_block();
		
		// if no courses are using this block exit
		if( !is_array($courses) or count($courses) < 1 ) {
			echo "\n--> None course is using oai_target plugin.";
			echo "\n****** oai_target :: end ******\n\n";
			return;
		}

		foreach($courses as $course) {
			// if course is not visible then skip
			if ( $course->visible == 0 ) { continue; }

			// if the course has not been registered so far then register
			echo "\n--> Processing course: $course->fullname";
			if( !$Course->is_registered($course->id) ) {
				$Course->register($course->id, time());
			}

			// check update frequency for this course
			$course_registration = $Course->get_registration($course->id);

			// if course log entry does not exist
			// or the last update time is older than two days
			// then reinitialize course log
			if( !$Course->log_exists($course->id) or $course_registration->last_update_time + 48*3600 < time() )
				$Course->initialize_log($course);

			// check update frequency for the course and skip to next cron cycle if neccessary
			if( $course_registration->last_update_time + $course_registration->update_frequency > time() ){
				echo " - Skipping to next cron cycle.";
				continue;
			}

			$Course->update_log($course);

			// check if the course has something new or not
			$changelist = $Course->get_recent_activities($course->id);
			// update the last update time
			$Course->update_last_update_time($course->id, time());
			if( empty($changelist) ) { continue; } // check the next course. No new items in this one.


		}
		echo "\n****** oai_target :: end ******\n\n";
		return;
	}

}
?>
