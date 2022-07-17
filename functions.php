<?php

use Hotash\Ignorable;

if (! function_exists('ignorable')) {
    function ignorable(mixed $value = null, callable|bool $when = true)
    {
        return Ignorable::make($value, $when);
    }
}
