<?php

namespace App\Http\Controllers;

use App\Http\Traits\Date;
use phpDocumentor\Reflection\Types\Parent_;

class BladeFNController extends Controller
{
    use Date;

    // validate 24 hours time
    static function validate24HrTime($param): bool
    {
        if (preg_match('/00:00:00/', $param) == false) {
            return preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/", $param);
        }
        return false;
    }

    // validate 12 hours time
    static function validate12HrTime($param)
    {
        if (preg_match('/00:00:00/', $param) == false) {
            return preg_match("(((0[1-9])|(1[0-2])):([0-5])(0|5)\s(A|P)M)", $param);
        }
        return false;
    }

    static function britishDate($date, $format = 'd/M/Y')
    {
        // return 'abc';
        return date($format, strtotime($date));
    }

    static function time12hrs($time, $format = 'h:i a')
    {
        return date($format, strtotime($time));
    }

    static function time24hrs($time, $format = 'H:i:s')
    {
        return date($format, strtotime($time));
    }

    static function UKStyleDate($readableDate, $format = 'd-M-Y')
    {
        return date($format, strtotime($readableDate));
    }

    static function USAStyleDate($readableDate, $format = 'Y-M-d')
    {
        return date($format, strtotime($readableDate));
    }

    static function mysqlStyleDate($readableDate, $format = 'Y-m-d')
    {
        return date($format, strtotime($readableDate));
        //die;
    }

    static function ordinal($number)
    {
        $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
        if ((($number % 100) >= 11) && (($number % 100) <= 13))
            return $number . 'th';
        else
            return $number . $ends[$number % 10];
    }

}
