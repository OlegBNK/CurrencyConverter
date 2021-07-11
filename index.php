<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('Controller/CurrencyController.php');
?>
<!--<a href="http://localhost/Currency_converter/test.php">test.php</a>-->
<?php
$ctrl = new CurrencyController(new SettingRepository(), new HistoryRepository());

if (isset($_SESSION['option'])) {
    $ctrl->countSelectHistoryFromHistoryRepository($_SESSION['option']);
}

$json_decoded = $ctrl->json_decoded();
$ua_currency = $ctrl->ua_currency;
$select = $ctrl->CurrencySelectSetting();
$selectHistory = $ctrl->selectHistory();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конвертер валют</title>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="wrapper">
    <div class="container-user">
        <div class="row user-history">
            <div class="col-3">
                <div class="row">
                    <div class="col-12">
                        <p>1 Доллар США равно</p>
                        <?php
                        foreach ($ua_currency as $value) {
                            foreach ($json_decoded as $item) {
                                switch ($item['cc']) {
                                    case 'USD': ?>
                                        <h3><?= $item['rate'] . " "
                                            . $value['txt'];
                                            ?></h3>
                                        <h6><?= $item['exchangedate']; ?></h6>
                                        <?php break; ?>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form class="needs-validation" method="post" action="history.php" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03"></label>
                                    <input type="number" name="checked_value" step="0.0001"
                                           class="form-control form-control-user " id="validationCustom03"
                                           placeholder="введите сумму"
                                           required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom04"></label>
                                    <select name="checked_txt" class="custom-select form-control-user"
                                            id="validationCustom04" required>
                                        <option selected disabled value="">введите валюту</option>
                                        <?php foreach ($select as $row) { ?>
                                            <option><?= $row['txt'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom04">
                                    </label>
                                    <select name="received_txt" class="custom-select form-control-user"
                                            id="validationCustom04" required>
                                        <option selected disabled value="">введите валюту</option>
                                        <?php foreach ($select as $row) { ?>
                                            <option><?= $row['txt'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-12">
                        История запросов:
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 container-history-col-12">
                        <div>
                            <?php
                            foreach ($selectHistory as $item) {
                                ?>
                                <div class="crrnc_hstr-fluide">
                                    <div class="crrnc_hstr_date"><?php
                                        $date = new DateTime($item->created_at);
                                        echo $date->format('H:i d.m.Y');
                                        ?></div>
                                    <div class="crrnc_hstr_from_val"><?php
                                        $fmt = numfmt_create('ru_RU', NumberFormatter::CURRENCY);
                                        $result = numfmt_format_currency($fmt, $item->checked_value, $item->checked_cc);
                                        echo $result;
                                        ?></div>
                                    <div class="crrnc_hstr_from_txt"><?= $item->checked_txt ?></div>
                                    <div class="crrnc_hstr_equally">равно</div>
                                    <div class="crrnc_hstr_to_val"><?php
                                        $fmt = numfmt_create('ru_RU', NumberFormatter::CURRENCY);
                                        $result = numfmt_format_currency($fmt, $item->received_value, $item->received_cc);
                                        echo $result;
                                        ?></div>
                                    <div class="crrnc_hstr_to_txt"><?= $item->received_txt ?></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="burger-user">
                <nav class="navbar navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarToggleExternalContent"
                            aria-controls="navbarToggleExternalContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </nav>
                <div class="collapse" id="navbarToggleExternalContent">
                    <div class="bg-dark p-4">
                        <h5 class="text-white h4">
                            <form method="post" action="setting.php">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group form-group-user">
                                            <label for="exampleFormControlSelect1">выбор количества запросов в
                                                истории</label>
                                            <select class="form-control form-control-option-user"
                                                    id="exampleFormControlSelect1" name="option">
                                                <?php
                                                if (isset($_SESSION['select_option'])){
                                                    foreach ($_SESSION['select_option'] as $sel_opt) {
                                                        echo '<option value="' . $sel_opt . '" ' . (isset($_SESSION['option']) && $_SESSION['option'] == $sel_opt ? 'selected="selected"' : '') . '>' . $sel_opt . '</option>';
                                                    }
                                                } else {
                                                    $array_option_select = [];
                                                    $d = 1;
                                                    for ($n=0; $n<10; $n++) {
                                                        $array_option_select[] = $d++;
                                                    }
                                                    foreach ($array_option_select as $sel_opt) {
                                                        echo '<option value="' . $sel_opt . '" ' . (isset($_SESSION['option']) && $_SESSION['option'] == $sel_opt ? 'selected="selected"' : '') . '>' . $sel_opt . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row list-user">
                                                    <?php
                                                    foreach ($json_decoded as $value) {
                                                        ?>
                                                        <div class="col-6">
                                                            <input type="checkbox" name="<?= $value['cc'] ?>"
                                                                   value="checked" <?= (!array_key_exists($value['txt'], $ctrl->arrayCurrency) == true) ?: $ctrl->arrayCurrency[$value['txt']] ?> />
                                                            <?php if ($ctrl->highlightingPopularCurrencies($value['txt']) == true) {
                                                                echo "<b style='color: #fffef6'>" . $value['txt'] . "</b>";
                                                            } else {
                                                                echo $value['txt'];
                                                            } ?>
                                                        </div>
                                                        <?php
                                                        foreach ($ctrl->arrayCurrency as $item) {
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </form>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
