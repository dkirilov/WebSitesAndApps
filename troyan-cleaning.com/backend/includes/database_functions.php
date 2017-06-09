<?php


function dbconnect()
{
    global $SETTINGS;

    try {
        $db = new PDO("{$SETTINGS['db_driver']}:host={$SETTINGS['db_host']};dbname={$SETTINGS['db_name']};charset={$SETTINGS['db_charset']}", $SETTINGS['db_username'], $SETTINGS['db_password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }catch(PDOException $ex){
        $errmsg = "An error occured while connecting to the database!<br>\n";
        $errmsg .= $ex->getMessage();
        trigger_error($errmsg, E_USER_ERROR);
    }

    return $db;
}

function db_execute_query($database, $query, array $input_parameters)
{

    $prepStatement = $database->prepare($query);
    if(!$prepStatement->execute($input_parameters)){
        $errCode = $prepStatement->errorCode();
        $errInfo = $prepStatement->errorInfo();
        $errorMessage = "Error while executing query!<br>
                         <strong>Error code:</strong> $errCode<br>
                         <strong>Error Info:</strong> $errInfo";
        trigger_error($errorMessage, E_USER_ERROR);
    }

    return $prepStatement;
}

?>