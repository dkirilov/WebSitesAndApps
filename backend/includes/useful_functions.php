<?php

/**
 * @param $bytes
 * @return string
 */
function human_size($bytes)
{
    $one_kb = 1024;
    $one_mb = $one_kb * 1024;
    $one_gb = $one_mb * 1024;
    $one_tb = $one_gb * 1024;

    if($bytes < $one_mb){
        return number_format($bytes / $one_kb, 2) . "KB";
    }else if($bytes < $one_gb){
        return number_format($bytes / $one_mb, 2) . "MB";
    }else if($bytes < $one_tb){
        return number_format($bytes / $one_gb, 2) . "GB";
    }else{
        return number_format($bytes / $one_tb, 2) . "TB";
    }
}

function str_is_null_or_empty($string, ...$_)
{
    $args = func_get_args();

    foreach ($args as $arg) {
        return $arg === null || strlen(trim($arg)) == 0;
    }
}

function str_contains_html_tags($string, ...$_)
{
    $args = func_get_args();

    foreach ($args as $arg) {
        return $arg != strip_tags($arg);
    }
}

function is_valid_type($file_type, $collection)
{
    return in_array($file_type, $collection);
}

function is_valid_extension($file_extension, $collection)
{
    return in_array($file_extension, $collection);
}
