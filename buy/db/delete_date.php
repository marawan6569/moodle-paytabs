<?php require_once('../../config.php'); require_admin();?>
<?php
require_once('utils.php');

if (key_exists('date_id', $_GET)):
    $date_id = $_GET['date_id'];
    $disabled = disable_date($date_id);

endif;

header('Location: admin.php');
