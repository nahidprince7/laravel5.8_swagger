<?php


namespace App\Http\Traits;


trait Date
{
    public function addDaysWithDate($date = '', $days = 0)
    {
        return date('Y-m-d', strtotime("+$days day", strtotime($date)));
    }

    public function addDaysWithToday($days = 0)
    {
        return date('Y-m-d', strtotime("+$days day", strtotime(date('Y-m-d'))));
    }

    public function deductDaysWithToday($days = 0)
    {
        return date('Y-m-d', strtotime("-$days day", strtotime(date('Y-m-d'))));
    }

    public function today()
    {
        return date('Y-m-d');
    }

    public function britishDate($date, $format = 'd/m/Y')
    {
        return date($format, strtotime($date));
    }
    public function britishDateTime($date, $format = 'd, M/Y h:ia')
    {
        return date($format, strtotime($date));
    }

    protected function UKStyleDate($readableDate, $format = 'd-m-Y')
    {
        return date(strtotime($readableDate), $format);
    }

    static function mysqlDefaultDateTimeFormat($time = '', $mysqlFormat = 'Y-m-d H:i:s')
    {
        date_default_timezone_set('Asia/Dhaka');
        if (empty($time)) {
            $time = date($mysqlFormat);
        }
        return date($mysqlFormat, strtotime($time));
    }

    static function mysqlDefaultDateFormat($readableDate, $format = 'Y-m-d')
    {
        if (empty($readableDate)) {
            $readableDate = date($format);
        }
        return date($format, strtotime($readableDate));
    }

    static function mysqlDefaultTimeFormat($time = '', $mysqlFormat = 'H:i:s')
    {
        date_default_timezone_set('Asia/Dhaka');
        if (empty($time)) {
            $time = date($mysqlFormat);
        }
        return date($mysqlFormat, strtotime($time));
    }


}
