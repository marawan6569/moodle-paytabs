<?php
require_once('../config.php');
require_once('paytabs.php');
require_once('enroll.php');
global $USER;

function get_course_id_num($cart_id): string
{
    $idnum = explode('-', $cart_id);
    array_splice($idnum, -1, 1);
    $idnum =  implode('-', $idnum);

    return $idnum;
}


if (key_exists('tranRef', $_POST)){
    $trd = $_POST['tranRef'];
}
else{
    echo '<center>';
    echo '<h1>Something went Wrong !!</h1>';
    echo '<h2>Please call support</h2>';
    echo '<h3>Or Go To Home Page From <a href="../index.php">Here</a></h3>';
    echo '</center>';
    die;
}

$verification = verify_payment($trd);


if ($verification->payment_result->response_status === 'A'){
    $user_id = $USER->id;
    $course_id_num = get_course_id_num($verification->cart_id);
    echo $course_id_num;
    $enrollment = enroll($course_id_num, $user_id, 5);
    if($enrollment){
        header('Location: ../my/courses.php');
    }
    else{
        echo '<center>';
        echo '<h1>Something went Wrong !!</h1>';
        echo '<h2>Please call support</h2>';
        echo '<h3>Or Go To Home Page From <a href="../index.php">Here</a></h3>';
        echo '</center>';
        die;
    }
}
else{
    echo '<center>';
    echo '<h1>Uncompleted Order !!</h1>';
    echo '<h2>Please call support</h2>';
    echo '<h3>Or Go To Home Page From <a href="../index.php">Here</a></h3>';
    echo '</center>';
    die;
}



