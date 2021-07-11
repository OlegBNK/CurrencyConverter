<?php

require_once("Repositories/SettingRepository.php");
require_once("Repositories/HistoryRepository.php");

class CurrencyController
{
    public $ua_currency = [[
        "r030" => "980",
        'txt' => 'Українська гривня',
        'rate' => "1",
        'cc' => 'UAH',
        'exchangedate' => '11.08.2020']];

    public $arrayCurrency = [];
    public $settingRepository;
    public $historyRepository;

    public function __construct(SettingRepository $settingRepository, HistoryRepository $historyRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->historyRepository = $historyRepository;
    }

    public function json_decoded() // get currency from api - переименовать
    {
        $url_api = "https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json = curl_exec($ch);
        return array_merge($this->ua_currency, json_decode($json, true));
    }

    public function addSetting($txt, $view) //
    {
        $this->settingRepository->add($txt, $view);
    }

    public function updateSetting($txt, $view) //
    {
        $this->settingRepository->Update($txt, $view);
    }

    public function countSetting() //
    {
        return $this->settingRepository->count();
    }

    public function CurrencySelectSetting()
    {
        $array = $this->settingRepository->selectViewCurrency();
        foreach ($array as $item) {
            $this->arrayCurrency[$item['txt']] = $item['view'];
        }
        return $array;
    }

    public function convertResult($checked_value, $checked_txt, $received_txt)
    {
        foreach ($this->json_decoded() as $item) {
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

    public function countSelectHistoryFromHistoryRepository($count_from_post)
    {
        return $this->historyRepository->setCountSelectHistory($count_from_post);
    }

    public function selectHistory()
    {
        return $this->historyRepository->selectAll();

    }

    public function highlightingPopularCurrencies($json_decoded_value_txt)
    {
        $highlightingPopularCurrencies = [
            "Євро",
            "Долар США",
            "Українська гривня",
            "Російський рубль",
        ];
        foreach ($highlightingPopularCurrencies as $value) {
            if ($value == $json_decoded_value_txt) {
                return true;
            }
        }
    }
}
