<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('Controller/CurrencyController.php');

$ctrl = new CurrencyController(new SettingRepository(), new HistoryRepository());



if (isset($_POST['checked_value']) && isset($_POST['checked_txt']) && isset($_POST['received_txt'])){
    $checked_value = $_POST['checked_value'];
    $checked_txt = $_POST['checked_txt'];
    $received_txt = $_POST['received_txt'];
    $ctrl->convertResult($checked_value, $checked_txt, $received_txt);
}


//header("Location: /netpeak_test/index.php");
header("Location: /Currency_converter/index.php");

exit;
?>

