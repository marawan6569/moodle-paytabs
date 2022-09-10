<?php require_once('../../config.php'); require_admin();?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Dates Dashboard</title>

        <style>
            body
            {
                background-color: #2e3948;
                width: 90vw;
                height: 90vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            div
            {
                background-color: #fff;
            }

            div > ul
            {
                list-style: none;
                padding: 0;
                width: 500px;
            }

            div > ul > a > li
            {
                padding: 10px;
                margin: 10px;
                cursor: pointer;
                color: #555;
            }

            div > ul > a> li:hover
            {
                background-color: #187FD3;
                color: #fff;
            }

            a {
                font-family: "Open Sans", sans-serif;
                color: inherit;
                text-decoration: none;
                font-weight: bold;
            }

        </style>
    </head>
    <body>



        <div>
            <ul>
                <a href="add_course.php"><li>Add Training Program</li></a>
                <a href="dates.php"><li>Dates</li></a>
                <a href="add_date.php"><li>Add Date</li></a>
                <a href="../../my/index.php"><li>Back</li></a>
            </ul>
        </div>

    </body>
</html>