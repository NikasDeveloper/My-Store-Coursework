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