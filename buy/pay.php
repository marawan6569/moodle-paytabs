<?php

require_once('../config.php');
require_once('utils.php');
require_once('paytabs.php');
global $USER;
$base_url = 'http://localhost/moodle/';


if (key_exists('course_id', $_POST) and key_exists('date', $_POST)) {
    // course_info
    $course_id = $_POST['course_id'];
    $course = get_main_course($course_id);
    $course_name = $course->name;
    $course_price = $course->price;
    $course_date = get_date_by_idnumber($_POST['date']);
    $date_id = $course_date->idnumber;
    $start_date = $course_date->start_date;
    $end_date = $course_date->end_date;

    //  user info
    $user_id = $USER->id;
    $user_full_name = $USER->firstname . ' ' . $USER->lastname;
    $user_email = $USER->email;
    $user_phone = $USER->phone1;
    $user_address = $USER->address;
    $user_city = $USER->city;
    $user_country = $USER->country;

    $random_number = (rand(0, 10000));
}
else
{
    echo '<center>';
    echo '<h1>Something went Wrong !!</h1>';
    echo '<h2>Please call support</h2>';
    echo '<h3>Or Go To Home Page From <a href="../index.php">Here</a></h3>';
    echo '</center>';
    die;
}

$request_body = [
    "profile_id" => "YOUR_PROFILE_ID",
    "tran_type" => "sale",
    "tran_class" => "ecom",
    "cart_id" => "$date_id-$random_number",
    "cart_currency" => "SAR",
    "cart_amount" => $course_price,
    "cart_description" => "$course_name | from $start_date to $end_date",
    "paypage_lang" => "en",
    "customer_details" => [
        "name" => "$user_full_name",
        "email" => "$user_email",
         "phone" => "$user_phone",
        "street1" => "$user_address",
        "city" => "$user_city",
        "country"=> "$user_country",
    ],
    "callback"=> "",
    "return" => "$base_url/buy/verify.php",
    'hide_shipping' => true,
    "user_defined" => [
        "moodle_course_idnum" => "$date_id",
    ],
];



$page = create_payment_page($request_body);
 if (property_exists($page, 'redirect_url')){
     header("Location: " . $page->redirect_url);
 }
 else{
     echo '<center>';
     echo '<h1>Something went Wrong !!</h1>';
     echo '<h2>Please call support</h2>';
     echo '<h3>Or Go To Home Page From <a href="../index.php">Here</a></h3>';
     echo '</center>';
     die;
 }