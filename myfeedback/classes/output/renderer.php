<?php
namespace block_myfeedback\output;

defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;
use renderable;

class renderer extends plugin_renderer_base {
    /**
     * Defer to template.
     * @param renderable $view
     * @return string
     */
    public function render_view(renderable $view) {
        $data = $view->export_for_template($this);
        return parent::render_from_template('block_myfeedback/view', $data);
    }
}