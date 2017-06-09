<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $delete_confirmed = isset($_POST['delete_yes'])?true:false;

    if($delete_confirmed){
        $db = dbconnect();
        $client_query = db_execute_query($db,"SELECT * FROM clients WHERE id=?",array($_GET['id']));
        $client_data = $client_query->fetch(PDO::FETCH_ASSOC);

        if(!str_is_null_or_empty($client_data['client_logo'])){
            $target_file = "files/images/clients-logos/" . $client_data['client_logo'];
            if(!unlink($target_file)) {
                trigger_error("Изтриването на файла с логото на клиента се провали. Клиентът не е изтрит.",E_USER_ERROR);
            }
        }

        db_execute_query($db, "DELETE FROM clients WHERE id=?", array($_GET['id']));

        $_SESSION['message'] = successMessage("Успех!", "Клиентът е изтрит.");
    }

    header("Location:http://{$SETTINGS['site_name']}/clients");
    exit;
}