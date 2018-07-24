<?php


class pretty_print
{
function output($value){
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}
}