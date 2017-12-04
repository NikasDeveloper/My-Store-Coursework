<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 04/12/2017
 * Time: 13:53
 */


if (!function_exists('activeClassBind')) {
    /**
     * Bind active class on sidebar.
     *
     * @param integer $segment
     * @param array|string $value
     * @return string
     */
    function activeClassBind($segment, $value)
    {
        if (!is_array($value)) {
            return Request::segment($segment) == $value ? 'active' : '';
        }

        foreach ($value as $v) {
            if (Request::segment($segment) == $v) return 'active';
        }

        return '';
    }
}

if (!function_exists('moneyFloat')) {
    /**
     * Format float to money value.
     *
     * @param float $value
     * @param integer $places
     * @return string
     */
    function moneyFloat($value = 0.00, $places = 2)
    {
        if(empty($value)) number_format(0.00, 2, '.', '');

        return number_format($value, $places, '.', '');
    }
}