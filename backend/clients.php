<?php

// Back end

if(!defined("IN_THIS_SITE"))
{
    exit;
}

$frontend_to_load = $page;

$action = array_shift($parameters);
if(strlen($action) > 0 && $_SESSION['is_admin'])
{
    $frontend_to_load = $action;

    $action_path = "backend/clientsActions/$action.php";
    if(!file_exists($action_path)){
        trigger_error("Не е дефинирана такава операция!", E_USER_ERROR);
    }

    require_once $action_path;
}else{
    $db = dbconnect();
    $clients_query = db_execute_query($db, "SELECT * FROM clients", array());
}

// Front end

$title = 'Нашите клиенти';

require_once $SETTINGS['frontend_files_path'] . "common/header.phtml";
require_once $SETTINGS['frontend_files_path'] . "$frontend_to_load.phtml";
require_once $SETTINGS['frontend_files_path'] . "common/footer.phtml";

$_SESSION['message'] = "";
