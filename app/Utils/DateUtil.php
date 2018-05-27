<?php

namespace App\Utils;

class DateUtil
{
    public static function weekday($time)
    {
        $wday = date('N', $time);

        $zhDay = '';

        switch ($wday) {
            case 1:
                $zhDay = '一';
                break;
            case 2:
                $zhDay = '二';
                break;
            case 3:
                $zhDay = '三';
                break;
            case 4:
                $zhDay = '四';
                break;
            case 5:
                $zhDay = '五';
                break;
            case 6:
                $zhDay = '六';
                break;
            case 7:
                $zhDay = '日';
                break;
        }

        return '星期' . $zhDay;
    }
}
