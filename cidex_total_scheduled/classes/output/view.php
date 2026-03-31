<?php
namespace block_cidex_total_scheduled\output;

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

        $shedule = $DB->get_records_sql("
            SELECT 
            c.shortname, 
            from_unixtime(st.starttime) AS data, 
            u.username, 
            concat(u.firstname, ' ',  u.lastname) AS nome,
            st.duration, 
            st.exclusivity  
            FROM mdl_course AS c 
            JOIN mdl_scheduler AS s ON (s.course = c.id) 
            JOIN mdl_scheduler_slots AS st ON (s.id = st.schedulerid) 
            JOIN mdl_scheduler_appointment AS a ON (st.id = a.slotid) 
            JOIN mdl_user AS u ON (a.studentid = u.id) 
            ORDER BY 
            c.shortname, st.starttime, nome, u.username;
        ");

        $scheduled = [];

        foreach ($shedule as $value) {
            $scheduled[] = [
                'shortname' => format_string($value->shortname),
                'data' => format_string($value->data),
                'username' => format_string($value->username),
                'nome' => format_string($value->nome),
                'duration' => format_string($value->duration),
                'exclusivity' => format_string($value->exclusivity),
            ];
        }

        $data = array(
            'scheduled' => $scheduled
        );

        //print_r($data['quiz']);

        return $data;
    }
}