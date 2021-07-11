<?php


class History
{
    public $checked_value;
    public $checked_r030;
    public $checked_txt;
    public $checked_rate;
    public $checked_cc;
    public $checked_exchangedate;
    public $received_value;
    public $received_r030;
    public $received_txt;
    public $received_rate;
    public $received_cc;
    public $received_exchangedate;
    public $created_at;

    /**
     * History constructor.
     * @param $checked_value
     * @param $checked_r030
     * @param $checked_txt
     * @param $checked_rate
     * @param $checked_cc
     * @param $checked_exchangedate
     * @param $received_value
     * @param $received_r030
     * @param $received_txt
     * @param $received_rate
     * @param $received_cc
     * @param $received_exchangedate
     * @param $created_at
     */

    public function __construct($checked_value, $checked_r030, $checked_txt, $checked_rate, $checked_cc, $checked_exchangedate, $received_value, $received_r030, $received_txt, $received_rate, $received_cc, $received_exchangedate, $created_at)
    {
        $this->checked_value = $checked_value;
        $this->checked_r030 = $checked_r030;
        $this->checked_txt = $checked_txt;
        $this->checked_rate = $checked_rate;
        $this->checked_cc = $checked_cc;
        $this->checked_exchangedate = $checked_exchangedate;
        $this->received_value = $received_value;
        $this->received_r030 = $received_r030;
        $this->received_txt = $received_txt;
        $this->received_rate = $received_rate;
        $this->received_cc = $received_cc;
        $this->received_exchangedate = $received_exchangedate;
        $this->created_at = $created_at;
    }


}