<?php

require_once('../config.php');
require_once('enroll.php');
require_once('courses_list.php');
require_login();
global $courses;

if (key_exists('id', $_GET)){
    $course_id =  $_GET['id'];
}

else{
    header("Location: ../index.php");
    die();
}

if (key_exists($course_id, $courses)){
    $course_name = $courses[$course_id]['name'];
    $course_dates = $courses[$course_id]['dates'];
}
else{
    echo "<h1><b><center>Sorry, there is No Course with the id '$course_id'</center></b></h1>";
    die;
}

global $USER;

$user_full_name = $USER->firstname . ' ' . $USER->lastname;
$user_email = $USER->email;
$user_id = $USER->id;


$enrolments = check_multi_enrollments(array_keys($courses[$course_id]['dates']));


?>

<html>
    <head>
        <link crossorigin="anonymous"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              rel="stylesheet">
        <style>
            body
            {
                background-color: #2e3948
            }

            .row
            {
                background-color: #fff;
                border-radius: 10px
            }
            .title
            {
                background: #187fd3;
                color: #fff;
            }
            .sub-title
            {
                color: #555;
            }
            #floatingSelect
            {
                color: #555;
            }
            .submit-btn
            {
                background-color: #1DB38C;
                color: #fff;
                font-weight: bold;
            }
        </style>
        <title>Buy : <?php echo $course_name ?></title>
    </head>
    <body>
        <div class="container mt-5 pt-5">
            <div class="row justify-content-center mt-5 pb-5 overflow-hidden">
                    <h1 class="text-center p-3 text-capitalize title">Hello <?php echo $user_full_name; ?>!</h1>
                    <h2 class="text-center text-capitalize">You will buy:  <?php echo $course_name; ?></h2>
                    <h3 class="text-center text-capitalize sub-title">Please choose a date:</h3>
                    <form class="col-6 mt-3 text-center" method="post" action="pay.php">
                        <div class="form-floating" >
                            <select class="form-select" name="date" id="floatingSelect">
                                <?php
                                foreach ($course_dates as $date) {
                                    echo "<option value='" . $date['idnum'] ."'> from " . $date['start_date'] . ' to ' . $date['end_date'] . "</option>";
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Available dates: </label>
                        </div>
                        <input type="text" name="course_id" hidden value="<?php echo $course_id; ?>">
                        <?php
                        if ($enrolments):
                            echo "<br><p class='text-danger'><b>*</b>You are already bought this course before!
                                     If you are really want to continue press \"PROCEED TO PAYMENT\"
                                     Or Go To your <a href='../my/courses.php'>courses</a>
                                  </p>";
                        endif;
                        ?>
                        <button type="submit" class="btn p-3 px-5 mt-5 submit-btn">PROCEED TO PAYMENT</button>
                    </form>
            </div>
        </div>


        <script crossorigin="anonymous"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
        </script>
    </body>
</html>
