<?php require_once('../../config.php'); require_admin();?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link crossorigin="anonymous"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              rel="stylesheet">
        <title>Add New Date</title>


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
            .submit-btn
            {
                background-color: #1DB38C;
                color: #fff;
                font-weight: bold;
            }
            input, select
            {
                background-color: #e5e5e5 !important;
                border: none !important;
                color: #555;
            }
            label
            {
                float: left;
                margin-left: 1rem;
                margin-bottom: 10px;
                color: #555555;
                font-weight: bold;
            }
        </style>


    </head>
    <body>
        <div class="container mt-5 pt-5">
            <div class="row justify-content-center mt-5 pb-5 overflow-hidden">
                <h1 class="text-center p-3 text-capitalize title">Add New Course</h1>
                <form class="col-6 mt-3 text-center" method="post" action="add_date.php">

                    <label for="courses">Select a Course</label>
                    <select class="form-select p-3 m-3" name="course" id="courses">
                        <?php
                            require_once('utils.php');
                            $courses = get_all_main_courses();
                            foreach ($courses as $course):
                                echo "<option value='$course->id'>$course->name</option>";
                            endforeach;
                        ?>
                    </select>

                    <label for="id">Date Id</label>
                    <input type="text" class="form-control p-3 m-3" name="id" id="id" required>

                    <label for="start">Start Date</label>
                    <input type="date" class="form-control p-3 m-3" name="start" id="start" required>

                    <label for="end">End Date</label>
                    <input type="date" class="form-control p-3 m-3" name="end" id="end" required>

                    <button type="submit" class="btn p-3 px-5 mt-5 submit-btn">ADD DATE </button>
                </form>
            </div>
        </div>



        <script crossorigin="anonymous"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
        </script>
    </body>
</html>


<?php

if (key_exists('course', $_POST) and key_exists('id', $_POST) and key_exists('start', $_POST) and key_exists('end', $_POST)):
    $course_id = $_POST['course'];
    $date_id = $_POST['id'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    require_once('utils.php');
    $insertion = add_date($date_id, $start, $end, $course_id);
    if ($insertion):
        header('Location: dates.php');
    endif;
endif;
