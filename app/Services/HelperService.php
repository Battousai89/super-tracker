<?php

namespace App\Services;

class HelperService
{
    /**
     * Преобразует секунды в строку формата "x дней, y часов, z минут"
     * @param $secs
     * @return string
     */
    public static function secToStr($secs): string
    {
        $res = '';

        $days = floor($secs / 86400);
        $secs = $secs % 86400;
        $res .= self::num_word($days, array('день', 'дня', 'дней')) . ', ';

        $hours = floor($secs / 3600);
        $secs = $secs % 3600;
        $res .= self::num_word($hours, array('час', 'часа', 'часов')) . ', ';

        $minutes = floor($secs / 60);
        $res .= self::num_word($minutes, array('минута', 'минуты', 'минут'));

        return $res;
    }

    /**
     * Склоняет числительные
     * @param $value
     * @param $words
     * @param $show
     * @return string
     */
    private static function num_word($value, $words, $show = true): string
    {
        $num = $value % 100;
        if ($num > 19) {
            $num = $num % 10;
        }

        $out = ($show) ?  $value . ' ' : '';
        switch ($num) {
            case 1:  $out .= $words[0]; break;
            case 2:
            case 3:
            case 4:  $out .= $words[1]; break;
            default: $out .= $words[2]; break;
        }

        return $out;
    }
}
