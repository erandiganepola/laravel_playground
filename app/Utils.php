<?php namespace App;
use Monolog\Handler\Curl\Util;

class Utils
{
    const WEEK_DAY_MONDAY = "MON";
    const WEEK_DAY_TUESDAY = "TUE";
    const WEEK_DAY_WEDNESDAY = "WED";
    const WEEK_DAY_THURSDAY = "THU";
    const WEEK_DAY_FRIDAY = "FRI";
    const WEEK_DAY_SATURDAY = "SAT";
    const WEEK_DAY_SUNDAY = "SUN";

    public static function validateDay($day)
    {
        $days = array(Utils::WEEK_DAY_MONDAY, Utils::WEEK_DAY_TUESDAY, Utils::WEEK_DAY_WEDNESDAY, Utils::WEEK_DAY_THURSDAY, Utils::WEEK_DAY_FRIDAY, Utils::WEEK_DAY_SATURDAY, Utils::WEEK_DAY_SUNDAY);
        if(in_array($day,$days))
        {
            return true;
        }
        return false;
    }

}