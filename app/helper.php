<?php

if(!function_exists('sifrele')) {
    function sifrele($string) {
        return encrypt($string);
    }
}

if(!function_exists('sifreCoz')) {
    function sifreCoz($string) {
        return decrypt($string);
    }
}
