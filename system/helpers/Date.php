<?php
namespace System\Helpers;
/**
 * Date Helper
 */
class Date
{
    public static function formatDate($date)
    {
        return date('F j, Y, g:i a', strtotime($date));
    }

    public static function formatDateNoTime($date)
    {
        return date('F j, Y', strtotime($date));
    }

    public static function formatOnlyDate($date)
    {
        return date('j', strtotime($date));
    }
    public static function formatOnlyYear($date)
    {
        return date('Y', strtotime($date));
    }
    public static function formatOnlyMonth($date)
    {
        return date('F', strtotime($date));
    }
}
