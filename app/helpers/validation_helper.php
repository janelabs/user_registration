<?php

function validate_between($check, $min, $max)
{
    $n = mb_strlen($check);
    return $min <= $n && $n <= $max;
}

function has_content($field)
{
    if ($field && strlen($field) > 0) {
        return true;
    }

    return false;
}

function validate_min($field, $min)
{
    $field_length = strlen($field);
    return ($field_length >= $min) ? true : false;
}

