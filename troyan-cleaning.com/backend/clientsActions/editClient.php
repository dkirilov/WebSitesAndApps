<?php

$db = dbconnect();
$editted_client_query = db_execute_query($db, "SELECT * FROM clients WHERE id=?", array($_GET['id']));
$editted_client_data = $editted_client_query->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(str_is_null_or_empty($_POST['client_name'])){
        trigger_error("Не сте въвели името на клиента!", E_USER_ERROR);
    }

    $is_file_selected = !$_FILES['client_logo']['size'] < 1;

    if($is_file_selected)
    {
        $target_file = $SETTINGS['clients_logos_dir'] . "/{$_FILES['client_logo']['name']}";

        $image_file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
        $image_file_type = $_FILES['client_logo']['type'];

        if (!is_valid_extension($image_file_extension, $SETTINGS['allowed_image_extensions'])) {
            trigger_error("Файлът, който сте качили е с невалидно разширение!", E_USER_ERROR);
        }

        if (!is_valid_type($image_file_type, $SETTINGS['allowed_image_types'])) {
            trigger_error("Файлът, който сте качили е от невалиден тип!", E_USER_ERROR);
        }

        if ($_FILES['client_logo']['size'] > $SETTINGS['uploaded_image_file_max_size']) {
            trigger_error("Файлът, който сте качили е твърде голям!", E_USER_ERROR);
        }

        $file_upload_ok = move_uploaded_file($_FILES['client_logo']['tmp_name'], $target_file);
    }


    if($is_file_selected && !$file_upload_ok)
    {
        trigger_error("Качването на файла се провали.",E_USER_ERROR);
    }
    else if($is_file_selected)
    {
        $update_client_query = db_execute_query( $db,
            "UPDATE clients SET client_name=?, client_logo=? WHERE id=?",
            array(
                $_POST['client_name'],
                $_FILES['client_logo']['name'],
                $_GET['id']
            ));
    }
    else
    {
        $update_client_query = db_execute_query( $db,
            "UPDATE clients SET client_name=? WHERE id=?",
            array(
                $_POST['client_name'],
                $_GET['id']
            ));
    }

    if($update_client_query){
        $_SESSION['message'] = successMessage("Успех!", "Клиентът е редактиран.");
        header("Location:http://{$SETTINGS['site_name']}/clients");
        exit;
    }
}