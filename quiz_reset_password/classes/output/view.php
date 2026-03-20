<?php
namespace block_quiz_reset_password\output;

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
        global $DB;
        global $COURSE;

        //Localhost
        /*$quiz = $DB->get_records_sql("
            SELECT
            c.id,
            c.fullname,
            c.shortname,
            cc.name AS course_category,
            q.`password`
            FROM {course} AS c
            INNER JOIN {course_categories} AS cc ON (c.category = cc.id)
            INNER JOIN {quiz} AS q ON (q.course = c.id)
            WHERE
            c.category IN (2, 3, 4, 5, 6)
        ");*/

        //Remote (CTA)
        $quiz = $DB->get_records_sql("
            SELECT
            c.id,
            c.fullname,
            c.shortname,
            cc.name AS course_category,
            q.`password`
            FROM {course} AS c
            INNER JOIN {course_categories} AS cc ON (c.category = cc.id)
            INNER JOIN {quiz} AS q ON (q.course = c.id)
            WHERE
            c.category IN (4, 5, 12, 18, 19)
        ");

        $quizzes = [];

        foreach ($quiz as $value) {
            $quizzes[] = [
                'id' => format_string($value->id),
                'fullname' => format_string($value->fullname),
                'shortname' => format_string($value->shortname),
                'course_category' => format_string($value->course_category),
                'password' => format_string($value->password),
            ];
        }

        $data = array(
            'formaction' => (new \moodle_url('/blocks/quiz_reset_password/process_form.php')),
            'userid' => $this->user->id,
            'courseid' => $COURSE->id,
            'quiz' => $quizzes
        );

        //print_r($data['quiz']);

        return $data;
    }
}