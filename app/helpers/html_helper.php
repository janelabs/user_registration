<?php

function eh($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

function routeGenerator($page)
{
    return $_SERVER['REDIRECT_URL'].'?page='.$page;
}