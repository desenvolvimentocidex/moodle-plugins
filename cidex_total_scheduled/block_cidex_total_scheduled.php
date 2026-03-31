<?php
defined('MOODLE_INTERNAL') || die();

class block_cidex_total_scheduled extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_cidex_total_scheduled');
    }

    public function get_content() {
        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass();

        $view = new \block_cidex_total_scheduled\output\view();

        $renderer = $this->page->get_renderer('block_cidex_total_scheduled');

        $this->content->text = $renderer->render($view);
        $this->content->footer = '';

        return $this->content;
    }

    public function applicable_formats() {
        return [
            'admin' => false,
            'site-index' => true,
            'course-view' => true,
            'mod' => false,
            'my' => true,
        ];
    }
}