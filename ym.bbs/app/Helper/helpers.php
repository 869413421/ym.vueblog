<?php

function cutString($string)
{
    if (strlen($string) > 200) {
        return substr($string, 0, 200);
    }

    return $string;
}