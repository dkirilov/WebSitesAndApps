<?php


// Back end

if(!defined("IN_THIS_SITE"))
{
    exit;
}

$db = dbconnect();

$errMSG = '';

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(str_is_null_or_empty($_POST['username'])){
        $errMSG = "Не сте въвели потребителско име!";
    }else if(str_is_null_or_empty($_POST['password'])){
        $errMSG = "Не сте въвели парола!";
    }else if(str_contains_html_tags($_POST['username'])){
        $errMSG = "Потребителското име не може да съдържа HTML тагове!";
    }else if(str_contains_html_tags($_POST['password'])){
        $errMSG = "Паролата не може да съдържа HTML тагове!";
    }else{

        $user_query = db_execute_query($db,"SELECT * FROM users WHERE username=?", array($_POST['username']));

        if($user_query->rowCount() == 0){
            $errMSG = "Нямаме потребител с такова име!";
        }else{
            $user_data = $user_query->fetch(PDO::FETCH_ASSOC);

            if(password_verify($_POST['password'], $user_data['password'])){
                 $_SESSION['logged_in'] = true;
                 $_SESSION['current_user_id'] = $user_data['id'];
                 $_SESSION['current_user_name'] = $user_data['username'];
                 $_SESSION['is_admin'] = $user_data['is_admin'];

                header("Location: " . $SETTINGS['home_page']);
                exit;
            }else{
                $errMSG = "Паролата, която въведохте е грешна!";
            }
        }

    }
}

if(strlen($errMSG) != 0){
    $errMSG = errorMessage("Грешка!",$errMSG);
}

// Front end

$title = 'Вход за потребители';

require_once $SETTINGS['frontend_files_path'] . "common/header.phtml";
require_once $SETTINGS['frontend_files_path'] . "login.phtml";
require_once $SETTINGS['frontend_files_path'] . "common/footer.phtml";
