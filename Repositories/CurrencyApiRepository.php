<?php


class CurrencyApiRepository
{
    public $ua_currency = [[
        "r030" => "980",
        'txt' => 'Українська гривня',
        'rate' => "1",
        'cc' => 'UAH',
        'exchangedate' => '11.08.2020']];

    public function get_currencies_from_api() // get currency from api - переименовать
    {
        $url_api = "https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json = curl_exec($ch);
        return array_merge($this->ua_currency, json_decode($json, true));
    }

    public static function highlighting_popular_currencies( string $json_decoded_value_txt) : bool
    {
        $highlighting_popular_currencies = [
            "Євро",
            "Долар США",
            "Українська гривня",
            "Російський рубль",
        ];
        foreach ($highlighting_popular_currencies as $popular_dedicated_currency) {
            if ($popular_dedicated_currency == $json_decoded_value_txt) {
                return true;
            }
        }
        return false;
    }
}