<?php

require_once "backend/includes/config.php";
require_once "backend/includes/messages.php";
require_once "backend/includes/database_functions.php";
require_once "backend/includes/useful_functions.php";



function custom_error_handler($error_level=null, $error_message)
{
    global $SETTINGS;

    include_once $SETTINGS['frontend_files_path'] . 'common/header.phtml';
    echo "<div style='height:40px;'></div>" . errorMessage("Грешка!", $error_message, "") . "<div style='height:40px;'></div>";
    include_once $SETTINGS['frontend_files_path'] . 'common/footer.phtml';
    exit;
}

session_start();

if(!isset($_SESSION['logged_in'])){
    $_SESSION['logged_in'] = false;
}

if(!isset($_SESSION['is_admin'])){
    $_SESSION['is_admin'] = false;
}

define('IN_THIS_SITE', true);

set_error_handler("custom_error_handler", E_USER_ERROR);
ini_set('error_reporting', $SETTINGS['production_mode']==true?E_USER_ERROR:E_ALL);
ini_set('display_errors', !$SETTINGS['production_mode']);


$self = str_replace('/index.php','',$_SERVER['PHP_SELF']);
$uri = str_replace($self, '', urldecode($_SERVER['REQUEST_URI']));

if($uri[0] == "/"){
    $uri = substr($uri, 1, strlen($uri));
}



if(strpos($uri, "?") !== false)
    $uri= strstr($uri, "?", true);

$uriParts = explode('/', $uri);

$page = array_shift($uriParts);
$parameters = $uriParts;

$page_ext = strtolower(pathinfo($page, PATHINFO_EXTENSION));
if(strlen($page_ext) > 0){
   require_once $page;
   exit;
}

unset($uriParts, $self, $uri);

if(strlen($page) == 0){
    $page = $SETTINGS['home_page'];
}

$pagePath = "backend/$page.php";
if(file_exists($pagePath)){
    require_once $pagePath;
}else{
    trigger_error("404 Страницата не съществува.", E_USER_ERROR);
}
