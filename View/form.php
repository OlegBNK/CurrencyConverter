<?php
/**
 * @var array $ua_currency
 * @var array $all_currencies
 * @var array $currency_select_setting
 * @var History[] $select_history
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конвертер валют</title>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
          crossorigin="anonymous">

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
                        <?php
                        $checked_txt_from_session = (isset($_SESSION['checked_txt'])) ? $_SESSION['checked_txt'] : "Долар США";
                        foreach ($ua_currency as $ua_currency_value) :
                            foreach ($all_currencies as $currency_unit) :
                                if ($currency_unit['txt'] == $checked_txt_from_session) : ?>
                                    <h5>1 <?= $currency_unit['txt']; ?> дорівнює</h5>
                                    <h3><?= $currency_unit['rate'] . " " . $ua_currency_value['txt']; ?></h3>
                                    <h6><?= $currency_unit['exchangedate']; ?></h6>
                                <?php
                                endif;
                            endforeach;
                        endforeach ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form class="needs-validation" method="post" action="index.php" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03"></label>
                                    <input type="hidden" name="action" value="convert"/>
                                    <input type="number" name="checked_value" step="0.0001" min="0.0001"
                                           class="form-control form-control-user " id="validationCustom03"
                                           placeholder="введіть суму" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom04"></label>
                                    <select name="checked_txt" class="custom-select form-control-user"
                                            id="validationCustom04" required>
                                        <option selected disabled value="">введите валюту</option>
                                        <?php foreach ($currency_select_setting as $checked_value) : ?>
                                            <?php
                                            echo '<option value="' . $checked_value . '" ' . (isset($_SESSION['checked_txt']) && $_SESSION['checked_txt'] == $checked_value ? 'selected="selected"' : '') . '>' . $checked_value . '</option>';
                                        endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom04">
                                    </label>
                                    <select name="received_txt" class="custom-select form-control-user"
                                            id="validationCustom04" required>
                                        <option selected disabled value="">введите валюту</option>
                                        <?php foreach ($currency_select_setting as $received_value) : ?>
                                            <?php
                                            echo '<option value="' . $received_value . '" ' . (isset($_SESSION['received_txt']) && $_SESSION['received_txt'] == $received_value ? 'selected="selected"' : '') . '>' . $received_value . '</option>';
                                        endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Конвертувати</button>
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
                            foreach ($select_history as $selection_history_operation) :
                                ?>
                                <div class="crrnc_hstr-fluide">
                                    <div class="crrnc_hstr_date"><?php
                                        $date = new DateTime($selection_history_operation->created_at);
                                        echo $date->format('H:i d.m.Y');
                                        ?></div>
                                    <div class="crrnc_hstr_from_val"><?php
                                        $fmt = numfmt_create('ru_RU', NumberFormatter::CURRENCY);
                                        $result = numfmt_format_currency($fmt, $selection_history_operation->checked_value, $selection_history_operation->checked_cc);
                                        echo $result;
                                        ?></div>
                                    <div class="crrnc_hstr_from_txt"><?= $selection_history_operation->checked_txt ?></div>
                                    <div class="crrnc_hstr_equally">дорівнює</div>
                                    <div class="crrnc_hstr_to_val"><?php
                                        $fmt = numfmt_create('ru_RU', NumberFormatter::CURRENCY);
                                        $result = numfmt_format_currency($fmt, $selection_history_operation->received_value, $selection_history_operation->received_cc);
                                        echo $result;
                                        ?></div>
                                    <div class="crrnc_hstr_to_txt"><?= $selection_history_operation->received_txt ?></div>
                                </div>
                            <?php endforeach ?>
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
                            <form method="post" action="index.php">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group form-group-user">
                                            <label for="exampleFormControlSelect1">выбор количества запросов в
                                                истории</label>
                                            <input type="hidden" name="action" value="setting"/>
                                            <select class="form-control form-control-option-user"
                                                    id="exampleFormControlSelect1" name="option">
                                                <?php
                                                $select_option = (isset($_SESSION['select_option'])) ? $_SESSION['select_option'] : range(1, 10);
                                                foreach ($select_option as $count_of_selected_currencies_in_history) :
                                                    echo '<option value="' . $count_of_selected_currencies_in_history . '" ' . (isset($_SESSION['option']) && $_SESSION['option'] == $count_of_selected_currencies_in_history ? 'selected="selected"' : '') . '>' . $count_of_selected_currencies_in_history . '</option>';
                                                endforeach
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row list-user">
                                                    <?php
                                                    foreach ($all_currencies as $currency_unit) :
                                                        ?>
                                                        <div class="col-6">
                                                            <input type="checkbox"
                                                                   name="currency[]"
                                                                   value="<?= $currency_unit['cc'] ?>"
                                                                <?= in_array($currency_unit['txt'], $currency_select_setting) ? 'checked' : '' ?>
                                                            />
                                                            <?php if ($currency_unit['is_popular']) :
                                                                echo "<b style='color: #fffef6'>" . $currency_unit['txt'] . "</b>";
                                                            else:
                                                                echo $currency_unit['txt'];
                                                            endif ?>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Змінити налаштування</button>
                            </form>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>