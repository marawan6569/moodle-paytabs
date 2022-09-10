<?php
require_once('../config.php');

/**
 * @throws dml_exception
 */
function get_main_course($course_id)
{
    global $DB;
    return $DB->get_record('main_course', ['course_id'=> $course_id]);
}

/**
 * @throws coding_exception
 * @throws dml_exception
 */
function get_dates($main_course_id): array
{
    global $DB;
    $sql = "SELECT * FROM `mdl_date` WHERE `course` = $main_course_id  AND `is_active`= 1";
    if (strpos($sql, ';') !== false) {
        throw new coding_exception('moodle_database::execute() Multiple sql statements found or bound parameters not used properly in query!');
    }
    else {
       return $DB->get_records_sql($sql);
    }
}


/**
 * @throws coding_exception
 * @throws dml_exception
 */
function get_date_by_idnumber($idnumber)
{
    global $DB;
    return $DB->get_record('date', ['idnumber'=> $idnumber]);
}

