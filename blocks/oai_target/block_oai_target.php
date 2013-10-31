<?php

include_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . "common.php";
include_once LIB_DIR . "Course.php";

// turn off strict error reporting, it breaks the XML
ini_set('display_errors', '0');     # don't show any errors...
error_reporting(E_ALL ^ E_STRICT);  # but do log them!

class block_oai_target extends block_base {

//***************************************************
// Init
//***************************************************
    function init() {
        $this->title = get_string('pluginname', 'block_oai_target');
    }

    function has_config() {
        return true;
    }

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
        if (!$Course->is_registered($COURSE->id)) {
            $Course->register($COURSE->id, time());
        }
        // intialize logs; perform this operation just once
        if (!$Course->log_exists($COURSE->id)) {
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

        $this->content = new stdClass;
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
        $this->content->text.= "title='" . get_string('pmh_icon_tooltip', 'block_oai_target') . "' />";
        $this->content->text.= "</a>";
        $this->content->text.="</div>";
        //
        $this->content->text.="<ol>";
        $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/target/oai2.php?verb=Identify'>Identify</a></li>";
        $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/target/oai2.php?verb=ListSets'>ListSets</a></li>";
        $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/target/oai2.php?verb=ListMetadataFormats'>ListMetadataFormats</a></li>";
        $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/target/oai2.php?verb=ListIdentifiers&metadataPrefix=oai_lom&set=course'>ListIdentifiers (courses)</a></li>";
        $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/target/oai2.php?verb=ListIdentifiers&metadataPrefix=oai_lom&set=resource'>ListIdentifiers (resources)</a></li>";
        $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/target/oai2.php?verb=ListRecords&metadataPrefix=oai_lom'>ListRecords</a></li>";
        $this->content->text.="<li><a target='_new' href='$CFG->wwwroot/blocks/oai_target/target/oai2.php?verb=GetRecord&identifier=http://www.foo.gr&metadataPrefix=oai_lom'>GetRecord</a></li>";
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

        include_once('lib/cronlib.php');

        $cl = new cronlib(0, "all");
        echo $cl->scan_files();

        echo "\n****** oai_target :: end ******\n\n";

        return;
    }

}

?>
