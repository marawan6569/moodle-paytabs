<?php
function enroll($idnumber, $userid, $roleid, $enrolmethod = 'manual') {
    global $DB;
    $user = $DB->get_record('user', array('id' => $userid, 'deleted' => 0), '*', MUST_EXIST);
    $course = $DB->get_record('course', array('idnumber' => $idnumber), '*', MUST_EXIST);
    $context = context_course::instance($course->id);
    if (!is_enrolled($context, $user)) {
        $enrol = enrol_get_plugin($enrolmethod);
        if ($enrol === null) {
            return false;
        }
        $instances = enrol_get_instances($course->id, true);
        $manualinstance = null;
        foreach ($instances as $instance) {
            if ($instance->name == $enrolmethod) {
                $manualinstance = $instance;
                break;
            }
        }
        if ($manualinstance !== null) {
            $instanceid = $enrol->add_default_instance($course);
            if ($instanceid === null) {
                $instanceid = $enrol->add_instance($course);
            }
            $instance = $DB->get_record('enrol', array('id' => $instanceid));
        }
        $enrol->enrol_user($instance, $userid, $roleid);
    }
    return true;
}


function check_enrollment($idnum){
    global $DB;
    global $USER;
    $course = $DB->get_record('course',['idnumber'=> $idnum]);
    $course_id = $course->id;

    $context = context_course::instance($course_id);
    $enrolled = is_enrolled($context, $USER->id, '', true);

    return $enrolled;
}

function check_multi_enrollments($arr_of_idnumbers){
    $status = 0;
    foreach ($arr_of_idnumbers as $idnumber):
         if (check_enrollment($idnumber)):
             $status++;
         endif;
    endforeach;
    return $status;
}