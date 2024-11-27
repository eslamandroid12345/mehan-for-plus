<?php

use Carbon\Carbon;

if (!function_exists('adExpiration')) {
    function adExpiration($expiration_date) {
        $carboned = Carbon::parse($expiration_date);
        $now = Carbon::now();
        if ($carboned->diffInHours($now) < 1) {
            return __('helpers.Less than an hour left');
        } elseif ($carboned->diffInDays($now) <= 1) {
            return __('helpers.Hours left', ['count' => $carboned->diffInHours($now)]);
        } elseif ($carboned->floatDiffInMonths($now) <= 1) {
            return __('helpers.Days left', ['count' => $carboned->diffInDays($now)]);
        } else {
            return __('helpers.More than a month left');
        }
    }
}

if (!function_exists('safeArray')) {
    function safeArray(array $array): array {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = safeArray($value);
            } elseif (is_null($value)) {
                $value = '';
            }
        }
        unset($value);

        return $array;
    }
}
