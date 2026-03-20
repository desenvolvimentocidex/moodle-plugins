<?php
namespace block_myfeedback\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;

class view implements renderable, templatable {
    /** @var stdClass The user. */
    protected $user;

    /**
     * Constructor.
     * @param stdClass $user The user.
     */
    public function __construct($user = null) {
        global $USER;

        if (!$user) {
            $user = $USER;
        }

        $this->user = $user;
    }

    public function export_for_template(renderer_base $output) {
        global $COURSE;

        $data = array(
            //'formaction' => new moodle_url("/blocks/myfeedback/process_form.php"),
            'formaction' => (new \moodle_url('/blocks/myfeedback/process_form.php')),
            'userid' => $this->user->id,
            'courseid' => $COURSE->id
        );

        return $data;
    }
}