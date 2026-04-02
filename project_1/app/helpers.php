<?php

if (!function_exists('p')) {

    function p($data)
    {
        echo "<pre>";
        print_r($data);
        echo "\nTime: " . date('Y-m-d H:i:s');
        echo "</pre>";
    }

}