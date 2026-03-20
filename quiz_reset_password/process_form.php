<?php
require_once('../../config.php');

global $CFG;
global $DB;

$userid = optional_param('userid', 0, PARAM_INT);
$courseid = optional_param('courseid', 0, PARAM_INT);
$new_password = optional_param('new_password', '', PARAM_TEXT);

//$data = new stdClass();

//Insert
//$data->userid = $userid;
//$data->courseid = $courseid;
//$data->$shortname = $shortname;

//$DB->insert_record('quiz_reset_password', $data);

//redirect(new moodle_url("/course/view.php?id=$courseid"));

if ($new_password != "") {
    //Localhost
    //$sql = "UPDATE {quiz} SET password = ? WHERE course IN (SELECT c.id FROM {course} AS c WHERE c.category IN (2, 3, 4, 5, 6))";
    //Remote (CTA)
    $sql = "UPDATE {quiz} SET password = ? WHERE course IN (SELECT c.id FROM {course} AS c WHERE c.category IN (4, 5, 12, 18, 19))";

    $condition = "";

    $result = $DB->execute($sql, array($new_password, $condition));

    if ($result) {
        echo "As senhas foram atualizadas com sucesso!";
        echo "<br><br>";
        echo '<a href="'.$CFG->wwwroot.'/my/" style="text-decoration: none; text-transform: uppercase; background-color: #4caf50; color: #ffffff; padding: 10px 15px; border: none; border-radius: 5px;">Voltar</a>';
    } else {
        echo "Não foi possível atualizar as senhas. Tente novamente ou entre em contato com o administrador. ".$DB->error();
    }
} else {
    echo "O campo (Nova Senha) é obrigatório.";
}