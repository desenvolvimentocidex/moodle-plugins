<?php
require_once('../../config.php');

global $DB;

$userid = optional_param('userid', 0, PARAM_INT);
$courseid = optional_param('courseid', 0, PARAM_INT);
$grade = optional_param('grade', 0, PARAM_INT);
$description = optional_param('description', '', PARAM_TEXT);

$data = new stdClass();

$data->userid = $userid;
$data->courseid = $courseid;
$data->grade = $grade;
$data->description = $description;

$DB->insert_record('myfeedback', $data);

redirect(new moodle_url("/course/view.php?id=$courseid"));