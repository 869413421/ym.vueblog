<?php

function cutString($string, $max_length = 200)
{
    if (strlen($string) > $max_length) {
        if (preg_match("/[\x7f-\xff]/", $string)) {
            mb_substr($string, 0, $max_length);
        } else {
            substr($string, $max_length);
        }
    }

    return $string;
}