<?php
include_once realpath( dirname( __FILE__ ).DIRECTORY_SEPARATOR ).DIRECTORY_SEPARATOR."common.php";
global $PAGE, $COURSE, $OUTPUT;

$url = new moodle_url('/blocks/oai_target/help.php', array('course'=>$COURSE->id));
$PAGE->set_url($url);

$context = get_context_instance(CONTEXT_SYSTEM);
$PAGE->set_context($context);

echo $OUTPUT->header();

// print title
echo $OUTPUT->heading(get_string( 'help_title', 'block_oai_target' ), 3, 'main');

echo $OUTPUT->box_start('generalbox boxaligncenter');
echo '<p>'.get_string( 'general_instructions', 'block_oai_target' ).'</p>';
echo $OUTPUT->box_end();
echo $OUTPUT->close_window_button();

echo $OUTPUT->footer();
?>
