<?php require_once('../../config.php'); require_admin();?>
<?php
require_once('utils.php');
$main_courses = get_all_courses();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link crossorigin="anonymous"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              rel="stylesheet">
        <title>All Dates</title>
    </head>
    <body>

        <div class="container">
            <div class="row text-capitalize text-center">
                <?php
                foreach ($main_courses as $course) :
                    echo "                
                        <div>
                            <h3 class='mt-5'>$course->name</h3>
                            <table class='table mt-2'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Id</th>
                                        <th scope='col'>Start Date</th>
                                        <th scope='col'>End Date</th>
                                        <th scope='col'>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>";
                $dates = get_dates($course->id);
                                foreach ($dates as $date):
                                    echo "
                                        <tr>
                                            <th scope='row'>$date->idnumber</th>
                                            <td>$date->start_date</td>
                                            <td>$date->end_date</td>
                                            <td><a href='delete_date.php?date_id=$date->id'>Delete</a></td>
                                        </tr>
                                    ";
                                endforeach;
                                echo "</tbody>
                            </table>
                        </div>";
                endforeach;
                ?>
            </div>
        </div>

        <script crossorigin="anonymous"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
        </script>
    </body>
</html>