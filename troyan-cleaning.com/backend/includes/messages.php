<?php

/**
 * @param $heading
 * @param $body
 * @param $class
 * @param string $margin
 * @return string
 */
function message($heading, $body, $class, $margin = '')
{
    $margin = strlen($margin)>0?"style='margin:$margin;' ":"style='margin: 0 auto;'";

    return "<p class='$class' role='alert' $margin>\n".
    "  <strong>$heading</strong><br>\n".
    "  $body\n".
    "</p>\n";
}

/**
 * @param $heading
 * @param $body
 * @param string $margin
 * @return string
 */
function successMessage($heading, $body, $margin = '')
{
    return message($heading, $body, "alert alert-success", $margin);
}

/**
 * @param $heading
 * @param $body
 * @param string $margin
 * @return string
 */
function errorMessage($heading, $body, $margin = '')
{
    return message($heading, $body, "alert alert-danger", $margin);
}

/**
 * @param $heading
 * @param $body
 * @param $margin
 * @return string
 */
function warningMessage($heading, $body, $margin = '')
{
    return message($heading, $body, "alert alert-warning", $margin);
}

/**
 * @param $heading
 * @param $body
 * @param $margin
 * @return string
 */
function noticeMessage($heading, $body, $margin = '')
{
    return message($heading, $body, "alert alert-info", $margin);
}
