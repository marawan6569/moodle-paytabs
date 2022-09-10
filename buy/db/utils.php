<?php
require_once('../../config.php');

/**
 * @throws dml_exception
 */
function add_main_course($id, $name, $price){
    global $DB;
    return $DB->insert_record('main_course', ['course_id'=>$id, 'name'=> $name, 'price'=> $price]);

}

/**
 * @throws coding_exception
 * @throws dml_exception
 */
function execute($sql): bool
{
    global $DB;
    if (strpos($sql, ';') !== false) {
        throw new coding_exception('moodle_database::execute() Multiple sql statements found or bound parameters not used properly in query!');
    }
    else{
        return $DB->execute($sql);
    }
}

/**
 * @throws coding_exception
 * @throws dml_exception
 */
function add_date($id, $start, $end, $course_id): bool
{
    $sql = "INSERT INTO `mdl_date` (`idnumber`, `course`, `start_date`, `end_date`, `ia_active`) VALUES ('$id', '$course_id', '$start', '$end', '1')";
    return execute($sql);
}


/**
 * @throws dml_exception
 */
function get_all_main_courses(): array
{
    global $DB;
    return $DB->get_records('main_course');
}

function get_main_course($course_id): array
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
//    global $DB;
//    return $DB->get_records('date', ['is_active'=> true]);
}

/**
 * @throws dml_exception
 */
function disable_date($date_id): bool
{
    $sql = "UPDATE `mdl_date` SET `is_active`= 0 WHERE `id`= $date_id";
    return execute($sql);
}