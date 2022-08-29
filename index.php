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

?>

<html>
    <head>
        <link crossorigin="anonymous"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              rel="stylesheet">
        <title>Buy <?php echo $course_name ?></title>
    </head>
    <body>
        <div class="container mt-5 pt-5">
            <div class="row justify-content-center mt-5 pt-5">
                <h1 class="text-center text-capitalize">Hello <?php echo $user_full_name; ?>!</h1>
                <h2 class="text-center text-capitalize">You will buy:  <?php echo $course_name; ?></h2>
                <h3 class="text-center text-capitalize">Please choose a date:</h3>
                <form class="col-6 mt-3 text-center" method="post" action="pay.php">
                    <div class="form-floating">
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
                    <button type="submit" class="btn btn-success p-2 mt-5">PROCEED TO PAYMENT</button>
                </form>
            </div>
        </div>


        <script crossorigin="anonymous"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
