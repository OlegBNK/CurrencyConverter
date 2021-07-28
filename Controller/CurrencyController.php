<?php

require_once("Repositories/SettingRepository.php");
require_once("Repositories/HistoryRepository.php");
require_once("Repositories/CurrencyApiRepository.php");

class CurrencyController
{
    /**
     * @var SettingRepository
     */
    private $settingRepository;
    /**
     * @var HistoryRepository
     */
    private $historyRepository;
    /**
     * @var CurrencyApiRepository
     */
    private $currencyApiRepository;

    public function __construct()
    {
        $this->settingRepository = new SettingRepository();
        $this->historyRepository = new HistoryRepository();
        $this->currencyApiRepository = new CurrencyApiRepository();
    }

    public function index(array $form): void
    {
        if (isset($form['action']) && $form['action'] == 'convert') {
            $this->processing_form_history($form);
        }
        if (isset($form['action']) && $form['action'] == 'setting') {
            $this->handle_setting_form($form);
        }
        if (isset($_SESSION['option'])) {
            $this->historyRepository->set_count_select_history($_SESSION['option']);
        }

        $all_currencies_raw = $this->currencyApiRepository->get_currencies_from_api();
        $all_currencies = array_map(function (array $currency) {
            $currency['is_popular'] = CurrencyApiRepository::highlighting_popular_currencies($currency['txt']);
            return $currency;
        }, $all_currencies_raw);
        $ua_currency = $this->currencyApiRepository->ua_currency;
        $currency_select_setting = $this->settingRepository->select_view_currency();
        $select_history = $this->historyRepository->select_all();
        require_once('View/form.php');
    }

    private function processing_form_history(array $convert_form): void
    {
        $checked_value = $_SESSION['checked_value'] = $convert_form['checked_value'];
        $checked_txt = $_SESSION['checked_txt'] = $convert_form['checked_txt'];
        $received_txt = $_SESSION['received_txt'] = $convert_form['received_txt'];
        $this->convert_result($checked_value, $checked_txt, $received_txt);
    }


    private function handle_setting_form(array $settings_form): void
    {
        $json_decoded = $this->currencyApiRepository->get_currencies_from_api();
        $set_count = ($this->settingRepository->count() > 1) ? 1 : 0;
        foreach ($json_decoded as $item) {
            $check = in_array($item['cc'], $settings_form['currency']) ? 'checked' : "";
            if ($set_count == 0) {
                $this->settingRepository->add($item['txt'], $check);
            } else {
                $this->settingRepository->update($item['txt'], $check);
            }
        }
        $_SESSION['select_option'] = range(1, 10);
        $_SESSION['option'] = (isset($settings_form['option'])) ? $settings_form['option'] : 10;
    }

    private function convert_result(float $checked_value, string $checked_txt, string $received_txt): void
    {
        foreach ($this->currencyApiRepository->get_currencies_from_api() as $item) {
            switch ($item['txt']) {
                case $checked_txt:
                    $checked_r030 = $item['r030'];
                    $checked_txt = $item['txt'];
                    $checked_rate = $item['rate'];
                    $checked_cc = $item['cc'];
                    $checked_exchangedate = $item['exchangedate']; //
            }
            switch ($item['txt']) {
                case $received_txt:
                    $received_r030 = $item['r030'];
                    $received_txt = $item['txt'];
                    $received_rate = $item['rate'];
                    $received_cc = $item['cc'];
                    $received_exchangedate = $item['exchangedate']; //
                    break;
            }
        }
        $received_value = $checked_value * ($checked_rate / $received_rate);
        $this->historyRepository->add($checked_value, $checked_r030, $checked_txt, $checked_rate, $checked_cc, $checked_exchangedate, $received_value, $received_r030, $received_txt, $received_rate, $received_cc, $received_exchangedate);
    }
}
