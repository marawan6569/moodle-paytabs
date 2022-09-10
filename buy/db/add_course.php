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
        <title>Add New Course</title>


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
            input
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
                <form class="col-6 mt-3 text-center" method="post" action="add_course.php">
                    <label for="id">Course Id</label>
                    <input type="text" class="form-control p-3 m-3" name="id" id="id" required>
                    <label for="name">Course Name</label>
                    <input type="text" class="form-control p-3 m-3" name="name" id="name" required>
                    <label for="price">Course Priceadd_course.php</label>
                    <input type="number" class="form-control p-3 m-3" name="price" id="price" required>
                    <button type="submit" class="btn p-3 px-5 mt-5 submit-btn">ADD COURSE </button>
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

if (key_exists('id', $_POST) and key_exists('name', $_POST) and key_exists('price', $_POST)):
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    require_once('utils.php');
    $insertion = add_main_course($id, $name, $price);
    if ($insertion):
        header('Location: admin.php');
    endif;
endif;
