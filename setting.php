<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('Controller/CurrencyController.php');

$ctrl = new CurrencyController(new SettingRepository(), new HistoryRepository());

$json_decoded = $ctrl->json_decoded();
$set_count = ($ctrl->countSetting() > 1) ? 1 : 0;
foreach ($json_decoded as $item) {
$check = isset($_POST[$item['cc']]) ? $_POST[$item['cc']] : "";
    if ($set_count == 0) {
        $ctrl->addSetting($item['txt'], $check);
    } else {
        $ctrl->updateSetting($item['txt'], $check);
    }
}

$_SESSION['option'] = $_POST['option'];

$array = [];
$d = 1;
for ($n=0; $n<10; $n++) {
    $array[] = $d++;
}
$_SESSION['select_option'] = $array;
$_SESSION['option'] = (isset($_POST['option'])) ? $_POST['option'] : 2;

header("Location: /Currency_converter/index.php");
?>