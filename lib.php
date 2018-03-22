<?php

function connect(){
    $mycnf='/etc/mysql.conf';
    if (!file_exists($mycnf)) {
        echo "File Not Found: $mycnf";
        exit;
    }

    $mysql_ini_array=parse_ini_file($mycnf);
    $db_host=$mysql_ini_array["host"];
    $db_user=$mysql_ini_array["user"];
    $db_pass=$mysql_ini_array["pass"];
    $db_port=$mysql_ini_array["port"];
    $db_name=$mysql_ini_array["dbName"];

    $db= mysqli_connect(
            $db_host,
            $db_user,
            $db_pass,
            $db_name,
            $db_port
    );

    if (!$db) {
        echo "Error Connecting to DB".mysqli_connect_error();
        exit;
    }
    return $db;
}

?>