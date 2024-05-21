<?php
namespace App\Utils;

class LmUtils
{
    public static function openNewTab($link, $text)
    {
        return '<a target="_blank" rel="noopener noreferrer" href="'.$link.'">'.$text.'</a>';
    }
    
}
