<?php


// Back end

if(!defined("IN_THIS_SITE"))
{
    exit;
}


// Front end

$title = 'Свържете се с нас';

require_once $SETTINGS['frontend_files_path'] . "common/header.phtml";
require_once $SETTINGS['frontend_files_path'] . "contact.phtml";
require_once $SETTINGS['frontend_files_path'] . "common/footer.phtml";
