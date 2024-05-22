<?php

namespace App\Utils;

class Rupiah
{
    public static function clean($rupiah)
    {
        $output = preg_replace('/[^0-9]/', '', $rupiah);

        return $output;
    }

    public static function toRupiah($value)
    {
        return number_format($value, 0, ',', '.');
    }
}
